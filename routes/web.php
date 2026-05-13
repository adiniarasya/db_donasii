<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PenjemputanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==============================================
// AUTH ROUTES (Gunakan Laravel Default)
// ==============================================
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// ==============================================
// GUEST ROUTES
// ==============================================
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ==============================================
// DONATUR ROUTES
// ==============================================
Route::middleware(['auth', 'role:donatur'])->prefix('donatur')->name('donatur.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Donatur\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/donasi/create', [App\Http\Controllers\Donatur\DonasiController::class, 'create'])->name('donasi.create');
    Route::post('/donasi/store', [App\Http\Controllers\Donatur\DonasiController::class, 'store'])->name('donasi.store');
    Route::get('/riwayat', [App\Http\Controllers\Donatur\DonasiController::class, 'riwayat'])->name('riwayat');
});

// ==============================================
// KURIR ROUTES
// ==============================================
Route::middleware(['auth', 'role:kurir'])->prefix('kurir')->name('kurir.')->group(function () {
    Route::get('/penjemputan', [App\Http\Controllers\Kurir\PenjemputanController::class, 'index'])->name('penjemputan');
    Route::post('/penjemputan/{id}/update-status', [App\Http\Controllers\Kurir\PenjemputanController::class, 'updateStatus'])->name('penjemputan.update');
});

// ==============================================
// ADMIN ROUTES
// ==============================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/donasi', [App\Http\Controllers\Admin\DonasiController::class, 'index'])->name('donasi.index');
    Route::get('/donasi/{id}', [App\Http\Controllers\Admin\DonasiController::class, 'show'])->name('donasi.show');
    Route::post('/donasi/{id}/verifikasi', [App\Http\Controllers\Admin\DonasiController::class, 'verifikasi'])->name('donasi.verifikasi');
    Route::post('/donasi/{id}/selesai', [App\Http\Controllers\Admin\DonasiController::class, 'selesai'])->name('donasi.selesai');
    Route::post('/donasi/{id}/tolak', [App\Http\Controllers\Admin\DonasiController::class, 'tolak'])->name('donasi.tolak');
    Route::post('/penjemputan/assign/{donasi_id}', [PenjemputanController::class, 'assign'])->name('penjemputan.assign');
    Route::get('/kurir', [App\Http\Controllers\Admin\KurirController::class, 'index'])->name('kurir.index');
    Route::get('/laporan', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
});

// Fallback
Route::fallback(function () {
    return redirect('/');
});

// routes/web.php - Tambahkan di group admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // ... route yang sudah ada
    
    // Manajemen Kurir (CRUD)
    Route::get('/kurir', [App\Http\Controllers\Admin\KurirController::class, 'index'])->name('kurir.index');
    Route::get('/kurir/create', [App\Http\Controllers\Admin\KurirController::class, 'create'])->name('kurir.create');
    Route::post('/kurir', [App\Http\Controllers\Admin\KurirController::class, 'store'])->name('kurir.store');
    Route::get('/kurir/{id}/edit', [App\Http\Controllers\Admin\KurirController::class, 'edit'])->name('kurir.edit');
    Route::put('/kurir/{id}', [App\Http\Controllers\Admin\KurirController::class, 'update'])->name('kurir.update');
    Route::delete('/kurir/{id}', [App\Http\Controllers\Admin\KurirController::class, 'destroy'])->name('kurir.destroy');
});

// routes/web.php - Tambahkan di group admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Manajemen Donasi
    Route::get('/donasi', [App\Http\Controllers\Admin\DonasiController::class, 'index'])->name('donasi.index');
    Route::get('/donasi/{id}', [App\Http\Controllers\Admin\DonasiController::class, 'show'])->name('donasi.show');
    Route::post('/donasi/{id}/verifikasi', [App\Http\Controllers\Admin\DonasiController::class, 'verifikasi'])->name('donasi.verifikasi');
    Route::post('/donasi/{id}/selesai', [App\Http\Controllers\Admin\DonasiController::class, 'selesai'])->name('donasi.selesai');
    Route::post('/donasi/{id}/tolak', [App\Http\Controllers\Admin\DonasiController::class, 'tolak'])->name('donasi.tolak');
    
    // Manajemen Penjemputan (TAMBAHKAN INI)
    Route::post('/penjemputan/assign/{donasi_id}', [App\Http\Controllers\Admin\PenjemputanController::class, 'assign'])->name('penjemputan.assign');
    Route::post('/penjemputan/{id}/update-status', [App\Http\Controllers\Admin\PenjemputanController::class, 'updateStatus'])->name('penjemputan.update-status');
    Route::get('/penjemputan', [App\Http\Controllers\Admin\PenjemputanController::class, 'index'])->name('penjemputan.index');
    Route::delete('/penjemputan/{id}', [App\Http\Controllers\Admin\PenjemputanController::class, 'destroy'])->name('penjemputan.destroy');
    
    // Manajemen Kurir (CRUD)
    Route::get('/kurir', [App\Http\Controllers\Admin\KurirController::class, 'index'])->name('kurir.index');
    Route::get('/kurir/create', [App\Http\Controllers\Admin\KurirController::class, 'create'])->name('kurir.create');
    Route::post('/kurir', [App\Http\Controllers\Admin\KurirController::class, 'store'])->name('kurir.store');
    Route::get('/kurir/{id}/edit', [App\Http\Controllers\Admin\KurirController::class, 'edit'])->name('kurir.edit');
    Route::put('/kurir/{id}', [App\Http\Controllers\Admin\KurirController::class, 'update'])->name('kurir.update');
    Route::delete('/kurir/{id}', [App\Http\Controllers\Admin\KurirController::class, 'destroy'])->name('kurir.destroy');
    
    // Laporan
    Route::get('/laporan', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
});