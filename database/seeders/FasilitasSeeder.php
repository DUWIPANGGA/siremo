<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fasilitas;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $fasilitas = [
            'AC', 'Bluetooth', 'GPS', 'USB Port', 'Ban Cadangan',
            'Airbags', 'Parking Sensor', 'Rear Camera', 'Sunroof',
            'Power Windows', 'Central Lock', 'Audio System',
        ];

        foreach ($fasilitas as $nama) {
            Fasilitas::create(['nama_fasilitas' => $nama]);
        }
    }
}
