<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Penting untuk hapus/upload file
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    // GET /api/profile
    public function getProfile(Request $request)
    {
        return response()->json([
            'message' => 'Profil berhasil diambil',
            'data' => $request->user()->load('penyewa') 
        ], 200);
    }

    // POST /api/profile/update
    // Saya sarankan gunakan POST karena FormData (foto) paling stabil di method POST
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $penyewa = $user->penyewa;
        
        $request->validate([
            'name' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        // 1. Update Tabel Users
        $user->update(['name' => $request->name]);

        // 2. Update Tabel Penyewa (Telepon & Alamat)
        $penyewa->update([
            'no_telepon' => $request->telepon,
            'alamat' => $request->alamat
        ]);

        // 3. Logic Update Foto Profil
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($penyewa->foto_profile && Storage::disk('public')->exists($penyewa->foto_profile)) {
                Storage::disk('public')->delete($penyewa->foto_profile);
            }

            // Simpan foto baru ke folder 'profiles'
            $path = $request->file('foto')->store('profiles', 'public');
            $penyewa->update(['foto_profile' => $path]);
        }

        return response()->json([
            'message' => 'Profil berhasil diperbarui',
            'data' => $user->load('penyewa') // Kembalikan data terbaru agar UI Flutter langsung refresh
        ], 200);
    }

    // POST /api/profile/change-password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if (!Hash::check($request->current_password, $request->user()->password)) {
            return response()->json(['message' => 'Password lama salah'], 422);
        }

        $request->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json(['message' => 'Password berhasil diubah'], 200);
    }
}