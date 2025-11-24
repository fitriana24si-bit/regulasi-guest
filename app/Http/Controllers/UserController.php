<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');
        $status = $request->input('status');
        $sort = $request->input('sort', 'latest');
        $perPage = $request->input('per_page', 10);

        $users = User::query();

        // Search functionality
        if ($search) {
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($role && $role !== 'all') {
            $users->where('role', $role);
        }

        // Filter by status
        if ($status && $status !== 'all') {
            if ($status === 'verified') {
                $users->whereNotNull('email_verified_at');
            } elseif ($status === 'unverified') {
                $users->whereNull('email_verified_at');
            }
        }

        // Sorting
        switch ($sort) {
            case 'oldest':
                $users->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $users->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $users->orderBy('name', 'desc');
                break;
            default:
                $users->orderBy('created_at', 'desc');
        }

        $users = $users->paginate($perPage);

        return view('pages.user.index', compact('users', 'search', 'role', 'status', 'sort', 'perPage'));
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|string|in:admin,operator,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);

        // UPDATE ROUTE NAME
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|string|in:admin,operator,user',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // UPDATE ROUTE NAME
        return redirect()->route('user.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            // UPDATE ROUTE NAME
            return redirect()->route('user.index')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        // UPDATE ROUTE NAME
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
