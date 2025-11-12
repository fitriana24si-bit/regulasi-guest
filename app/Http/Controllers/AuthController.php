<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    // tampilkan form login
    public function showLogin()
    {
        return view('pages.auth.login'); // Sesuaikan path
    }

    // proses login
   public function login(Request $request)
{
    $request->validate([
        'email' => ['required','email'],
        'password' => ['required'],
    ]);

    // cari user berdasarkan email
    $user = User::where('email', $request->email)->first();

    // cek user dan verifikasi password dengan Hash::check
    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('success', 'Berhasil login!');

    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}


    // tampilkan form register
    public function showRegister()
    {
        return view('pages.auth.register'); // Sesuaikan path
    }

    // proses registrasi
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        // Redirect ke dashboard admin setelah register
        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat!');

    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
       return redirect()->route('login')->with('success', 'Anda telah logout.');


    }

}
