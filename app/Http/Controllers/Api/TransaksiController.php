<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransaksiSewa;
use App\Models\Mobil;
use Illuminate\Http\Request;
class TransaksiController extends Controller
{
    public function storeApi(Request $request) 
    {
        $request->validate([
            'id_mobil' => 'required|exists:mobil,id_mobil',
            'tgl_sewa' => 'required|date',
            'tgl_rencana_kembali' => 'required|date',
            'lama_sewa_hari' => 'required|integer',
            'total_bayar' => 'required|numeric',
            'bukti_ktp' => 'required|image|mimes:jpeg,png,jpg',
            'bukti_sim' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $user = $request->user();
        $penyewa = \App\Models\Penyewa::where('id_user', $user->id_user)->first();

        if (!$penyewa) {
            return response()->json(['message' => 'Profil penyewa tidak ditemukan. Silakan lengkapi profil terlebih dahulu.'], 404);
        }

        $data = $request->except(['bukti_ktp', 'bukti_sim']);
        $data['bukti_ktp'] = $request->file('bukti_ktp')->store('identitas', 'public');
        $data['bukti_sim'] = $request->file('bukti_sim')->store('identitas', 'public');
        $data['id_penyewa'] = $penyewa->id_penyewa;
        $data['status_transaksi'] = 'Aktif';

        $transaksi = TransaksiSewa::create($data);
        Mobil::where('id_mobil', $request->id_mobil)->update(['status_ketersediaan' => 'Disewa']);

        return response()->json(['message' => 'Booking berhasil', 'transaksi' => $transaksi], 201);
    }

    public function indexApi(Request $request)
    {
        $penyewa = $request->user()->penyewa;
        if (!$penyewa) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $transaksi = TransaksiSewa::with('mobil')
            ->where('id_penyewa', $penyewa->id_penyewa)
            ->orderBy('id_transaksi', 'desc')
            ->get();

        return response()->json(['data' => $transaksi], 200);
    }

    public function cancelBookingApi($id, Request $request)
    {
        $penyewa = $request->user()->penyewa;
        if (!$penyewa) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $transaksi = TransaksiSewa::where('id_transaksi', $id)
                        ->where('id_penyewa', $penyewa->id_penyewa)
                        ->first();

        if (!$transaksi) return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);

        if ($transaksi->status_transaksi !== 'Aktif') {
            return response()->json(['message' => 'Pesanan tidak bisa dibatalkan pada status ini'], 400);
        }

        $transaksi->update(['status_transaksi' => 'Batal']);
        
        Mobil::where('id_mobil', $transaksi->id_mobil)->update(['status_ketersediaan' => 'Tersedia']);

        return response()->json(['message' => 'Booking berhasil dibatalkan']);
    }
}
