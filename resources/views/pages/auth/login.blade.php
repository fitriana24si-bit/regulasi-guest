@extends('layouts.guest.main')

@section('title', 'Login')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #ffe093 0%, #e17816 100%);
        font-family: 'Poppins', sans-serif;
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
    }

    .login-card {
        width: 400px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 40px;
        transition: 0.3s ease;
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .login-title {
        font-weight: 600;
        color: #2f3542;
        text-align: center;
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 500;
        color: #4a4a4a;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ccc;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #91c8ff;
        box-shadow: 0 0 5px rgba(145, 200, 255, 0.5);
    }

    .btn-login {
        background: linear-gradient(90deg, #0d4ba8, #6798e7);
        border: none;
        border-radius: 10px;
        padding: 10px;
        font-weight: 600;
        color: white;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: linear-gradient(90deg, #154580, #8fc1ff);
        transform: translateY(-2px);
    }

    .form-check-label {
        color: #555;
    }

    .text-muted a {
        color: #19498c;
        text-decoration: none;
        font-weight: 500;
    }

    .text-muted a:hover {
        text-decoration: underline;
    }

    .alert {
        border-radius: 10px;
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <h4 class="login-title">Selamat Datang 👋</h4>

        {{-- Notifikasi Error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" required autofocus>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-login w-100">Masuk</button>
        </form>

        <div class="text-center text-muted mt-3">
            Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>
</div>
@endsection
