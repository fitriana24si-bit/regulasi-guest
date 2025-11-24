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

// ================== Halaman About ==================
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// ================== Halaman User ==================
Route::middleware('auth')->group(function () {

    // 🔹 Tampilkan profil user login + daftar semua user
    Route::get('/user', function () {
        $user = Auth::user();      // user yang sedang login
        $users = User::all();      // semua user terdaftar
        return view('pages.user', compact('user', 'users'));
    })->name('user');

    // 🔹 Edit profil user login
    Route::get('/user/edit', function () {
        $user = Auth::user();
        return view('pages.user.edit', compact('user'));
    })->name('user.edit');

    // 🔹 Update profil user login
    Route::post('/user/update', function (Request $request) {
        $user = Auth::user();

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'nullable|confirmed|min:6',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user')->with('success', 'Profil berhasil diperbarui!');
    })->name('user.update');
});

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

// ================== Resource Controller (Warga) ==================
Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
Route::put('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
Route::patch('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
Route::delete('/warga/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');

// ================== User Management dengan Pagination & Filter ==================
Route::resource('users', UserController::class)->except(['show']);

// Edit profil user login
Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');

// Update profil user login
Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

// Route untuk Kategori
Route::resource('kategori', Kategori::class);

// Route untuk Dokumen
Route::resource('dokumen', Dokumen::class);

