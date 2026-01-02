<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
Route::resource('users', UserController::class);

use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', function () {
    return view ('welcome');
});

use App\Http\Controllers\TransaksiController;
Route::resource('transaksi', TransaksiController::class);

use App\Http\Controllers\AnggaranController;
Route::resource('anggaran', AnggaranController::class);

use App\Http\Controllers\AuthController;
    // Login
    Route::get('/auth', [AuthController::class, 'index'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'login'])->name('login.process');

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//   Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
});


Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('users', UserController::class);
});


Route::middleware(['auth', 'role:superadmin,staff'])->group(function () {
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('anggaran', AnggaranController::class);
});


