@extends('layouts.guest.main')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Dokumen Hukum</h1>
        <a href="{{ route('dokumen.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Dokumen Hukum</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('dokumen.update', $dokumen->dokumen_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_jenis">Jenis Dokumen *</label>
                            <select class="form-control @error('id_jenis') is-invalid @enderror"
                                    id="id_jenis" name="id_jenis" required>
                                <option value="">Pilih Jenis Dokumen</option>
                                @foreach($jenis as $item)
                                    <option value="{{ $item->id_jenis }}"
                                        {{ old('id_jenis', $dokumen->id_jenis) == $item->id_jenis ? 'selected' : '' }}>
                                        {{ $item->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori_id">Kategori Dokumen *</label>
                            <select class="form-control @error('kategori_id') is-invalid @enderror"
                                    id="kategori_id" name="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->kategori_id }}"
                                        {{ old('kategori_id', $dokumen->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nomor">Nomor Dokumen *</label>
                    <input type="text" class="form-control @error('nomor') is-invalid @enderror"
                           id="nomor" name="nomor" value="{{ old('nomor', $dokumen->nomor) }}" required>
                    @error('nomor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Judul Dokumen *</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                           id="judul" name="judul" value="{{ old('judul', $d
