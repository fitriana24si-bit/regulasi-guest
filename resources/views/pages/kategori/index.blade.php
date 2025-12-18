@extends('layouts.guest.main')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <div class="mb-3 mb-md-0">
            <h1 class="h3 mb-2 text-dark">
                <i class="fas fa-folder-tree me-2 text-primary"></i>Kategori Dokumen
            </h1>
            <p class="text-muted mb-0">
                <i class="fas fa-info-circle me-1"></i>
                Kelola kategori untuk mengorganisir dokumen dengan baik
            </p>
        </div>
        {{-- Tombol Tambah hanya untuk Admin --}}
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('kategori.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle me-1"></i>Tambah Kategori
            </a>
        @endif
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
            Anda hanya dapat melihat data kategori, tidak dapat menambah, mengedit, atau menghapus.
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
                            <div class="stat-value text-primary">{{ $kategoris->total() }}</div>
                            <div class="stat-label text-muted">Total Kategori</div>
                        </div>
                        <div class="stat-icon text-primary">
                            <i class="fas fa-folder fa-2x"></i>
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
                            <div class="stat-value text-success">{{ $kategoris->sum('dokumen_hukum_count') }}</div>
                            <div class="stat-label text-muted">Total Dokumen</div>
                        </div>
                        <div class="stat-icon text-success">
                            <i class="fas fa-file-alt fa-2x"></i>
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
                            <div class="stat-value text-warning">{{ $kategoris->count() }}</div>
                            <div class="stat-label text-muted">Ditampilkan</div>
                        </div>
                        <div class="stat-icon text-warning">
                            <i class="fas fa-eye fa-2x"></i>
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
                            @php
                                $currentMonth = now()->month;
                                $currentYear = now()->year;
                                $kategoriTerbaru = $kategoris->filter(function($kategori) use ($currentMonth, $currentYear) {
                                    return $kategori->created_at->month == $currentMonth &&
                                           $kategori->created_at->year == $currentYear;
                                })->count();
                            @endphp
                            <div class="stat-value text-info">{{ $kategoriTerbaru }}</div>
                            <div class="stat-label text-muted">Bulan Ini</div>
                        </div>
                        <div class="stat-icon text-info">
                            <i class="fas fa-calendar-plus fa-2x"></i>
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
                Pencarian Kategori
            </h5>
        </div>
        <div class="card-body bg-white">
            <form method="GET" action="{{ route('kategori.index') }}" id="searchForm">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-8">
                        <label class="form-label small fw-bold text-muted">Cari Kategori</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control border"
                                   value="{{ request('search') }}"
                                   placeholder="Cari berdasarkan nama atau deskripsi kategori...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i> Clear
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <span class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                {{ $kategoris->total() }} kategori ditemukan
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Kategori Cards Grid -->
    <div class="row" id="kategoriCards">
        @forelse($kategoris as $index => $kategori)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card kategori-card h-100 border shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="fas fa-folder-open text-primary me-2"></i>
                        {{ $kategori->nama }}
                        @if(auth()->user()->role === 'user')
                            <span class="badge bg-secondary ms-2">Read Only</span>
                        @endif
                    </h5>
                </div>

                <div class="card-body bg-white">
                    <!-- Description -->
                    <div class="kategori-description mb-3">
                        <p class="text-muted mb-2">
                            @if($kategori->deskripsi)
                                {{ Str::limit($kategori->deskripsi, 120) }}
                            @else
                                <span class="fst-italic text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Tidak ada deskripsi
                                </span>
                            @endif
                        </p>
                    </div>

                    <!-- Metadata -->
                    <div class="kategori-meta mb-3">
                        <div class="row">
                            <div class="col-6">
                                <div class="meta-item">
                                    <small class="text-muted">
                                        <i class="fas fa-hashtag me-1"></i>
                                        ID: {{ $kategori->kategori_id }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="meta-item text-end">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $kategori->created_at->format('d/m/Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="kategori-actions d-flex gap-2 mt-3 pt-3 border-top">
                        {{-- Edit button hanya untuk admin --}}
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('kategori.edit', $kategori->kategori_id) }}"
                               class="btn btn-outline-warning btn-sm flex-fw d-flex align-items-center justify-content-center">
                                <i class="fas fa-edit me-1"></i>
                                <span class="d-none d-sm-inline">Edit</span>
                            </a>
                        @endif
                        {{-- Detail button untuk semua --}}
                        <a href="#"
                           class="btn btn-outline-info btn-sm flex-fw d-flex align-items-center justify-content-center"
                           data-bs-toggle="modal" data-bs-target="#detailModal{{ $kategori->kategori_id }}">
                            <i class="fas fa-eye me-1"></i>
                            <span class="d-none d-sm-inline">Detail</span>
                        </a>
                        {{-- Delete button hanya untuk admin --}}
                        @if(auth()->user()->role === 'admin')
                            <form action="{{ route('kategori.destroy', $kategori->kategori_id) }}" method="POST"
                                  class="flex-fw d-inline" onsubmit="return confirm('Yakin menghapus kategori {{ $kategori->nama }}?')">
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
        <div class="modal fade" id="detailModal{{ $kategori->kategori_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-folder me-2"></i>Detail Kategori
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary">{{ $kategori->nama }}</h6>
                                <p class="text-muted">{{ $kategori->deskripsi ?? 'Tidak ada deskripsi' }}</p>

                                <div class="row mt-3">
                                    <div class="col-6">
                                        <small class="text-muted">ID Kategori</small>
                                        <p class="mb-0 fw-bold">{{ $kategori->kategori_id }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Tanggal Dibuat</small>
                                        <p class="mb-0 fw-bold">{{ $kategori->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-6">
                                        <small class="text-muted">Jumlah Dokumen</small>
                                        <p class="mb-0 fw-bold">{{ $kategori->dokumen_hukum_count }} Dokumen</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Terakhir Diupdate</small>
                                        <p class="mb-0 fw-bold">{{ $kategori->updated_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        {{-- Edit button di modal hanya untuk admin --}}
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('kategori.edit', $kategori->kategori_id ) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i>Edit Kategori
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
                    <i class="fas fa-folder-open fa-4x text-gray-300 mb-4"></i>
                    <h4 class="text-gray-500 mb-3">Belum ada kategori</h4>
                    <p class="text-muted mb-4">
                        @if(request('search'))
                            Tidak ditemukan kategori dengan kata kunci "{{ request('search') }}"
                        @else
                            Mulai dengan menambahkan kategori pertama Anda
                        @endif
                    </p>
                    {{-- Tombol Tambah hanya untuk admin --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Kategori
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($kategoris->hasPages())
    <div class="row mt-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Menampilkan {{ $kategoris->firstItem() ?? 0 }} - {{ $kategoris->lastItem() ?? 0 }}
                    dari {{ $kategoris->total() }} kategori
                </div>
                <nav>
                    {{ $kategoris->links('pagination::bootstrap-5') }}
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

/* Kategori Card Styling */
.kategori-card {
    border-radius: 10px;
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0;
    background-color: white;
}

.kategori-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.kategori-description {
    min-height: 60px;
}

.kategori-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
}

.kategori-actions .btn {
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
    .kategori-actions {
        flex-direction: column;
    }

    .stat-value {
        font-size: 1.5rem;
    }

    .kategori-meta {
        flex-direction: column;
    }

    .kategori-meta .row .col-6 {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .kategori-meta .row .col-6:last-child {
        margin-bottom: 0;
    }

    .kategori-meta .text-end {
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
    const cards = document.querySelectorAll('.kategori-card');
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
            if (!confirm('Yakin ingin menghapus kategori ini?')) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endsection
