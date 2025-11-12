@extends('layouts.guest.main')

@section('title', 'Profil Saya')

@section('content')
    <section class="section py-5" style="background: linear-gradient(135deg, #fff3e0, #ffe0b2, #ffcc80); min-height: 100vh;">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="card shadow-lg border-0 rounded-4"
                style="max-width: 450px; width: 100%; background: #ffffffc9; backdrop-filter: blur(6px);">
                <div class="card-body text-center p-5" data-aos="fade-up" data-aos-duration="800">

                    {{-- Foto profil --}}
                    <div class="mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ffb74d&color=fff"
                            class="rounded-circle shadow-sm border border-3 border-light" width="100" height="100"
                            alt="Avatar">
                    </div>

                    {{-- Nama dan email --}}
                    <h3 class="fw-bold text-dark mb-2">{{ Auth::user()->name }}</h3>
                    <p class="text-muted mb-4">{{ Auth::user()->email }}</p>

                    {{-- Informasi tambahan --}}
                    <div class="border-top pt-3 text-start small">
                        <p class="mb-2"><strong>Role:</strong> <span class="text-secondary">User</span></p>
                        <p class="mb-2"><strong>Bergabung:</strong>
                            <span class="text-secondary">{{ Auth::user()->created_at->format('d M Y') }}</span>
                        </p>
                    </div>

                    {{-- Tombol aksi --}}
                    <div class="mt-4 d-flex justify-content-center gap-3">
                        <a href="{{ route('user.edit') }}"
                            class="btn btn-outline-warning rounded-pill px-4 fw-semibold shadow-sm">
                            ✏️ Edit Profil
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger rounded-pill px-4 fw-semibold shadow-sm">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
