<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegnaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;



// ================== Halaman Utama ==================
Route::get('/', [RegnaController::class, 'dashboard'])->name('dashboard');


// ================== Halaman Regna ==================
Route::prefix('jenis')->group(function () {
    Route::get('/', [RegnaController::class, 'jenis'])->name('jenis.index');
    Route::get('/create', [RegnaController::class, 'jenisCreate'])->name('jenis.create');
    Route::post('/store', [RegnaController::class, 'jenisStore'])->name('jenis.store');
    Route::get('/edit/{id}', [RegnaController::class, 'jenisEdit'])->name('jenis.edit');
    Route::put('/update/{id}', [RegnaController::class, 'jenisUpdate'])->name('jenis.update');
    Route::delete('/destroy/{id}', [RegnaController::class, 'jenisDestroy'])->name('jenis.destroy');
});

// ================== Routes untuk Guest ==================
Route::prefix('guest')->middleware('guest')->group(function () {
    Route::get('/jenis/create', [RegnaController::class, 'jenisCreateGuest'])->name('guest.jenis.create');
    Route::post('/jenis/store', [RegnaController::class, 'jenisStoreGuest'])->name('guest.jenis.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// ================== Logout ==================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ================== Halaman Lain ==================
Route::get('/kategori', [RegnaController::class, 'kategori'])->name('kategori.index');
Route::get('/dokumen', [RegnaController::class, 'dokumen'])->name('dokumen.index');
Route::get('/riwayat', [RegnaController::class, 'riwayat'])->name('riwayat.index');
Route::get('/lampiran', [RegnaController::class, 'lampiran'])->name('lampiran.index');

// ================== Resource Controller ==================
// Tampilkan semua data
Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
// Form tambah
Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
// Simpan data
Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
// Form edi
Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
// Update data
Route::put('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
Route::patch('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
// Hapus
Route::delete('/warga/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');
