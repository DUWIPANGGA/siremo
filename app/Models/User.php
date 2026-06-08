<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // Cukup satu baris ini saja, tidak boleh ada Notifiable ganda
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id_user'; // Sesuaikan dengan nama kolom PK Anda di database
    public $incrementing = true; // Jika auto-increment
    protected $keyType = 'int';
    protected $table = 'users'; 
    //public $timestamps = false;
    
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'role',
        'no_telepon',    // Tambahkan ini
        'cabang_rental', // Tambahkan ini
        'alamat',        // Tambahkan ini
        'status',        // Tambahkan ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function transaksi() {
    return $this->hasMany(TransaksiSewa::class, 'id_penyewa', 'id_penyewa');
}
// app/Models/User.php
public function penyewa()
{
    // Pastikan foreign key sesuai dengan yang ada di migrasi
    return $this->hasOne(Penyewa::class, 'id_user', 'id_user');
}
}