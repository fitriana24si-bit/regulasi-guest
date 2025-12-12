@extends('layouts.guest.main')

@section('title', 'Daftar Akun Baru')

@section('content')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%);
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow-x: hidden;
    }

    /* Animated Background Circles */
    body::before,
    body::after {
        content: '';
        position: fixed;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 8s ease-in-out infinite;
    }

    body::before {
        width: 500px;
        height: 500px;
        top: -250px;
        right: -250px;
        animation-delay: 0s;
    }

    body::after {
        width: 400px;
        height: 400px;
        bottom: -200px;
        left: -200px;
        animation-delay: 2s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 0.3;
        }
        50% {
            transform: translateY(-30px) rotate(10deg);
            opacity: 0.5;
        }
    }

    .register-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
        position: relative;
        z-index: 1;
    }

    .register-card {
        width: 100%;
        max-width: 550px;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(30px);
        border-radius: 30px;
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3), 0 10px 30px rgba(0, 0, 0, 0.2);
        padding: 50px 45px;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        animation: slideUp 0.8s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .logo {
        text-align: center;
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .logo-wrapper {
        position: relative;
        display: inline-block;
    }

    .logo-wrapper::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: calc(100% + 20px);
        height: calc(100% + 20px);
        background: linear-gradient(135deg, #f6a723, #e67e22);
        border-radius: 50%;
        opacity: 0.2;
        animation: pulse 2s ease-in-out infinite;
        z-index: -1;
    }

    @keyframes pulse {
        0%, 100% {
            transform: translate(-50%, -50%) scale(1);
            opacity: 0.2;
        }
        50% {
            transform: translate(-50%, -50%) scale(1.1);
            opacity: 0.3;
        }
    }

    .logo img {
        display: block;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 10px 30px rgba(246, 167, 35, 0.3);
        transition: transform 0.4s ease;
        margin: 0 auto;
    }

    .logo img:hover {
        transform: scale(1.08) rotate(5deg);
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .register-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35), 0 15px 40px rgba(0, 0, 0, 0.25);
    }

    .register-title {
        font-weight: 700;
        font-size: 32px;
        background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-align: center;
        margin-bottom: 10px;
        animation: fadeIn 1s ease 0.3s both;
    }

    .register-subtitle {
        text-align: center;
        color: #718096;
        font-size: 15px;
        margin-bottom: 35px;
        animation: fadeIn 1s ease 0.5s both;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-label {
        font-weight: 600;
        color: #4a5568;
        font-size: 14px;
        margin-bottom: 10px;
        display: block;
        transition: color 0.3s ease;
    }

    .input-wrapper {
        position: relative;
        margin-bottom: 25px;
    }

    .input-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .form-control {
        width: 100%;
        padding: 16px 20px 16px 55px;
        border: 2px solid #e2e8f0;
        border-radius: 15px;
        font-size: 15px;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        background: #f8fafc;
        color: #2d3748;
    }

    .form-control::placeholder {
        color: #a0aec0;
    }

    .form-control:focus {
        outline: none;
        border-color: #f6a723;
        background: white;
        box-shadow: 0 0 0 4px rgba(246, 167, 35, 0.15);
        transform: translateY(-2px);
    }

    .form-control:focus + .input-icon {
        color: #f6a723;
        transform: translateY(-50%) scale(1.1);
    }

    .form-control.is-invalid {
        border-color: #fc8181;
        background: #fff5f5;
    }

    .password-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 20px;
        transition: all 0.3s ease;
        z-index: 2;
    }

    .password-toggle:hover {
        transform: translateY(-50%) scale(1.15);
    }

    .invalid-feedback {
        color: #e53e3e;
        font-size: 13px;
        margin-top: 6px;
        display: block;
        animation: shake 0.4s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .row {
        display: flex;
        margin: 0 -10px;
    }

    .col-md-6 {
        flex: 1;
        padding: 0 10px;
    }

    .btn-register {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%);
        color: white;
        border: none;
        border-radius: 15px;
        font-size: 17px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        box-shadow: 0 10px 25px rgba(246, 167, 35, 0.4);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 20px;
    }

    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-register:hover::before {
        left: 100%;
    }

    .btn-register:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 35px rgba(246, 167, 35, 0.5);
        background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
    }

    .btn-register:active {
        transform: translateY(-1px) scale(0.98);
    }

    .login-link {
        text-align: center;
        color: #718096;
        font-size: 15px;
        margin-top: 25px;
    }

    .login-link a {
        color: #f6a723;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
        position: relative;
    }

    .login-link a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%);
        transition: width 0.3s ease;
    }

    .login-link a:hover::after {
        width: 100%;
    }

    .login-link a:hover {
        color: #e67e22;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 15px;
        margin-bottom: 25px;
        font-size: 14px;
        animation: slideDown 0.5s ease;
        border: none;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-danger {
        background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
        color: #c53030;
        border-left: 5px solid #fc8181;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .mb-3 {
        margin-bottom: 20px;
    }

    .mt-4 {
        margin-top: 25px;
    }

    .text-center {
        text-align: center;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .row {
            flex-direction: column;
        }

        .col-md-6 {
            width: 100%;
            padding: 0;
        }

        .register-card {
            padding: 40px 30px;
            border-radius: 25px;
        }

        .register-title {
            font-size: 26px;
        }

        .logo img {
            width: 100px;
            height: 100px;
        }

        .form-control {
            padding: 14px 18px 14px 50px;
        }

        .btn-register {
            padding: 14px;
            font-size: 15px;
        }
    }

    /* Loading Animation */
    .btn-register.loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .btn-register.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<div class="register-wrapper">
    <div class="register-card">
        <!-- Logo -->
        <div class="logo">
            <div class="logo-wrapper">
                <img src="{{ asset('https://images.unsplash.com/photo-1595409583957-5d1ec5869de9?q=80&w=686&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') }}" alt="Logo">
            </div>
        </div>

        <h4 class="register-title">Daftar Akun Baru 🚀</h4>
        <p class="register-subtitle">Silakan isi data di bawah ini untuk membuat akun baru</p>

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

        <form action="{{ route('register.post') }}" method="POST" id="registerForm">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">👤 Nama Lengkap</label>
                <div class="input-wrapper">
                    <input id="name"
                           type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Masukkan nama lengkap"
                           required
                           autofocus>
                    <span class="input-icon">👨</span>
                </div>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">📧 Email</label>
                <div class="input-wrapper">
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="nama@example.com"
                           required>
                    <span class="input-icon">✉️</span>
                </div>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">🔒 Kata Sandi</label>
                        <div class="input-wrapper">
                            <div class="password-wrapper">
                                <input id="password"
                                       type="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Min. 8 karakter"
                                       required>
                                <span class="input-icon">🔐</span>
                                <span class="password-toggle" onclick="togglePassword('password', this)">👁️</span>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">🔑 Konfirmasi</label>
                        <div class="input-wrapper">
                            <div class="password-wrapper">
                                <input id="password_confirmation"
                                       type="password"
                                       name="password_confirmation"
                                       class="form-control"
                                       placeholder="Ulangi kata sandi"
                                       required>
                                <span class="input-icon">✔️</span>
                                <span class="password-toggle" onclick="togglePassword('password_confirmation', this)">👁️</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-register" id="registerBtn">
                Daftar Sekarang
            </button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId, icon) {
        const passwordInput = document.getElementById(fieldId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            icon.textContent = '👁️';
        }
    }

    // Add loading animation on form submit
    document.getElementById('registerForm').addEventListener('submit', function() {
        const btn = document.getElementById('registerBtn');
        btn.classList.add('loading');
        btn.textContent = 'Memproses...';
    });

    // Add focus animation to labels
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            const label = this.closest('.mb-3').querySelector('.form-label');
            if (label) {
                label.style.color = '#f6a723';
            }
        });

        input.addEventListener('blur', function() {
            const label = this.closest('.mb-3').querySelector('.form-label');
            if (label) {
                label.style.color = '#4a5568';
            }
        });
    });

    // Password strength indicator
    const passwordInput = document.getElementById('password');
    const passwordConfirm = document.getElementById('password_confirmation');

    passwordInput.addEventListener('input', function() {
        const strength = this.value.length;
        if (strength >= 8) {
            this.style.borderColor = '#48bb78';
        } else if (strength >= 4) {
            this.style.borderColor = '#f6a723';
        } else if (strength > 0) {
            this.style.borderColor = '#fc8181';
        }
    });

    // Password match indicator
    passwordConfirm.addEventListener('input', function() {
        if (this.value === passwordInput.value && this.value.length > 0) {
            this.style.borderColor = '#48bb78';
        } else if (this.value.length > 0) {
            this.style.borderColor = '#fc8181';
        }
    });
</script>

@endsection
