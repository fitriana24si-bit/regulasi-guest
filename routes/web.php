<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegnaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;

// ================== Halaman Utama ==================
Route::get('/', [RegnaController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// ================== Halaman Regna ==================
Route::get('/jenis', [RegnaController::class, 'jenis'])->name('jenis.index');
Route::get('/jenis/create', [RegnaController::class, 'jenisCreate'])->name('jenis.create');
Route::post('/jenis/store', [RegnaController::class, 'jenisStore'])->name('jenis.store');
Route::get('/jenis/edit/{id}', [RegnaController::class, 'jenisEdit'])->name('jenis.edit');
Route::put('/jenis/update/{id}', [RegnaController::class, 'jenisUpdate'])->name('jenis.update');
Route::delete('/jenis/destroy/{id}', [RegnaController::class, 'jenisDestroy'])->name('jenis.destroy');

// ================== Routes untuk Guest ==================
Route::prefix('guest')->group(function () {
    Route::get('/jenis/create', [RegnaController::class, 'jenisCreateGuest'])->name('guest.jenis.create');
    Route::post('/jenis/store', [RegnaController::class, 'jenisStoreGuest'])->name('guest.jenis.store');
});

Route::get('/kategori', [RegnaController::class, 'kategori'])->name('kategori.index');
Route::get('/dokumen', [RegnaController::class, 'dokumen'])->name('dokumen.index');
Route::get('/riwayat', [RegnaController::class, 'riwayat'])->name('riwayat.index');
Route::get('/lampiran', [RegnaController::class, 'lampiran'])->name('lampiran.index');

// ================== Autentikasi ==================
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login.index')
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post')
    ->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register.index')
    ->middleware('guest');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.post')
    ->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ================== Resource Controller ==================
Route::resource('warga', WargaController::class);
