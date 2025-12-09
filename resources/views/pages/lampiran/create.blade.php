@extends('layouts.guest.main')

@section('content')
<div class="container mt-4">

    <h3>Tambah Lampiran</h3>

    {{-- TAMPIL ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lampiran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="mt-3">Pilih Dokumen</label>
        <select class="form-control mb-3" name="dokumen_id" required>
            <option value="">-- Pilih Dokumen --</option>
            @foreach ($dokumen as $d)
                <option value="{{ $d->dokumen_id }}">{{ $d->judul }}</option>
            @endforeach
        </select>

        <label>Keterangan / Nama Lampiran</label>
        <input type="text" name="keterangan" class="form-control mb-3">

        <label>Pilih File (bisa lebih dari satu)</label>
        <input type="file" name="file[]" multiple class="form-control">

        <button class="btn btn-primary mt-3">Upload</button>
    </form>

</div>
@endsection
