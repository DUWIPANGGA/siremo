<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * Mengambil daftar notifikasi untuk user yang sedang login
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $notifikasi = Notifikasi::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar notifikasi berhasil diambil',
            'data'    => $notifikasi
        ], 200);
    }

    /**
     * Menandai satu notifikasi sebagai sudah dibaca
     */
    public function markAsRead($id, Request $request)
    {
        $notifikasi = Notifikasi::where('id_notifikasi', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$notifikasi) {
            return response()->json([
                'success' => false,
                'message' => 'Notifikasi tidak ditemukan'
            ], 404);
        }

        $notifikasi->update(['dibaca' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil dibaca'
        ], 200);
    }
}