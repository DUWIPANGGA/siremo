<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MobilResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_mobil,
            'id_mobil' => $this->id_mobil,
            'nama_mobil' => $this->merek . ' ' . $this->model,
            'merek' => $this->merek,
            'model' => $this->model,
            'plat_nomor' => $this->plat_nomor,
            'tahun' => (int) $this->tahun,
            'warna' => $this->warna,
            'tarif' => (int) $this->tarif_sewa_per_hari,
            'status' => $this->status_ketersediaan,
            'kategori' => $this->kategori,
            'deskripsi' => $this->deskripsi,
            'foto_url' => $this->foto ? $request->getSchemeAndHttpHost() . '/storage/' . $this->foto : null,
            'rating' => $this->whenLoaded('ulasan', function () {
                return $this->ulasan->avg('rating') ? round((float) $this->ulasan->avg('rating'), 1) : 0.0;
            }),
            'fasilitas' => $this->whenLoaded('fasilitas', function () {
                return $this->fasilitas->pluck('nama_fasilitas');
            }),
        ];
    }
}
