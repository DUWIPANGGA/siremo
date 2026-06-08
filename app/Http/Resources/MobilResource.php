<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MobilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id_mobil, // Mengikuti id_mobil di migrasi Anda
        'nama_mobil' => $this->merek . ' ' . $this->model,
        'merek' => $this->merek,
        'model' => $this->model,
        'plat_nomor' => $this->plat_nomor,
        'tarif' => $this->tarif_sewa_per_hari,
        'status' => $this->status_ketersediaan,
        'kategori' => $this->kategori,
        'foto_url' => $this->foto ? url('storage/' . $this->foto) : null,
    ];
    }
}
