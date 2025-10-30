@extends('layouts.main')

@section('title', 'Tambah Data Warga')

@section('content')
<div class="container py-5">
    <h2 class="mb-4"><i class="bi bi-person-plus"></i> Tambah Data Warga</h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('warga.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="no_ktp" class="form-label">No. KTP</label>
                <input type="text" class="form-control" id="no_ktp" name="no_ktp" required>
            </div>
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="agama" class="form-label">Agama</label>
                <input type="text" class="form-control" id="agama" name="agama" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
            </div>
            <div class="col-md-6">
                <label for="telp" class="form-label">No. Telepon</label>
                <input type="text" class="form-control" id="telp" name="telp">
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('warga.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
        </div>
    </form>
</div>
@endsection
