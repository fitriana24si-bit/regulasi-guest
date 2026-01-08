@extends('layouts.guest.main')

@section('content')
    <div class="container mt-4">

        <h3>Detail Lampiran</h3>

        <div class="card p-4 mt-3">

            <p><strong>Dokumen:</strong> {{ $lampiran->dokumen->judul ?? '-' }}</p>

            @foreach ($lampiran->media as $media)
                <p><strong>Nama File:</strong> {{ $media->file_name }}</p>
                <p><strong>Tipe:</strong> {{ strtoupper($media->mime_type) }}</p>

                <a href="{{ route('lampiran.media.download', $media->media_id) }}" class="btn btn-success mt-2">
                    <i class="fas fa-download me-1"></i> Download File
                </a>
            @endforeach

            @if (auth()->check() && auth()->user()->role === 'admin')
                <form action="{{ route('lampiran.destroy', $lampiran->lampiran_id) }}" method="POST" class="mt-3"
                    onsubmit="return confirm('Yakin ingin menghapus lampiran ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            @endif


        </div>

    </div>
@endsection
