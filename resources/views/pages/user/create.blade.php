@extends('layouts.guest.main')
@include('layouts.guest.js')
@section('title', 'Tambah User Baru')

@section('content')
<section class="section py-5" style="background: linear-gradient(135deg, #e3f2fd, #bbdefb, #90caf9); min-height: 100vh;">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow-lg border-0 rounded-4"
             style="max-width: 500px; width: 100%; background: #ffffffd8; backdrop-filter: blur(6px);">
            <div class="card-body p-5" data-aos="fade-up" data-aos-duration="800">

                <h3 class="fw-bold text-primary text-center mb-4">Tambah User Baru</h3>

                {{-- Pesan error --}}
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

                {{-- Form Create User --}}
                <form action="{{ route('pages.user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control rounded-pill"
                               value="{{ old('name') }}" placeholder="Masukkan nama" required>
                    </div>
                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" id="email" name="email" class="form-control rounded-pill"
                               value="{{ old('email') }}" placeholder="Masukkan email" required>
                    </div>
                    {{-- ROLE (SELECT) --}}
                    <div class="mb-3">
                        <label for="role" class="form-label fw-semibold">Role</label>
                        <select id="role" name="role" class="form-control rounded-pill" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    {{-- PROFILE IMAGE --}}
                    <div class="mb-3">
                        <label for="profile_image" class="form-label fw-semibold">Foto Profil (Opsional)</label>
                        <input type="file" id="profile_image" name="profile_image" class="form-control rounded-pill" accept="image/*">
                        <small class="text-muted">Maksimal 2MB. Format: JPG, JPEG, PNG</small>
                    </div>
                    {{-- PASSWORD --}}
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" id="password" name="password" class="form-control rounded-pill"
                               placeholder="Masukkan password" required>
                    </div>
                    {{-- KONFIRM PASSWORD --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control rounded-pill" placeholder="Ulangi password" required>
                    </div>
                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pages.user.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            ⬅️ Kembali
                        </a>

                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                            💾 Simpan User
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection
