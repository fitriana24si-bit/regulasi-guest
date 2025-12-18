@extends('layouts.guest.main')

@php use Illuminate\Support\Str; @endphp

@section('content')
    <div class="container">

        <a href="{{ route('media.create') }}" class="btn btn-primary mb-3">
            + Upload File
        </a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse ($media as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">

                        <div class="card-body text-center">

                            {{-- PREVIEW --}}
                            @if ($item->media->count())
                                @foreach ($item->media as $m)
                                    @if (Str::contains($m->mime_type, 'image'))
                                        <img src="{{ asset('storage/lampiran/' . $m->file_name) }}"
                                            class="img-fluid rounded mb-2" style="max-height:200px;object-fit:cover;">
                                    @elseif(Str::contains($m->mime_type, 'pdf'))
                                        <iframe src="{{ asset('storage/lampiran/' . $m->file_name) }}" class="w-100 rounded"
                                            style="height:200px;"></iframe>
                                    @endif
                                @endforeach
                            @endif

                            <p class="fw-bold">{{ $item->file_name }}</p>
                            <small>{{ $item->mime_type }}</small>

                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ asset('storage/lampiran/' . $item->file_name) }}"
                                    class="btn btn-sm btn-success w-100" download>
                                    Download
                                </a>

                                <form method="POST" action="{{ route('media.destroy', $item->media_id) }}" class="w-100"
                                    onsubmit="return confirm('Hapus file?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger w-100">
                                        Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada file</p>
            @endforelse
        </div>

        {{ $media->links() }}

    </div>
@endsection
