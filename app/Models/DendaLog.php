<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DendaLog extends Model
{
    // Sesuaikan nama tabel jika berbeda (misal: denda_logs atau denda_log)
    protected $table = 'denda_log'; 
    protected $primaryKey = 'id_denda';

    protected $fillable = [
        'id_transaksi',
        'jumlah_denda',
        'keterangan',
        'tanggal_denda',
    ];

    protected $casts = [
        'tanggal_denda' => 'datetime',
        'jumlah_denda'  => 'integer',
    ];

    // Relasi ke Transaksi: Satu denda milik satu transaksi
    public function transaksi()
    {
        return $this->belongsTo(TransaksiSewa::class, 'id_transaksi', 'id_transaksi');
    }
}