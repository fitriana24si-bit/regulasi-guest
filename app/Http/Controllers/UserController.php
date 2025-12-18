<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
        }

        if ($request->role && $request->role != 'all') {
            $query->where('role', $request->role);
        }

        if ($request->status && $request->status != 'all') {
            if ($request->status == 'verified') {
                $query->whereNotNull('email_verified_at');
            } else {
                $query->whereNull('email_verified_at');
            }
        }

        if ($request->sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($request->sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($request->sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $users = $query->paginate($request->per_page ?? 10);

        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email',
            'role'          => 'required',
            'password'      => 'required|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
        }

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'role'          => $request->role,
            'password'      => Hash::make($request->password),
            'profile_image' => $path,
        ]);

        return redirect()->route('pages.user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        return view('pages.user.edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'role'          => 'required',
            'password'      => 'nullable|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Upload foto baru
        if ($request->hasFile('profile_image')) {
            // Hapus foto lama jika ada
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Simpan foto baru
            $data['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        // Hapus foto jika dicentang
        if ($request->has('remove_profile_image')) {
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $data['profile_image'] = null;
        }

        $user->update($data);

        return redirect()->route('pages.user.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus foto profil jika ada
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus!');
    }

    // =============================
// PROFILE USER (USER LOGIN)
// =============================
public function profile()
{
    return view('pages.user.profile', [
        'user' => auth()->user()
    ]);
}

public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name'  => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6|confirmed',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = [
        'name'  => $request->name,
        'email' => $request->email,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    if ($request->hasFile('profile_image')) {
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $data['profile_image'] = $request
            ->file('profile_image')
            ->store('profile_images', 'public');
    }

    $user->update($data);

    return back()->with('success', 'Profil berhasil diperbarui');
}

}
