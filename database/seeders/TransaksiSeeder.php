<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiSewa;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        TransaksiSewa::create([
            'id_mobil' => 1,
            'id_penyewa' => 1,
            'tgl_sewa' => now()->subDays(10),
            'tgl_rencana_kembali' => now()->subDays(7),
            'tgl_aktual_kembali' => now()->subDays(7),
            'lama_sewa_hari' => 3,
            'total_bayar' => 1050000,
            'denda' => 0,
            'status_transaksi' => 'Selesai',
        ]);

        TransaksiSewa::create([
            'id_mobil' => 3,
            'id_penyewa' => 1,
            'tgl_sewa' => now()->subDays(5),
            'tgl_rencana_kembali' => now()->subDays(2),
            'tgl_aktual_kembali' => now()->subDays(2),
            'lama_sewa_hari' => 3,
            'total_bayar' => 750000,
            'denda' => 0,
            'status_transaksi' => 'Selesai',
        ]);

        TransaksiSewa::create([
            'id_mobil' => 5,
            'id_penyewa' => 2,
            'tgl_sewa' => now()->subDays(3),
            'tgl_rencana_kembali' => now()->addDays(2),
            'lama_sewa_hari' => 5,
            'total_bayar' => 2250000,
            'denda' => 0,
            'status_transaksi' => 'Aktif',
        ]);

        TransaksiSewa::create([
            'id_mobil' => 2,
            'id_penyewa' => 2,
            'tgl_sewa' => now()->subDays(15),
            'tgl_rencana_kembali' => now()->subDays(12),
            'lama_sewa_hari' => 3,
            'total_bayar' => 1050000,
            'denda' => 0,
            'status_transaksi' => 'Batal',
        ]);
    }
}
