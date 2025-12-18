@extends('layouts.guest.main')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <div class="mb-3 mb-md-0">
            <h1 class="h3 mb-2 text-dark">
                <i class="fas fa-tags me-2 text-primary"></i>Jenis Dokumen
            </h1>
            <p class="text-muted mb-0">
                <i class="fas fa-info-circle me-1"></i>
                Kelola jenis-jenis dokumen hukum
            </p>
        </div>
        <div class="d-flex gap-2">
            {{-- Tombol Tambah hanya untuk Admin --}}
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('jenis.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus-circle me-1"></i>Tambah Jenis
                </a>
            @endif
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <div class="flex-grow-1">{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Notifikasi untuk User --}}
    @if(auth()->user()->role === 'user')
    <div class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="fas fa-info-circle me-2"></i>
        <div class="flex-grow-1">
            <strong>Info:</strong> Anda login sebagai <strong>User</strong>.
            Anda hanya dapat melihat data jenis dokumen, tidak dapat menambah, mengedit, atau menghapus.
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-white border h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="stat-value text-primary">{{ $jenisDokumen->total() }}</div>
                            <div class="stat-label text-muted">Total Jenis</div>
                        </div>
                        <div class="stat-icon text-primary">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-white border h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="stat-value text-success">{{ $jenisDokumen->count() }}</div>
                            <div class="stat-label text-muted">Ditampilkan</div>
                        </div>
                        <div class="stat-icon text-success">
                            <i class="fas fa-eye fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="card shadow-sm border mb-4">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0">
                <i class="fas fa-search me-2 text-primary"></i>
                Pencarian Jenis Dokumen
            </h5>
        </div>
        <div class="card-body bg-white">
            <form method="GET" action="{{ route('jenis.index') }}" id="searchForm">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-8">
                        <label class="form-label small fw-bold text-muted">Cari Jenis Dokumen</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control border"
                                   value="{{ request('search') }}"
                                   placeholder="Cari berdasarkan nama jenis atau deskripsi...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('jenis.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i> Clear
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <span class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                {{ $jenisDokumen->total() }} jenis dokumen ditemukan
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Jenis Dokumen Cards -->
    <div class="row" id="jenisCards">
        @forelse($jenisDokumen as $index => $item)
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card jenis-card h-100 border shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="fas fa-tag text-primary me-2"></i>
                        {{ $item->nama_jenis }}
                        @if(auth()->user()->role === 'user')
                            <span class="badge bg-secondary ms-2">Read Only</span>
                        @endif
                    </h5>
                </div>

                <div class="card-body bg-white">
                    <!-- Deskripsi -->
                    <div class="jenis-description mb-3">
                        <p class="text-muted mb-2">
                            @if($item->deskripsi)
                                {{ Str::limit($item->deskripsi, 120) }}
                            @else
                                <span class="fst-italic text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Tidak ada deskripsi
                                </span>
                            @endif
                        </p>
                    </div>

                    <!-- Metadata -->
                    <div class="jenis-meta mb-3">
                        <div class="row">
                            <div class="col-6">
                                <div class="meta-item">
                                    <small class="text-muted">
                                        <i class="fas fa-hashtag me-1"></i>
                                        ID: {{ $item->id_jenis }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="meta-item text-end">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="jenis-actions d-flex gap-2 mt-3 pt-3 border-top">
                        {{-- Edit button hanya untuk admin --}}
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('jenis.edit', $item->id_jenis) }}"
                               class="btn btn-outline-warning btn-sm flex-fw d-flex align-items-center justify-content-center">
                                <i class="fas fa-edit me-1"></i>
                                <span class="d-none d-sm-inline">Edit</span>
                            </a>
                        @endif
                        {{-- Detail button untuk semua --}}
                        <a href="#"
                           class="btn btn-outline-info btn-sm flex-fw d-flex align-items-center justify-content-center"
                           data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id_jenis }}">
                            <i class="fas fa-eye me-1"></i>
                            <span class="d-none d-sm-inline">Detail</span>
                        </a>
                        {{-- Delete button hanya untuk admin --}}
                        @if(auth()->user()->role === 'admin')
                            <form action="{{ route('jenis.destroy', $item->id_jenis) }}" method="POST"
                                  class="flex-fw d-inline" onsubmit="return confirm('Yakin menghapus jenis dokumen {{ $item->nama_jenis }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-trash me-1"></i>
                                    <span class="d-none d-sm-inline">Hapus</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Modal -->
        <div class="modal fade" id="detailModal{{ $item->id_jenis }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-tag me-2"></i>Detail Jenis Dokumen
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary">{{ $item->nama_jenis }}</h6>
                                <p class="text-muted">{{ $item->deskripsi ?? 'Tidak ada deskripsi' }}</p>

                                <div class="row mt-3">
                                    <div class="col-6">
                                        <small class="text-muted">ID Jenis</small>
                                        <p class="mb-0 fw-bold">{{ $item->id_jenis }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Tanggal Dibuat</small>
                                        <p class="mb-0 fw-bold">{{ $item->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-6">
                                        <small class="text-muted">Terakhir Diupdate</small>
                                        <p class="mb-0 fw-bold">{{ $item->updated_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        {{-- Edit button di modal hanya untuk admin --}}
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('jenis.edit', $item->id_jenis) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i>Edit Jenis
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow-sm border text-center py-5">
                <div class="card-body">
                    <i class="fas fa-tags fa-4x text-gray-300 mb-4"></i>
                    <h4 class="text-gray-500 mb-3">Belum ada jenis dokumen</h4>
                    <p class="text-muted mb-4">
                        @if(request('search'))
                            Tidak ditemukan jenis dokumen dengan kata kunci "{{ request('search') }}"
                        @else
                            Mulai dengan menambahkan jenis dokumen pertama Anda
                        @endif
                    </p>
                    {{-- Tombol Tambah hanya untuk admin --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('jenis.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Jenis Dokumen
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($jenisDokumen->hasPages())
    <div class="row mt-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Menampilkan {{ $jenisDokumen->firstItem() ?? 0 }} - {{ $jenisDokumen->lastItem() ?? 0 }}
                    dari {{ $jenisDokumen->total() }} jenis dokumen
                </div>
                <nav>
                    {{ $jenisDokumen->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.stat-card {
    border-radius: 10px;
    transition: transform 0.3s ease;
    border: 1px solid #e0e0e0 !important;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.stat-value {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.875rem;
}

.stat-icon {
    opacity: 0.8;
}

/* Jenis Card Styling */
.jenis-card {
    border-radius: 10px;
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0;
    background-color: white;
}

.jenis-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.jenis-description {
    min-height: 60px;
}

.jenis-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
}

.jenis-actions .btn {
    border-radius: 6px;
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    border: 1px solid #dee2e6;
}

.flex-fw {
    flex: 1;
}

/* Enhanced Pagination */
.pagination .page-link {
    border-radius: 6px;
    margin: 0 2px;
    border: 1px solid #dee2e6;
    color: #6c757d;
}

.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .jenis-actions {
        flex-direction: column;
    }

    .stat-value {
        font-size: 1.5rem;
    }

    .jenis-meta {
        flex-direction: column;
    }

    .jenis-meta .row .col-6 {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .jenis-meta .row .col-6:last-child {
        margin-bottom: 0;
    }

    .jenis-meta .text-end {
        text-align: left !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto search dengan delay
    let searchTimeout;
    const searchInput = document.querySelector('input[name="search"]');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('searchForm').submit();
            }, 500);
        });
    }

    // Add hover effects
    const cards = document.querySelectorAll('.jenis-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.transition = 'all 0.3s ease';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Konfirmasi sebelum menghapus
    const deleteForms = document.querySelectorAll('form[onsubmit]');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const jenisName = this.querySelector('button[type="submit"]')?.getAttribute('data-name') || 'jenis dokumen ini';
            if (!confirm(`Yakin ingin menghapus ${jenisName}?`)) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endsection
