@extends('layouts.guest.main')

@section('title', 'Edit Data Warga')

@section('content')
<section class="section py-5"
    style="background: linear-gradient(135deg, #fff3e0, #ffe0b2, #ffcc80); min-height: 100vh;">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow-lg border-0 rounded-4"
            style="max-width: 600px; width: 100%; background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(8px); transition: transform 0.4s;">

            <div class="card-body p-5" data-aos="fade-up" data-aos-duration="800">
                <h3 class="mb-4 text-center text-success fw-bold">✏️ Edit Data Warga</h3>

                <form action="{{ route('warga.update', ['id' => $warga->warga_id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama</label>
                        <input type="text" name="nama" class="form-control rounded-pill shadow-sm px-4 py-2"
                            value="{{ $warga->nama }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="no_ktp" class="form-label fw-semibold">No KTP</label>
                        <input type="text" name="no_ktp" class="form-control rounded-pill shadow-sm px-4 py-2"
                            value="{{ $warga->no_ktp }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select rounded-pill shadow-sm px-4 py-2">
                            <option value="Laki-laki" {{ $warga->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $warga->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="agama" class="form-label fw-semibold">Agama</label>
                        <select name="agama" class="form-select rounded-pill shadow-sm px-4 py-2">
                            @php
                                $agamas = ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Lainnya'];
                            @endphp
                            @foreach($agamas as $agama)
                                <option value="{{ $agama }}" {{ $warga->agama == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label fw-semibold">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control rounded-pill shadow-sm px-4 py-2"
                            value="{{ $warga->pekerjaan }}">
                    </div>

                    <div class="mb-3">
                        <label for="telp" class="form-label fw-semibold">Telepon</label>
                        <input type="text" name="telp" class="form-control rounded-pill shadow-sm px-4 py-2"
                            value="{{ $warga->telp }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control rounded-pill shadow-sm px-4 py-2"
                            value="{{ $warga->email }}">
                    </div>

                    {{-- Tombol sejajar --}}
                    <div class="d-flex justify-content-between mt-4 gap-3">
                        <a href="{{ route('warga.index') }}"
                            class="btn btn-outline-secondary rounded-pill fw-semibold shadow-sm flex-fill"
                            style="transition: transform 0.3s;">
                            ← Kembali
                        </a>
                        <button type="submit"
                            class="btn btn-gradient rounded-pill fw-semibold shadow-sm flex-fill"
                            style="background: linear-gradient(45deg, #ffb74d, #ff8a65); color: #fff; transition: transform 0.3s;">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Efek interaktif --}}
<style>
    .card:hover {
        transform: translateY(-5px);
    }

    input:focus, select:focus {
        box-shadow: 0 0 10px rgba(255, 183, 77, 0.4);
        border-color: #ffb74d;
    }

    button:hover, .btn-outline-secondary:hover {
        transform: scale(1.05);
    }
</style>
@endsection
