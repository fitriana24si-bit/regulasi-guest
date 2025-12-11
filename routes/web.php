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
| Static Pages
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');


Route::get('/about', function () {
    return view('pages.about');
})->name('about');

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', [RegnaController::class, 'dashboard'])->name('landing');

 Route::post('/login', [AuthController::class, 'login'])->name('login.post');
 Route::post('/register', [AuthController::class, 'register'])->name('register.post');
/*
|--------------------------------------------------------------------------
| Auth Guest Only
|--------------------------------------------------------------------------
*/
Route::prefix('guest')->middleware('guest')->group(function () {
    Route::get('/jenis/create', [RegnaController::class, 'jenisCreateGuest'])->name('guest.jenis.create');
    Route::post('/jenis/store', [RegnaController::class, 'jenisStoreGuest'])->name('guest.jenis.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

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
| User Management (FIXED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('users')->name('pages.user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
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
| Static Menu Pages
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/kategori', [RegnaController::class, 'kategori'])->name('kategori.index');
    Route::get('/dokumen', [RegnaController::class, 'dokumen'])->name('dokumen.index');
    Route::get('/riwayat', [RegnaController::class, 'riwayat'])->name('riwayat.index');
});

/*
|--------------------------------------------------------------------------
| Resources
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('kategori', Kategori::class);
    Route::resource('dokumen', Dokumen::class);
    Route::resource('warga', WargaController::class);
});

/*
|--------------------------------------------------------------------------
| Lampiran
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('lampiran', Lampiran::class);

    Route::get('/lampiran/{id}/download', [Lampiran::class, 'download'])
        ->name('lampiran.download');
});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/upload', [ProfileController::class, 'upload'])->name('profile.upload');
});
