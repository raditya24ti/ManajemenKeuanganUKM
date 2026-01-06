<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AuthController;

// --- AKSES PUBLIK (Bisa diakses tanpa login) ---
Route::get('/', function () {
    return view('welcome');
});

// Guest Login - Harus di luar middleware auth agar bisa diklik saat belum login
Route::get('/guest-login', [AuthController::class, 'guestLogin'])->name('login.guest');

// Login & Register
Route::get('/auth', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Dashboard - Dipindah ke sini agar Tamu bisa melihat tanpa terlempar balik ke login
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// --- AKSES TERPROTEKSI (Harus Login) ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route untuk Superadmin
    Route::middleware('role:superadmin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('anggaran', AnggaranController::class);
    });

    // Route untuk Superadmin dan Staff
    Route::middleware('role:superadmin,staff')->group(function () {
        Route::resource('transaksi', TransaksiController::class);
    });
});