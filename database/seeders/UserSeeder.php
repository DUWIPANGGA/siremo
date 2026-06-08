<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'superadmin',
            'name' => 'Super Admin',
            'email' => 'superadmin@siremo.com',
            'password' => Hash::make('password'),
            'no_telepon' => '081234567890',
            'role' => 'superadmin',
            'status' => 'aktif',
        ]);

        User::create([
            'username' => 'admin1',
            'name' => 'Admin Rental',
            'email' => 'admin@siremo.com',
            'password' => Hash::make('password'),
            'no_telepon' => '081234567891',
            'cabang_rental' => 'Cabang Utama',
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        User::create([
            'username' => 'penyewa1',
            'name' => 'Budi Santoso',
            'email' => 'budi@siremo.com',
            'password' => Hash::make('password'),
            'no_telepon' => '081234567892',
            'role' => 'penyewa',
            'status' => 'aktif',
        ]);

        User::create([
            'username' => 'penyewa2',
            'name' => 'Ani Permata',
            'email' => 'ani@siremo.com',
            'password' => Hash::make('password'),
            'no_telepon' => '081234567893',
            'role' => 'penyewa',
            'status' => 'aktif',
        ]);
    }
}
