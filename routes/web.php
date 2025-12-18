<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

use App\Http\Controllers\TransaksiController;
Route::resource('transaksi', TransaksiController::class);

use App\Http\Controllers\AnggaranController;
Route::resource('anggaran', AnggaranController::class);

