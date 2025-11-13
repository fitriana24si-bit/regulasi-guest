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

    public function showAllUsers()
{
    $users = \App\Models\User::orderBy('name')->get();
    $currentUser = auth()->user();

    return view('pages.user', compact('users', 'currentUser'));


}

    // Edit user lain (bukan user login)
    public function editUser($id)
{
    $user = User::findOrFail($id);
    return view('pages.user.edit', compact('user'));
}

// Update user lain
public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'nullable|confirmed|min:6',
    ]);

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    } else {
        unset($data['password']);
    }

    $user->update($data);
    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
}

// Hapus user lain
public function destroyUser($id)
{
    $user = User::findOrFail($id);

    // pastikan tidak bisa hapus diri sendiri
    if (Auth::id() == $user->id) {
        return back()->with('error', 'Kamu tidak bisa menghapus akun kamu sendiri.');
    }

    $user->delete();
    return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
}
// Edit profil user login
public function editProfile()
{
    $user = auth()->user();
    return view('pages.user.edit-profile', compact('user'));
}


// Update profil user login
public function updateProfile(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|confirmed|min:6',
    ]);

    if (!empty($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
    } else {
        unset($validated['password']);
    }

    $user->update($validated);

    return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
}


}
