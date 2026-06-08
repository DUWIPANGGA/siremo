<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mobil;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        $mobil = [
            ['merek' => 'Toyota', 'model' => 'Avanza 1.3 E', 'plat_nomor' => 'AB 1234 CD', 'tahun' => 2023, 'warna' => 'Putih', 'tarif_sewa_per_hari' => 350000, 'kategori' => 'Keluarga', 'deskripsi' => 'Mobil keluarga 7 seater, irit bahan bakar, cocok untuk perjalanan jauh.', 'status_ketersediaan' => 'Tersedia'],
            ['merek' => 'Daihatsu', 'model' => 'Xenia 1.3 R', 'plat_nomor' => 'AB 5678 EF', 'tahun' => 2023, 'warna' => 'Hitam', 'tarif_sewa_per_hari' => 350000, 'kategori' => 'Keluarga', 'deskripsi' => 'Mobil keluarga dengan kabin luas dan nyaman.', 'status_ketersediaan' => 'Tersedia'],
            ['merek' => 'Honda', 'model' => 'Brio Satya S', 'plat_nomor' => 'AB 9012 GH', 'tahun' => 2024, 'warna' => 'Merah', 'tarif_sewa_per_hari' => 250000, 'kategori' => 'City Car', 'deskripsi' => 'Mobil city car lincah, irit, dan mudah parkir.', 'status_ketersediaan' => 'Tersedia'],
            ['merek' => 'Toyota', 'model' => 'Calya 1.2 E', 'plat_nomor' => 'AB 3456 IJ', 'tahun' => 2023, 'warna' => 'Silver', 'tarif_sewa_per_hari' => 300000, 'kategori' => 'Keluarga', 'deskripsi' => 'MPV 7 seater dengan konsumsi BBM rendah.', 'status_ketersediaan' => 'Tersedia'],
            ['merek' => 'Mitsubishi', 'model' => 'Xpander Ultimate', 'plat_nomor' => 'AB 7890 KL', 'tahun' => 2024, 'warna' => 'Putih', 'tarif_sewa_per_hari' => 450000, 'kategori' => 'Keluarga', 'deskripsi' => 'SUV keluarga dengan desain modern dan fitur lengkap.', 'status_ketersediaan' => 'Tersedia'],
            ['merek' => 'Suzuki', 'model' => 'Ertiga Sport', 'plat_nomor' => 'AB 1111 MN', 'tahun' => 2023, 'warna' => 'Biru', 'tarif_sewa_per_hari' => 400000, 'kategori' => 'Keluarga', 'deskripsi' => 'MPV stylish dengan performa handal.', 'status_ketersediaan' => 'Tersedia'],
            ['merek' => 'Daihatsu', 'model' => 'Sigra 1.0 D', 'plat_nomor' => 'AB 2222 OP', 'tahun' => 2024, 'warna' => 'Hijau', 'tarif_sewa_per_hari' => 280000, 'kategori' => 'City Car', 'deskripsi' => 'City car irit harga terjangkau.', 'status_ketersediaan' => 'Tersedia'],
            ['merek' => 'Toyota', 'model' => 'Innova Reborn 2.0 G', 'plat_nomor' => 'AB 3333 QR', 'tahun' => 2024, 'warna' => 'Hitam', 'tarif_sewa_per_hari' => 600000, 'kategori' => 'Keluarga', 'deskripsi' => 'Mobil premium keluarga dengan kenyamanan maksimal.', 'status_ketersediaan' => 'Tersedia'],
            ['merek' => 'Honda', 'model' => 'Mobilio RS', 'plat_nomor' => 'AB 4444 ST', 'tahun' => 2023, 'warna' => 'Silver', 'tarif_sewa_per_hari' => 380000, 'kategori' => 'Keluarga', 'deskripsi' => 'Low MPV sporty dengan kabin luas.', 'status_ketersediaan' => 'Tersedia'],
            ['merek' => 'Isuzu', 'model' => 'Elf Long', 'plat_nomor' => 'AB 5555 UV', 'tahun' => 2022, 'warna' => 'Putih', 'tarif_sewa_per_hari' => 800000, 'kategori' => 'Bus/MiniBus', 'deskripsi' => 'Minibus 14 seater cocok untuk rombongan.', 'status_ketersediaan' => 'Tersedia'],
            ['merek' => 'Toyota', 'model' => 'Hiace Premio', 'plat_nomor' => 'AB 6666 WX', 'tahun' => 2023, 'warna' => 'Putih', 'tarif_sewa_per_hari' => 1200000, 'kategori' => 'Bus/MiniBus', 'deskripsi' => 'Minibus mewah 13 seater untuk perjalanan bisnis atau wisata.', 'status_ketersediaan' => 'Tersedia'],
            ['merek' => 'Hyundai', 'model' => 'Stargazer', 'plat_nomor' => 'AB 7777 YZ', 'tahun' => 2024, 'warna' => 'Abu-abu', 'tarif_sewa_per_hari' => 500000, 'kategori' => 'Keluarga', 'deskripsi' => 'MPV futuristik dengan fitur keselamatan terkini.', 'status_ketersediaan' => 'Tersedia'],
        ];

        foreach ($mobil as $data) {
            Mobil::create($data);
        }
    }
}
