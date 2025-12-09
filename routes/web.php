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
| Halaman Statik
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', [RegnaController::class, 'dashboard'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Auth Guest Only
|--------------------------------------------------------------------------
*/
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
| Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| User Management
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Jenis (Regna)
|--------------------------------------------------------------------------
*/
Route::prefix('jenis')->middleware('auth')->group(function () {
    Route::get('/', [RegnaController::class, 'jenis'])->name('jenis.index');
    Route::get('/create', [RegnaController::class, 'jenisCreate'])->name('jenis.create');
    Route::post('/store', [RegnaController::class, 'jenisStore'])->name('jenis.store');
    Route::get('/edit/{id}', [RegnaController::class, 'jenisEdit'])->name('jenis.edit');
    Route::put('/update/{id}', [RegnaController::class, 'jenisUpdate'])->name('jenis.update');
    Route::delete('/destroy/{id}', [RegnaController::class, 'jenisDestroy'])->name('jenis.destroy');
});

/*
|--------------------------------------------------------------------------
| Halaman Kategori / Dokumen / Riwayat / Lampiran (Static View)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/kategori', [RegnaController::class, 'kategori'])->name('kategori.index');
    Route::get('/dokumen', [RegnaController::class, 'dokumen'])->name('dokumen.index');
    Route::get('/riwayat', [RegnaController::class, 'riwayat'])->name('riwayat.index');
});

/*
|--------------------------------------------------------------------------
| Resource: Kategori / Dokumen / Warga
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('kategori', Kategori::class);
    Route::resource('dokumen', Dokumen::class);
    Route::resource('warga', WargaController::class);
});

/*
|--------------------------------------------------------------------------
| Resource: Lampiran (CRUD LAMPIRAN)
|--------------------------------------------------------------------------
|
| Ini adalah route utama untuk upload / hapus / lihat lampiran
| NON-DUPLIKAT. Hanya pakai RESOURCE.
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::resource('lampiran', Lampiran::class)
        ->names([
            'index' => 'lampiran.index',
            'create' => 'lampiran.create',
            'store' => 'lampiran.store',
            'show' => 'lampiran.show',
            'edit' => 'lampiran.edit',
            'update' => 'lampiran.update',
            'destroy' => 'lampiran.destroy',
        ]);
});

Route::resource('lampiran', Lampiran::class);

Route::get('/lampiran/{id}/download', [Lampiran::class, 'download'])->name('lampiran.download');

Route::middleware(['auth'])->group(function () {
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/upload', [ProfileController::class, 'upload'])->name('profile.upload');
});
