@extends('layouts.guest.main')

@section('title', 'Edit Data User')

@section('content')
    <section class="section py-5" style="background: linear-gradient(135deg, #e8f5e9, #eec186, #dfcd84); min-height: 100vh;">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="card shadow-lg border-0 rounded-4"
                style="max-width: 500px; width: 100%; background: #ffffffd8; backdrop-filter: blur(8px);">
                <div class="card-body p-5">

                    <h4 class="fw-bold text-center text-dark mb-4">✏️ Edit User Lain</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pages.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- NAMA --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control rounded-pill"
                                value="{{ old('name', $user->name) }}" required>
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control rounded-pill"
                                value="{{ old('email', $user->email) }}" required>
                        </div>

                        {{-- ROLE --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Role</label>
                            <select name="role" class="form-control rounded-pill" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                    User
                                </option>
                            </select>
                        </div>

                        {{-- PROFILE IMAGE --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Foto Profil (Opsional)</label>
                            <input type="file" name="profile_image" class="form-control rounded-pill" accept="image/*">
                            <small class="text-muted">Maksimal 2MB. Format: JPG, JPEG, PNG</small>

                            @if ($user->profile_image)
                                <div class="mt-2">
                                    <small class="text-muted">Foto saat ini:</small><br>
                                    <img src="{{ $user->profile_image_url }}" width="100"
                                        class="mt-2 rounded-circle border" style="border-color:#ffcc66;">

                                    <br>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" name="remove_profile_image" value="1"
                                            id="remove_profile_image" class="form-check-input">
                                        <label for="remove_profile_image" class="form-check-label text-danger">
                                            Hapus foto profil
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- PASSWORD BARU --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password Baru (Opsional)</label>
                            <input type="password" name="password" class="form-control rounded-pill"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control rounded-pill"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        {{-- TOMBOL --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('pages.user.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                ← Kembali
                            </a>

                            <button type="submit" class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm">
                                💾 Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
