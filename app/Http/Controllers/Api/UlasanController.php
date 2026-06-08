<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use App\Models\TransaksiSewa;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    // GET: Mengambil ulasan mobil tertentu
    public function index($id_mobil)
    {
        $ulasan = Ulasan::with('penyewa:id_penyewa,nama')
            ->where('id_mobil', $id_mobil)
            ->latest('tanggal')
            ->get();
            
        return response()->json(['data' => $ulasan], 200);
    }

    // POST: Kirim ulasan
    public function store(Request $request)
    {
        $request->validate([
            'id_mobil'     => 'required|exists:mobil,id_mobil',
            'id_transaksi' => 'required|exists:transaksi_sewa,id_transaksi',
            'rating'       => 'required|integer|between:1,5',
            'ulasan'       => 'nullable|string',
        ]);

        // Cek apakah transaksi benar milik user ini
        $transaksi = TransaksiSewa::where('id_transaksi', $request->id_transaksi)
            ->where('id_penyewa', $request->user()->penyewa->id_penyewa)
            ->first();

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak valid'], 403);
        }

        Ulasan::create([
            'id_mobil'     => $request->id_mobil,
            'id_penyewa'   => $request->user()->penyewa->id_penyewa,
            'id_transaksi' => $request->id_transaksi,
            'nama'         => $request->user()->penyewa->nama,
            'ulasan'       => $request->ulasan,
            'rating'       => $request->rating,
            'tanggal'      => now(),
        ]);

        return response()->json(['message' => 'Ulasan berhasil terkirim'], 201);
    }
}
