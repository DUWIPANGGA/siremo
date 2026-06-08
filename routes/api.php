<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MobilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UlasanController;
use App\Http\Controllers\Api\NotifikasiController;
use App\Http\Controllers\Api\DendaController;


// --- Public Routes (Tidak butuh token/login) ---
Route::post('/login', [AuthController::class, 'apiLogin']);
Route::post('/register', [AuthController::class, 'apiRegister']);

// --- Protected Routes (Wajib login/token) ---
Route::middleware('auth:sanctum')->group(function () {
    // User Profile
    Route::get('/profile', [UserController::class, 'getProfile']);
    Route::put('/profile/update', [UserController::class, 'updateProfile']);
    Route::post('/profile/update', [UserController::class, 'updateProfile']);
    Route::post('/profile/change-password', [UserController::class, 'changePassword']);

    // Mobil
    Route::get('/mobil', [MobilController::class, 'index']);
    Route::get('/mobil/{id}', [MobilController::class, 'show']);

    // Booking / Transaksi
    Route::post('/booking', [TransaksiController::class, 'storeApi']);
    Route::get('/my-bookings', [TransaksiController::class, 'indexApi']);

    //Ulasan
    Route::get('/ulasan/{id_mobil}', [UlasanController::class, 'index']);
    Route::post('/ulasan', [UlasanController::class, 'store']);

    // Notifikasi
    Route::get('/notifikasi', [NotifikasiController::class, 'index']);
    Route::put('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead']);

    // Pembatalan
    Route::post('/booking/{id}/cancel', [TransaksiController::class, 'cancelBookingApi']);

    // Pencarian
    Route::get('/mobil/search', [MobilController::class, 'search']);

    // Denda
    Route::get('/my-denda', [DendaController::class, 'indexApi']);
});

