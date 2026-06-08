<?php

namespace App\Observers;

use App\Models\TransaksiSewa;
use App\Models\Notifikasi;

class TransaksiSewaObserver
{
    public function created(TransaksiSewa $transaksi): void
    {
        $namaPenyewa = $transaksi->penyewa->nama ?? 'Pelanggan';
        $namaMobil   = ($transaksi->mobil->merek ?? '') . ' ' . ($transaksi->mobil->model ?? '');

        $penyewa = $transaksi->penyewa;

        // Notifikasi untuk penyewa
        if ($penyewa && $penyewa->id_user) {
            Notifikasi::create([
                'user_id'      => $penyewa->id_user,
                'judul'        => 'Pesanan Sewa Diterima',
                'pesan'        => "Pesanan Anda untuk {$namaMobil} telah berhasil dibuat. Silakan tunggu konfirmasi admin.",
                'tipe'         => 'pesanan_sewa',
                'icon'         => Notifikasi::iconTipe('pesanan_sewa'),
                'warna'        => Notifikasi::warnaTipe('pesanan_sewa'),
                'url'          => '/transaksi/' . $transaksi->id_transaksi,
                'dibaca'       => false,
                'id_transaksi' => $transaksi->id_transaksi,
            ]);
        }

        // Notifikasi untuk admin (tanpa user_id agar tampil di semua admin)
        Notifikasi::create([
            'judul'        => 'Pesanan Sewa Baru',
            'pesan'        => "{$namaPenyewa} menyewa {$namaMobil}",
            'tipe'         => 'pesanan_sewa',
            'icon'         => Notifikasi::iconTipe('pesanan_sewa'),
            'warna'        => Notifikasi::warnaTipe('pesanan_sewa'),
            'url'          => '/admin/transaksi/' . $transaksi->id_transaksi,
            'dibaca'       => false,
            'id_transaksi' => $transaksi->id_transaksi,
        ]);
    }

    public function updated(TransaksiSewa $transaksi): void
    {
        if (! $transaksi->wasChanged('status_transaksi')) return;

        $namaPenyewa = $transaksi->penyewa->nama ?? 'Pelanggan';
        $namaMobil   = ($transaksi->mobil->merek ?? '') . ' ' . ($transaksi->mobil->model ?? '');
        $status      = $transaksi->status_transaksi;
        $penyewa     = $transaksi->penyewa;
        $userId      = $penyewa ? $penyewa->id_user : null;

        if ($status === 'Selesai' && is_null($transaksi->tgl_aktual_kembali)) {
            Notifikasi::create([
                'user_id'      => $userId,
                'judul'        => 'Pembayaran Dikonfirmasi',
                'pesan'        => "Pembayaran dari {$namaPenyewa} untuk {$namaMobil} telah sukses",
                'tipe'         => 'pembayaran',
                'icon'         => Notifikasi::iconTipe('pembayaran'),
                'warna'        => Notifikasi::warnaTipe('pembayaran'),
                'url'          => '/admin/transaksi/' . $transaksi->id_transaksi,
                'dibaca'       => false,
                'id_transaksi' => $transaksi->id_transaksi,
            ]);
        }

        if ($status === 'Selesai' && $transaksi->wasChanged('tgl_aktual_kembali') && $transaksi->tgl_aktual_kembali) {
            Notifikasi::create([
                'user_id'      => $userId,
                'judul'        => 'Kendaraan Dikembalikan',
                'pesan'        => "{$namaMobil} telah dikembalikan oleh {$namaPenyewa}",
                'tipe'         => 'pengembalian',
                'icon'         => Notifikasi::iconTipe('pengembalian'),
                'warna'        => Notifikasi::warnaTipe('pengembalian'),
                'url'          => '/admin/pengembalian',
                'dibaca'       => false,
                'id_transaksi' => $transaksi->id_transaksi,
            ]);
        }
    }
}
