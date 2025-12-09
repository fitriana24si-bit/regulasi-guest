@extends('layouts.guest.main')

@section('content')
<div class="container mt-4">

    <h3>Detail Lampiran</h3>

    <div class="card p-4 mt-3">

        <p><strong>Dokumen:</strong> {{ $lampiran->dokumen->judul ?? '-' }}</p>
        <p><strong>Nama File:</strong> {{ $lampiran->nama_file }}</p>
        <p><strong>Tipe:</strong> {{ strtoupper($lampiran->tipe_file) }}</p>
        <p><strong>Ukuran:</strong> {{ number_format($lampiran->ukuran_file / 1024, 2) }} KB</p>

        <a href="{{ asset('storage/' . $lampiran->file_path) }}"
           class="btn btn-success"
           download>
            Download File
        </a>

        <a href="{{ route('lampiran.edit', $lampiran->lampiran_id) }}"
           class="btn btn-warning">
            Edit
        </a>

        <form action="{{ route('lampiran.destroy', $lampiran->lampiran_id) }}"
              method="POST"
              class="d-inline"
              onsubmit="return confirm('Yakin ingin menghapus lampiran ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
        </form>

    </div>

</div>
@endsection
