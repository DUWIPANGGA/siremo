<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function getProfile(Request $request)
    {
        return response()->json([
            'message' => 'Profil berhasil diambil',
            'data' => $request->user()->load('penyewa')
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->update(['name' => $request->name]);

        $penyewa = $user->penyewa;
        if ($penyewa) {
            $updateData = [
                'no_telepon' => $request->telepon,
                'alamat' => $request->alamat,
            ];

            if ($request->hasFile('foto')) {
                if ($penyewa->foto_profile && Storage::disk('public')->exists($penyewa->foto_profile)) {
                    Storage::disk('public')->delete($penyewa->foto_profile);
                }
                $path = $request->file('foto')->store('profiles', 'public');
                $updateData['foto_profile'] = $path;
            }

            $penyewa->update($updateData);
        } else {
            \App\Models\Penyewa::create([
                'id_user' => $user->id_user,
                'nama' => $request->name,
                'no_telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'email' => $user->email,
                'tgl_gabung' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Profil berhasil diperbarui',
            'data' => $user->fresh()->load('penyewa')
        ], 200);
    }

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
