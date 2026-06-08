<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Http\Resources\MobilResource;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    // API untuk daftar semua mobil
    public function indexApi()
    {
        $mobil = Mobil::where('status_ketersediaan', 'Tersedia')->get();
        return response()->json(['data' => $mobil], 200);
    }

    // API untuk detail mobil
    public function show($id)
    {
        $mobil = Mobil::with('fasilitas')->find($id);

        if (!$mobil) {
            return response()->json(['message' => 'Mobil tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Detail mobil berhasil diambil',
            'data' => $mobil
        ], 200);
    }

    public function search(Request $request)
{
    $query = Mobil::query();

    if ($request->has('q')) {
        $query->where('nama_mobil', 'like', '%' . $request->q . '%')
              ->orWhere('merek', 'like', '%' . $request->q . '%');
    }

    if ($request->has('kategori')) {
        $query->where('kategori', $request->kategori);
    }

    $mobil = $query->where('status_ketersediaan', 'Tersedia')->get();

    return response()->json(['data' => $mobil]);
}
}
