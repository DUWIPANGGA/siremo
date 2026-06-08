<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';
    protected $fillable = ['nama_fasilitas'];

    public function mobil()
    {
        return $this->belongsToMany(Mobil::class, 'mobil_fasilitas', 'id_fasilitas', 'id_mobil');
    }
}
