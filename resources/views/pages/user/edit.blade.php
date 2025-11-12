@extends('layouts.guest.main')

@section('title', 'Edit Profil')

@section('content')
<section class="section py-5" style="background: linear-gradient(135deg, #fff3e0, #ffe0b2, #ffcc80); min-height: 100vh;">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow-lg border-0 rounded-4"
            style="max-width: 500px; width: 100%; background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(8px); transition: transform 0.4s;">

            <div class="card-body p-5" data-aos="fade-up" data-aos-duration="800">
                <h4 class="fw-bold text-center text-dark mb-4">✏️ Edit Profil Saya</h4>

                <form action="{{ route('user.update') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="name" id="name"
                            class="form-control rounded-pill shadow-sm px-4 py-2"
                            value="{{ Auth::user()->name }}" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Alamat Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control rounded-pill shadow-sm px-4 py-2"
                            value="{{ Auth::user()->email }}" required>
                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password Baru (opsional)</label>
                        <input type="password" name="password" id="password"
                            class="form-control rounded-pill shadow-sm px-4 py-2">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control rounded-pill shadow-sm px-4 py-2">
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('user') }}"
                            class="btn btn-outline-secondary rounded-pill px-4 fw-semibold shadow-sm"
                            style="transition: 0.3s; hover: transform: scale(1.05);">
                            ← Kembali
                        </a>
                        <button type="submit"
                            class="btn btn-warning rounded-pill px-4 fw-semibold shadow-sm"
                            style="transition: 0.3s; hover: transform: scale(1.05);">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Optional: Animasi hover card --}}
<style>
    .card:hover {
        transform: translateY(-5px);
    }

    input:focus {
        box-shadow: 0 0 10px rgba(255, 183, 77, 0.4);
        border-color: #ffb74d;
    }

    button:hover, .btn-outline-secondary:hover {
        transform: scale(1.05);
    }
</style>
@endsection
