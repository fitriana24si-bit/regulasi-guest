@extends('layouts.guest.main')

@section('title', 'Edit Profil Saya')

@section('content')
<section class="section py-5" style="background: linear-gradient(135deg, #e8f5e9, #eec186, #dfcd84); min-height: 100vh;">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow-lg border-0 rounded-4"
             style="max-width: 500px; width: 100%; background: #ffffffd8; backdrop-filter: blur(8px);">
            <div class="card-body p-5">
                <h4 class="fw-bold text-center text-dark mb-4">🧑‍💻 Edit Profil Saya</h4>

                @if (session('success'))
                    <div class="alert alert-success rounded-pill text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control rounded-pill"
                            value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control rounded-pill"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru (Opsional)</label>
                        <input type="password" name="password" class="form-control rounded-pill">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control rounded-pill">
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('user') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            ← Kembali
                        </a>
                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm">
                            💾 Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
