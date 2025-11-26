<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegnaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\Kategori;
use App\Http\Controllers\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Route: Halaman Statik
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

/*
|--------------------------------------------------------------------------
| Route: Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', [RegnaController::class, 'dashboard'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Route: Auth (Guest Only)
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
| Route: Logout (Auth Only)
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Route: User Management (Auth Only) → PAKAI RESOURCE
|--------------------------------------------------------------------------
|  users.index
|  users.create
|  users.store
|  users.edit
|  users.update
|  users.destroy
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class)->except(['show']);

    // Edit profil user login
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');

    // Update profil user login
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Route: Jenis (Regna)
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
| Route: Kategori / Dokumen / Riwayat / Lampiran
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
Route::get('/kategori', [RegnaController::class, 'kategori'])->name('kategori.index');
Route::get('/dokumen', [RegnaController::class, 'dokumen'])->name('dokumen.index');
Route::get('/riwayat', [RegnaController::class, 'riwayat'])->name('riwayat.index');
Route::get('/lampiran', [RegnaController::class, 'lampiran'])->name('lampiran.index');
});
/*
|--------------------------------------------------------------------------
| Resource: Kategori & Dokumen & Warga
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
Route::resource('kategori', Kategori::class);
Route::resource('dokumen', Dokumen::class);
Route::resource('warga', WargaController::class);
});
