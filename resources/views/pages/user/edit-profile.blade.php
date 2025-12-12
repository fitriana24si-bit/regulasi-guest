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

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
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

                    {{-- PROFILE IMAGE --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto Profil (Opsional)</label>
                        <input type="file" name="profile_image" class="form-control rounded-pill" accept="image/*">
                        <small class="text-muted">Maksimal 2MB. Format: JPG, JPEG, PNG</small>

                        @if($user->profile_image)
                            <div class="mt-2">
                                <small class="text-muted">Foto saat ini:</small><br>
                                <img src="{{ asset('storage/' . $user->profile_image) }}"
                                     width="100" class="mt-2 rounded-circle border" style="border-color: #ffcc66 !important;">
                                <br>
                                <div class="form-check mt-2">
                                    <input type="checkbox" name="remove_profile_image" value="1" id="remove_profile_image" class="form-check-input">
                                    <label for="remove_profile_image" class="form-check-label text-danger">
                                        Hapus foto profil
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru (Opsional)</label>
                        <input type="password" name="password" class="form-control rounded-pill" placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control rounded-pill" placeholder="Kosongkan jika tidak ingin mengubah">
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
