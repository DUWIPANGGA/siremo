<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penyewa;

class PenyewaSeeder extends Seeder
{
    public function run(): void
    {
        Penyewa::create([
            'id_user' => 3,
            'nama' => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 10, Jakarta',
            'no_ktp' => '3174010101920001',
            'no_sim' => '123456789012',
            'no_telepon' => '081234567892',
            'email' => 'budi@siremo.com',
            'tgl_gabung' => now(),
        ]);

        Penyewa::create([
            'id_user' => 4,
            'nama' => 'Ani Permata',
            'alamat' => 'Jl. Sudirman No. 25, Jakarta',
            'no_ktp' => '3174010202930002',
            'no_sim' => '987654321098',
            'no_telepon' => '081234567893',
            'email' => 'ani@siremo.com',
            'tgl_gabung' => now(),
        ]);
    }
}
