<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegnaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\Kategori;
use App\Http\Controllers\Dokumen;
use App\Http\Controllers\Lampiran;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Tidak Perlu Login)
|--------------------------------------------------------------------------
*/
Route::get('/', [RegnaController::class, 'dashboard'])->name('landing');


Route::prefix('guest')->middleware('guest')->group(function () {
    Route::get('/jenis/create', [RegnaController::class, 'jenisCreateGuest'])->name('guest.jenis.create');
    Route::post('/jenis/store', [RegnaController::class, 'jenisStoreGuest'])->name('guest.jenis.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| Static Pages (Public)
|--------------------------------------------------------------------------
*/
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

/*
|--------------------------------------------------------------------------
| Logout (Harus Login)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth.check');

/*
|--------------------------------------------------------------------------
| Dashboard - Untuk Semua yang Sudah Login
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard')->middleware('auth.check');

/*
|--------------------------------------------------------------------------
| User Management - HANYA ADMIN (CRUD Lengkap)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:admin'])->prefix('users')->name('pages.user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Jenis (Regna) - USER: lihat, ADMIN: CRUD
|--------------------------------------------------------------------------
*/
Route::prefix('jenis')->middleware(['auth.check'])->group(function () {
    // Semua bisa lihat index
    Route::get('/', [RegnaController::class, 'jenis'])->name('jenis.index');

    // Hanya admin yang bisa CRUD
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/create', [RegnaController::class, 'jenisCreate'])->name('jenis.create');
        Route::post('/store', [RegnaController::class, 'jenisStore'])->name('jenis.store');
        Route::get('/edit/{id}', [RegnaController::class, 'jenisEdit'])->name('jenis.edit');
        Route::put('/update/{id}', [RegnaController::class, 'jenisUpdate'])->name('jenis.update');
        Route::delete('/destroy/{id}', [RegnaController::class, 'jenisDestroy'])->name('jenis.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Kategori - USER: lihat, ADMIN: CRUD
|--------------------------------------------------------------------------
*/
Route::prefix('kategori')->middleware(['auth.check'])->group(function () {
    Route::get('/', [Kategori::class, 'index'])->name('kategori.index');

    // Hanya admin yang bisa CRUD
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/create', [Kategori::class, 'create'])->name('kategori.create');
        Route::post('/', [Kategori::class, 'store'])->name('kategori.store');
        Route::get('/{kategori}/edit', [Kategori::class, 'edit'])->name('kategori.edit');
        Route::put('/{kategori}', [Kategori::class, 'update'])->name('kategori.update');
        Route::delete('/{kategori}', [Kategori::class, 'destroy'])->name('kategori.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Dokumen - USER: lihat, ADMIN: CRUD
|--------------------------------------------------------------------------
*/
Route::prefix('dokumen')->middleware(['auth.check'])->group(function () {
    // index
    Route::get('/', [Dokumen::class, 'index'])->name('dokumen.index');

    // ADMIN
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/create', [Dokumen::class, 'create'])->name('dokumen.create');
        Route::post('/', [Dokumen::class, 'store'])->name('dokumen.store');
        Route::get('/{dokumen}/edit', [Dokumen::class, 'edit'])->name('dokumen.edit');
        Route::put('/{dokumen}', [Dokumen::class, 'update'])->name('dokumen.update');
        Route::delete('/{dokumen}', [Dokumen::class, 'destroy'])->name('dokumen.destroy');
    });

    // show HARUS PALING BAWAH
    Route::get('/{dokumen}', [Dokumen::class, 'show'])->name('dokumen.show');
});



/*
|--------------------------------------------------------------------------
| Warga - USER: lihat, ADMIN: CRUD
|--------------------------------------------------------------------------
*/
Route::prefix('warga')->middleware(['auth.check'])->group(function () {
    Route::get('/', [WargaController::class, 'index'])->name('warga.index');

    // Hanya admin yang bisa CRUD
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/create', [WargaController::class, 'create'])->name('warga.create');
        Route::post('/', [WargaController::class, 'store'])->name('warga.store');
        Route::get('/{warga}/edit', [WargaController::class, 'edit'])->name('warga.edit');
        Route::put('/{warga}', [WargaController::class, 'update'])->name('warga.update');
        Route::delete('/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Lampiran - Untuk User dan Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:user,admin'])->group(function () {
    Route::resource('lampiran', Lampiran::class);
    Route::get('/lampiran/{id}/download', [Lampiran::class, 'download'])
        ->name('lampiran.download');
});

/*
|--------------------------------------------------------------------------
| Profile - Untuk User dan Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:user,admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/upload', [ProfileController::class, 'upload'])->name('profile.upload');
});

/*
|--------------------------------------------------------------------------
| Riwayat - Untuk User dan Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:user,admin'])->group(function () {
    Route::get('/riwayat', [RegnaController::class, 'riwayat'])->name('riwayat.index');
});

