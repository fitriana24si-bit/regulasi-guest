@extends('layouts.main')

@section('title', 'Edit Data Warga')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 text-success fw-bold">Edit Data Warga</h3>

    <form action="{{ route('warga.update', ['warga' => $warga->warga_id]) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $warga->nama }}" required>
        </div>

        <div class="mb-3">
            <label for="no_ktp" class="form-label">No KTP</label>
            <input type="text" name="no_ktp" class="form-control" value="{{ $warga->no_ktp }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select">
                <option value="Laki-laki" {{ $warga->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $warga->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="agama" class="form-label">Agama</label>
            <input type="text" name="agama" class="form-control" value="{{ $warga->agama }}">
        </div>

        <div class="mb-3">
            <label for="pekerjaan" class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ $warga->pekerjaan }}">
        </div>

        <div class="mb-3">
            <label for="telp" class="form-label">Telepon</label>
            <input type="text" name="telp" class="form-control" value="{{ $warga->telp }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $warga->email }}">
        </div>

        <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
    </form>
</div>
@endsection
