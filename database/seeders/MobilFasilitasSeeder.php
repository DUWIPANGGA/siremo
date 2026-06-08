<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MobilFasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_mobil' => 1, 'id_fasilitas' => 1], ['id_mobil' => 1, 'id_fasilitas' => 2], ['id_mobil' => 1, 'id_fasilitas' => 3],
            ['id_mobil' => 1, 'id_fasilitas' => 6], ['id_mobil' => 1, 'id_fasilitas' => 10], ['id_mobil' => 1, 'id_fasilitas' => 11],
            ['id_mobil' => 2, 'id_fasilitas' => 1], ['id_mobil' => 2, 'id_fasilitas' => 2], ['id_mobil' => 2, 'id_fasilitas' => 6],
            ['id_mobil' => 2, 'id_fasilitas' => 10], ['id_mobil' => 2, 'id_fasilitas' => 11],
            ['id_mobil' => 3, 'id_fasilitas' => 1], ['id_mobil' => 3, 'id_fasilitas' => 2], ['id_mobil' => 3, 'id_fasilitas' => 6],
            ['id_mobil' => 3, 'id_fasilitas' => 11],
            ['id_mobil' => 4, 'id_fasilitas' => 1], ['id_mobil' => 4, 'id_fasilitas' => 2], ['id_mobil' => 4, 'id_fasilitas' => 6],
            ['id_mobil' => 4, 'id_fasilitas' => 10], ['id_mobil' => 4, 'id_fasilitas' => 11],
            ['id_mobil' => 5, 'id_fasilitas' => 1], ['id_mobil' => 5, 'id_fasilitas' => 2], ['id_mobil' => 5, 'id_fasilitas' => 3],
            ['id_mobil' => 5, 'id_fasilitas' => 4], ['id_mobil' => 5, 'id_fasilitas' => 6], ['id_mobil' => 5, 'id_fasilitas' => 7],
            ['id_mobil' => 5, 'id_fasilitas' => 8], ['id_mobil' => 5, 'id_fasilitas' => 9], ['id_mobil' => 5, 'id_fasilitas' => 10],
            ['id_mobil' => 5, 'id_fasilitas' => 11], ['id_mobil' => 5, 'id_fasilitas' => 12],
            ['id_mobil' => 6, 'id_fasilitas' => 1], ['id_mobil' => 6, 'id_fasilitas' => 2], ['id_mobil' => 6, 'id_fasilitas' => 6],
            ['id_mobil' => 6, 'id_fasilitas' => 10], ['id_mobil' => 6, 'id_fasilitas' => 11],
            ['id_mobil' => 7, 'id_fasilitas' => 1], ['id_mobil' => 7, 'id_fasilitas' => 2], ['id_mobil' => 7, 'id_fasilitas' => 11],
            ['id_mobil' => 8, 'id_fasilitas' => 1], ['id_mobil' => 8, 'id_fasilitas' => 2], ['id_mobil' => 8, 'id_fasilitas' => 3],
            ['id_mobil' => 8, 'id_fasilitas' => 4], ['id_mobil' => 8, 'id_fasilitas' => 6], ['id_mobil' => 8, 'id_fasilitas' => 7],
            ['id_mobil' => 8, 'id_fasilitas' => 8], ['id_mobil' => 8, 'id_fasilitas' => 10], ['id_mobil' => 8, 'id_fasilitas' => 11],
            ['id_mobil' => 8, 'id_fasilitas' => 12],
            ['id_mobil' => 9, 'id_fasilitas' => 1], ['id_mobil' => 9, 'id_fasilitas' => 2], ['id_mobil' => 9, 'id_fasilitas' => 6],
            ['id_mobil' => 9, 'id_fasilitas' => 10], ['id_mobil' => 9, 'id_fasilitas' => 11],
            ['id_mobil' => 10, 'id_fasilitas' => 1], ['id_mobil' => 10, 'id_fasilitas' => 5], ['id_mobil' => 10, 'id_fasilitas' => 6],
            ['id_mobil' => 10, 'id_fasilitas' => 10],
            ['id_mobil' => 11, 'id_fasilitas' => 1], ['id_mobil' => 11, 'id_fasilitas' => 2], ['id_mobil' => 11, 'id_fasilitas' => 3],
            ['id_mobil' => 11, 'id_fasilitas' => 6], ['id_mobil' => 11, 'id_fasilitas' => 10], ['id_mobil' => 11, 'id_fasilitas' => 12],
            ['id_mobil' => 12, 'id_fasilitas' => 1], ['id_mobil' => 12, 'id_fasilitas' => 2], ['id_mobil' => 12, 'id_fasilitas' => 3],
            ['id_mobil' => 12, 'id_fasilitas' => 4], ['id_mobil' => 12, 'id_fasilitas' => 6], ['id_mobil' => 12, 'id_fasilitas' => 7],
            ['id_mobil' => 12, 'id_fasilitas' => 8], ['id_mobil' => 12, 'id_fasilitas' => 9],
            ['id_mobil' => 12, 'id_fasilitas' => 10], ['id_mobil' => 12, 'id_fasilitas' => 11], ['id_mobil' => 12, 'id_fasilitas' => 12],
        ];

        DB::table('mobil_fasilitas')->insert($data);
    }
}
