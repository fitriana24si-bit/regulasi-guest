@extends('layouts.guest.main')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">Edit Lampiran</h3>

    {{-- Tampilkan Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lampiran.update', $lampiran->lampiran_id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- PERBAIKAN PENTING: wajib kirim dokumen_id untuk validasi --}}
        <input type="hidden" name="dokumen_id" value="{{ old('dokumen_id', $lampiran->dokumen_id) }}">

        <label class="mt-2 fw-semibold">Nama / Keterangan Lampiran</label>
        <input type="text"
               class="form-control mb-3"
               name="nama_file"
               value="{{ old('nama_file', $lampiran->nama_file) }}"
               required>

        <label class="mt-2 fw-semibold">Ganti File (opsional)</label>
        <input type="file" class="form-control mb-3" name="file">

        {{-- Info file lama --}}
        @if ($lampiran->file_path ?? false)
        <p class="small text-muted">
            File lama: <strong>{{ basename($lampiran->file_path) }}</strong>
        </p>
        @endif

        <button class="btn btn-primary px-4">💾 Simpan Perubahan</button>

    </form>

</div>
@endsection
