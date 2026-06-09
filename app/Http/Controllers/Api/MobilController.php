<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Http\Resources\MobilResource;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function indexApi()
    {
        $mobil = Mobil::with('fasilitas', 'ulasan')->where('status_ketersediaan', 'Tersedia')->get();
        return MobilResource::collection($mobil);
    }

    public function show($id)
    {
        $mobil = Mobil::with('fasilitas', 'ulasan')->find($id);

        if (!$mobil) {
            return response()->json(['message' => 'Mobil tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Detail mobil berhasil diambil',
            'data' => new MobilResource($mobil)
        ], 200);
    }

    public function search(Request $request)
    {
        $query = Mobil::with('fasilitas', 'ulasan')->where('status_ketersediaan', 'Tersedia');

        if ($request->has('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('merek', 'like', '%' . $keyword . '%')
                  ->orWhere('model', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $mobil = $query->get();

        return MobilResource::collection($mobil);
    }
}
