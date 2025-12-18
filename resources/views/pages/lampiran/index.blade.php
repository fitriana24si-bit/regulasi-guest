@extends('layouts.guest.main')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <div class="mb-3 mb-md-0">
            <h1 class="h3 mb-2 text-gradient-primary">
                <i class="fas fa-paperclip me-2"></i>Lampiran Dokumen
            </h1>
            <p class="text-muted mb-0">
                <i class="fas fa-info-circle me-1"></i>
                Mengelola semua file lampiran dokumen hukum
            </p>
        </div>
        <a href="{{ route('lampiran.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i>Tambah Lampiran
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div class="flex-grow-1">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card stat-card bg-primary text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stat-value">{{ $lampiran->total() }}</div>
                        <div class="stat-label">Total Lampiran</div>
                    </div>
                    <i class="fas fa-paperclip fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card stat-card bg-info text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stat-value">{{ $lampiran->count() }}</div>
                        <div class="stat-label">Ditampilkan</div>
                    </div>
                    <i class="fas fa-eye fa-2x opacity-75"></i>
                </div>
            </div>
        </div>

        @php
            $bulanIni = $lampiran->filter(fn($l) => $l->created_at->isCurrentMonth())->count();
        @endphp

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card stat-card bg-success text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stat-value">{{ $bulanIni }}</div>
                        <div class="stat-label">Bulan Ini</div>
                    </div>
                    <i class="fas fa-calendar-plus fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="card shadow-lg border-0 mb-4">
        <div class="card-header bg-transparent py-3">
            <h5 class="mb-0">
                <i class="fas fa-search me-2 text-primary"></i>
                Pencarian Lampiran
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" id="searchForm">
                <div class="row g-3">
                    <div class="col-lg-8">
                        <label class="form-label small fw-bold text-muted">Cari Lampiran</label>
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Cari berdasarkan nama file atau tipe...">
                            <button class="btn btn-primary">
                                <i class="fas fa-search me-1"></i>Cari
                            </button>
                            @if (request('search'))
                                <a href="{{ route('lampiran.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-undo me-1"></i>Reset Filter
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex align-items-end justify-content-end">
                        <span class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            {{ $lampiran->total() }} lampiran ditemukan
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Grid Lampiran -->
    <div class="row">
        @forelse ($lampiran as $item)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card kategori-card h-100">

                    <!-- HEADER -->
                    <div class="card-header-custom category-gradient-{{ ($loop->index % 4) + 1 }}">
                        <div class="d-flex justify-content-between align-items-start text-white">
                            <i class="fas fa-file-alt fa-2x"></i>
                            <span class="badge bg-white text-dark">
                                {{ strtoupper($item->tipe_file) }}
                            </span>
                        </div>

                        <h5 class="mt-2">
                            {{ $item->media->first()->file_name ?? 'Lampiran' }}
                        </h5>
                        <small class="text-white-50">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $item->created_at->format('d/m/Y') }}
                        </small>
                    </div>

                    <!-- BODY -->
                    <div class="card-body">
                        @if ($item->media->count())
                            @foreach ($item->media as $m)
                                @if(Str::contains($m->mime_type, 'image'))
                                    <img src="{{ asset('storage/lampiran/'.$m->file_name) }}"
                                        class="img-fluid rounded mb-2"
                                        style="max-height:200px;object-fit:cover;">
                                @elseif(Str::contains($m->mime_type, 'pdf'))
                                    <iframe src="{{ asset('storage/lampiran/'.$m->file_name) }}"
                                        class="w-100 rounded mb-2"
                                        style="height:200px;"></iframe>
                                @endif
                            @endforeach
                        @endif

                        <div class="text-muted mb-2">
                            <strong>Dokumen:</strong>
                            {{ $item->dokumen->judul ?? '-' }}
                        </div>

                        <div class="text-muted mb-3">
                            <strong>Ukuran:</strong>
                            {{ number_format($item->ukuran_file / 1024, 2) }} KB
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('lampiran.show', $item->lampiran_id) }}"
                                class="btn btn-outline-info btn-sm flex-fill">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>

                            <a href="{{ asset('storage/lampiran/'.$item->media->first()->file_name) }}"
                                class="btn btn-outline-primary btn-sm flex-fill" download>
                                <i class="fas fa-download me-1"></i>Download
                            </a>

                            <form action="{{ route('lampiran.destroy', $item->lampiran_id) }}" method="POST"
                                class="flex-fill" onsubmit="return confirm('Yakin menghapus lampiran?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm w-100">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card text-center py-5 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-paperclip fa-4x text-gray-300 mb-3"></i>
                        <h4 class="text-gray-500">Belum ada lampiran</h4>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($lampiran->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="text-muted small">
                        Menampilkan {{ $lampiran->firstItem() }} - {{ $lampiran->lastItem() }}
                        dari {{ $lampiran->total() }}
                    </div>
                    {{ $lampiran->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
