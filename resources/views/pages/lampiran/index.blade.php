@extends('layouts.guest.main')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Lampiran Dokumen</h3>
        <a href="{{ route('lampiran.create') }}" class="btn btn-primary">+ Tambah Lampiran</a>
    </div>

    <div class="row">
        @forelse ($lampiran as $item)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">

                <div class="card-body">
                    <h5 class="card-title">{{ $item->nama_file }}</h5>

                    <p class="mb-1">
                        <strong>Dokumen:</strong> {{ $item->dokumen->judul ?? '-' }}
                    </p>
                    <p class="mb-1">
                        <strong>Tipe:</strong> {{ strtoupper($item->tipe_file) }}
                    </p>
                    <p>
                        <strong>Ukuran:</strong> {{ number_format($item->ukuran_file / 1024, 2) }} KB
                    </p>

                    <div class="d-flex gap-2">

                        {{-- DETAIL --}}
                        <a href="{{ route('lampiran.show', $item->lampiran_id) }}"
                           class="btn btn-info btn-sm">
                            Detail
                        </a>

                        {{-- DOWNLOAD --}}
                        <a href="{{ asset('storage/' . $item->file_path) }}"
                           class="btn btn-success btn-sm"
                           download>
                            Download
                        </a>

                        {{-- EDIT --}}
                        <a href="{{ route('lampiran.edit', $item->lampiran_id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('lampiran.destroy', $item->lampiran_id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus lampiran ini?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
        @empty
            <p class="text-center">Belum ada lampiran.</p>
        @endforelse
    </div>

</div>
@endsection
