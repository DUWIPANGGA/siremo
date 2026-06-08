<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransaksiSewa;
use App\Models\Mobil;
use Illuminate\Http\Request;
use App\Models\Notifikasi;

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
        $penyewa = \App\Models\Penyewa::where('id_user', $user->id)->first(); // Sesuaikan id_user jika perlu

        if (!$penyewa) {
            return response()->json(['message' => 'Profil penyewa tidak ditemukan.'], 404);
        }

        $data = $request->except(['bukti_ktp', 'bukti_sim']);
        $data['bukti_ktp'] = $request->file('bukti_ktp')->store('identitas', 'public');
        $data['bukti_sim'] = $request->file('bukti_sim')->store('identitas', 'public');
        $data['id_penyewa'] = $penyewa->id_penyewa;
        $data['status_transaksi'] = 'Aktif';
        
        // ... kode di atas ...
        $transaksi = TransaksiSewa::create($data);
        Mobil::where('id_mobil', $request->id_mobil)->update(['status_ketersediaan' => 'Disewa']);
        
        // Perbaikan: Tambahkan 'user_id' agar notifikasi muncul di akun penyewa
        Notifikasi::create([
            'user_id'      => $user->id, // <--- Tambahkan ini!
            'judul'        => 'Pesanan Sewa Diterima',
            'pesan'        => "Pesanan Anda untuk mobil telah berhasil dibuat. Silakan tunggu konfirmasi admin.",
            'tipe'         => 'pesanan_sewa',
            'icon'         => Notifikasi::iconTipe('pesanan_sewa'),
            'warna'        => Notifikasi::warnaTipe('pesanan_sewa'),
            'url'          => "/transaksi/{$transaksi->id_transaksi}",
            'id_transaksi' => $transaksi->id_transaksi,
            'dibaca'       => false,
        ]); 
        
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
    $transaksi = TransaksiSewa::where('id_transaksi', $id)
                    ->where('id_penyewa', $request->user()->penyewa->id_penyewa)
                    ->first();

    if (!$transaksi) return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);

    // Hanya bisa dibatalkan jika statusnya masih Aktif/Pending
    if ($transaksi->status_transaksi !== 'Aktif') {
        return response()->json(['message' => 'Pesanan tidak bisa dibatalkan pada status ini'], 400);
    }

    $transaksi->update(['status_transaksi' => 'Dibatalkan']);
    
    // Kembalikan status mobil
    Mobil::where('id_mobil', $transaksi->id_mobil)->update(['status_ketersediaan' => 'Tersedia']);

    return response()->json(['message' => 'Booking berhasil dibatalkan']);
}
}
