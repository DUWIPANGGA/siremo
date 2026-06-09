<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index(Request $request)
    {
        $query = Mobil::orderBy('id_mobil', 'desc');

        // Filter by status ketersediaan
        if ($request->filled('status')) {
            $query->where('status_ketersediaan', $request->status);
        }

        // Filter by pencarian merek / model / plat
        if ($request->filled('search')) {
            $cari = $request->search;
            $query->where(function ($q) use ($cari) {
                $q->where('merek',      'like', "%{$cari}%")
                  ->orWhere('model',     'like', "%{$cari}%")
                  ->orWhere('plat_nomor','like', "%{$cari}%")
                  ->orWhere('kategori',  'like', "%{$cari}%");
            });
        }

        $kendaraan = $query->paginate(12)->withQueryString();

        return view('admin.kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function edit($id)
    {
        $kendaraan = Mobil::with('fasilitas')->findOrFail($id);
        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    public function store(Request $request)
{
    $request->validate([
        'merek' => 'required|string|max:100',
        'model' => 'required|string|max:100',
        'plat_nomor' => 'required|string|max:20|unique:mobil,plat_nomor',
        'tahun' => 'required|digits:4|integer',
        'warna' => 'required|string|max:50',
        'tarif_sewa_per_hari' => 'required|integer|min:0',
        'status_ketersediaan' => 'required|in:Tersedia,Disewa,Perawatan',
        'kategori' => 'nullable|string|max:100',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->except('foto', 'fasilitas');

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('mobil', 'public');
    }

    $mobil = Mobil::create($data);

    if ($request->has('fasilitas')) {
        $mobil->fasilitas()->sync($request->fasilitas);
    }

    return redirect()->route('admin.kendaraan.index')
        ->with('success', 'Kendaraan berhasil ditambahkan.');
}

public function update(Request $request, $id)
{
    $kendaraan = Mobil::findOrFail($id);

    $request->validate([
        'merek' => 'required|string|max:100',
        'model' => 'required|string|max:100',
        'plat_nomor' => 'required|string|max:20|unique:mobil,plat_nomor,'.$id.',id_mobil',
        'tahun' => 'required|digits:4|integer',
        'warna' => 'required|string|max:50',
        'tarif_sewa_per_hari' => 'required|integer|min:0',
        'status_ketersediaan' => 'required|in:Tersedia,Disewa,Perawatan',
        'kategori' => 'nullable|string|max:100',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->except('foto', 'fasilitas');

    if ($request->hasFile('foto')) {
        if ($kendaraan->foto && Storage::disk('public')->exists($kendaraan->foto)) {
            Storage::disk('public')->delete($kendaraan->foto);
        }
        $data['foto'] = $request->file('foto')->store('mobil', 'public');
    }

    // 1. Update data mobil
    $kendaraan->update($data);

    if ($request->has('fasilitas')) {
        $kendaraan->fasilitas()->sync($request->fasilitas);
    }

    return redirect()->route('admin.kendaraan.index')
        ->with('success', 'Kendaraan berhasil diperbarui.');
}

// Tambahkan ini di Admin\MobilController jika Anda butuh fitur lihat detail di dashboard admin
public function show($id)
{
    $mobil = Mobil::with('fasilitas')->findOrFail($id);
    return view('admin.kendaraan.show', compact('mobil'));
}

    public function destroy($id)
    {
        $kendaraan = Mobil::findOrFail($id);

        if ($kendaraan->foto && Storage::disk('public')->exists($kendaraan->foto)) {
            Storage::disk('public')->delete($kendaraan->foto);
        }

        $kendaraan->delete();

        return redirect()->route('admin.kendaraan.index')
            ->with('success', 'Kendaraan berhasil dihapus.');
    }
}