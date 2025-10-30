@extends('layouts.main')

@section('title', 'Daftar Akun | Regna')

@section('content')
<section id="register" class="min-vh-100 d-flex align-items-center justify-content-center py-5"
         style="background: linear-gradient(135deg, #f8fbff 0%, #e9f0ff 100%);">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-primary mb-1">Daftar Akun Baru</h3>
                            <p class="text-muted small">Silakan isi data di bawah ini untuk membuat akun baru.</p>
                        </div>

                        {{-- Notifikasi Error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger small">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Form --}}
                        <form action="{{ route('register.post') }}" method="POST" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                <input id="name" type="text" name="name"
                                       value="{{ old('name') }}"
                                       class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                        required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input id="email" type="email" name="email"
                                       value="{{ old('email') }}"
                                       class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                        required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-semibold">Kata Sandi</label>
                                    <input id="password" type="password" name="password"
                                           class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror"
                                            required>
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                           class="form-control form-control-lg rounded-3"
                                            required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-4 py-2 rounded-3 fw-semibold">
                                <i class="bi bi-person-plus me-1"></i> Daftar Sekarang
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <small class="text-muted">Sudah punya akun?
                                <a href="{{ route('login.index') }}" class="text-decoration-none text-primary fw-semibold">
                                    Masuk di sini
                                </a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            background: #ffffff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
        }
    </style>
</section>
@endsection
