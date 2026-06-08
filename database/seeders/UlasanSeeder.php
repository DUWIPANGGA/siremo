<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ulasan;

class UlasanSeeder extends Seeder
{
    public function run(): void
    {
        Ulasan::create([
            'id_mobil' => 1,
            'id_penyewa' => 1,
            'id_transaksi' => 1,
            'nama' => 'Budi Santoso',
            'ulasan' => 'Mobil bagus, bersih, dan nyaman. AC dingin. Recommended!',
            'rating' => 5,
            'tanggal' => now()->subDays(6),
        ]);

        Ulasan::create([
            'id_mobil' => 3,
            'id_penyewa' => 1,
            'id_transaksi' => 2,
            'nama' => 'Budi Santoso',
            'ulasan' => 'Mobil lincah dan irit bensin. Cocok untuk jalan di kota.',
            'rating' => 4,
            'tanggal' => now()->subDays(1),
        ]);
    }
}
