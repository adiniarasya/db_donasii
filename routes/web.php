<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonasiController;
use App\Http\Controllers\Admin\KurirController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PenjemputanController;
use App\Http\Controllers\Donatur\DashboardController as DonaturDashboardController;
use App\Http\Controllers\Donatur\DonasiController as DonaturDonasiController;
use App\Http\Controllers\Kurir\PenjemputanController as KurirPenjemputanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// AUTH ROUTES
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// LANDING PAGE
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// DONATUR ROUTES
Route::middleware(['auth', 'role:donatur'])->prefix('donatur')->name('donatur.')->group(function () {
    Route::get('/dashboard', [DonaturDashboardController::class, 'index'])->name('dashboard');
    Route::get('/donasi/create', [DonaturDonasiController::class, 'create'])->name('donasi.create');
    Route::post('/donasi/store', [DonaturDonasiController::class, 'store'])->name('donasi.store');
    Route::get('/riwayat', [DonaturDonasiController::class, 'riwayat'])->name('riwayat');
});

// KURIR ROUTES
Route::middleware(['auth', 'role:kurir'])->prefix('kurir')->name('kurir.')->group(function () {
    Route::get('/penjemputan', [KurirPenjemputanController::class, 'index'])->name('penjemputan');
    Route::get('/profil', [KurirPenjemputanController::class, 'profil'])->name('profil');
    Route::post('/profil', [KurirPenjemputanController::class, 'updateProfil'])->name('profil.update');
    Route::post('/penjemputan/{id}/update-status', [KurirPenjemputanController::class, 'updateStatus'])->name('penjemputan.update');
});

// ADMIN ROUTES
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
    Route::get('/donasi/{id}', [DonasiController::class, 'show'])->name('donasi.show');
    Route::post('/donasi/{id}/verifikasi', [DonasiController::class, 'verifikasi'])->name('donasi.verifikasi');
    Route::post('/donasi/{id}/selesai', [DonasiController::class, 'selesai'])->name('donasi.selesai');
    Route::post('/donasi/{id}/tolak', [DonasiController::class, 'tolak'])->name('donasi.tolak');
    Route::get('/penjemputan', [PenjemputanController::class, 'index'])->name('penjemputan.index');
    Route::post('/penjemputan/assign/{donasi_id}', [PenjemputanController::class, 'assign'])->name('penjemputan.assign');
    Route::post('/penjemputan/{id}/update-status', [PenjemputanController::class, 'updateStatus'])->name('penjemputan.update-status');
    Route::delete('/penjemputan/{id}', [PenjemputanController::class, 'destroy'])->name('penjemputan.destroy');
    Route::get('/kurir', [KurirController::class, 'index'])->name('kurir.index');
    Route::get('/kurir/create', [KurirController::class, 'create'])->name('kurir.create');
    Route::post('/kurir', [KurirController::class, 'store'])->name('kurir.store');
    Route::get('/kurir/{id}/edit', [KurirController::class, 'edit'])->name('kurir.edit');
    Route::put('/kurir/{id}', [KurirController::class, 'update'])->name('kurir.update');
    Route::delete('/kurir/{id}', [KurirController::class, 'destroy'])->name('kurir.destroy');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak-pdf/{periode}', [LaporanController::class, 'cetakPDF'])->name('laporan.pdf');
});

// FALLBACK
Route::fallback(function () {
    return redirect('/');
});