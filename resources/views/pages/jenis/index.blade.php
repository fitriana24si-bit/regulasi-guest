@extends('layouts.guest.main')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <div class="mb-3 mb-md-0">
            <h1 class="h3 mb-2 text-gradient-primary">
                <i class="fas fa-tags me-2"></i>Jenis Dokumen
            </h1>
            <p class="text-muted mb-0">
                <i class="fas fa-info-circle me-1"></i>
                Kelola jenis-jenis dokumen hukum
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('jenis.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle me-1"></i>Tambah Jenis
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <div class="flex-grow-1">{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="stat-value">{{ $jenisDokumen->total() }}</div>
                            <div class="stat-label">Total Jenis</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="stat-value">{{ $jenisDokumen->count() }}</div>
                            <div class="stat-label">Ditampilkan</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-eye fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="card shadow-lg border-0 mb-4">
        <div class="card-header bg-transparent py-3">
            <h5 class="mb-0">
                <i class="fas fa-search me-2 text-primary"></i>
                Pencarian Jenis Dokumen
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('jenis.index') }}" id="searchForm">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-8">
                        <label class="form-label small fw-bold text-muted">Cari Jenis Dokumen</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
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
            <div class="card jenis-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <!-- Nomor Urut -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-primary">
                            #{{ ($jenisDokumen->currentPage() - 1) * $jenisDokumen->perPage() + $loop->iteration }}
                        </span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('jenis.edit', $item->id_jenis) }}">
                                        <i class="fas fa-edit me-2 text-warning"></i>Edit
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('jenis.destroy', $item->id_jenis) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger"
                                                onclick="return confirm('Hapus jenis dokumen ini?')">
                                            <i class="fas fa-trash me-2"></i>Hapus
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Nama Jenis -->
                    <h5 class="card-title text-primary mb-3">
                        <i class="fas fa-tag me-2"></i>
                        {{ $item->nama_jenis }}
                    </h5>

                    <!-- Deskripsi -->
                    <div class="jenis-description mb-4">
                        @if($item->deskripsi)
                            <p class="text-muted mb-0">
                                {{ Str::limit($item->deskripsi, 120) }}
                            </p>
                        @else
                            <p class="text-muted fst-italic mb-0">
                                <i class="fas fa-info-circle me-1"></i>
                                Tidak ada deskripsi
                            </p>
                        @endif
                    </div>

                    <!-- Metadata -->
                    <div class="jenis-meta">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $item->created_at->format('d/m/Y') }}
                            </small>
                            <div class="action-buttons">
                                <a href="{{ route('jenis.edit', $item->id_jenis) }}"
                                   class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('jenis.destroy', $item->id_jenis) }}" method="POST"
                                      class="d-inline" onsubmit="return confirm('Hapus jenis dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow-lg border-0 text-center py-5">
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
                    <a href="{{ route('jenis.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Jenis Dokumen
                    </a>
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

<!-- Help Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="helpModalLabel">
                    <i class="fas fa-question-circle me-2 text-primary"></i>
                    Panduan Jenis Dokumen
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6><i class="fas fa-search text-primary me-2"></i>Pencarian</h6>
                    <p class="small text-muted mb-2">Cari jenis dokumen berdasarkan nama atau deskripsi.</p>
                </div>
                <div class="mb-3">
                    <h6><i class="fas fa-plus text-primary me-2"></i>Tambah Jenis</h6>
                    <p class="small text-muted mb-2">Gunakan tombol "Tambah Jenis" untuk menambah jenis dokumen baru.</p>
                </div>
                <div>
                    <h6><i class="fas fa-edit text-primary me-2"></i>Kelola Data</h6>
                    <p class="small text-muted mb-0">Gunakan tombol edit dan hapus pada setiap card untuk mengelola data.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-card {
    border-radius: 15px;
    transition: transform 0.3s ease;
    border: none;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-value {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.875rem;
    opacity: 0.9;
}

.stat-icon {
    opacity: 0.8;
}

.jenis-card {
    border-radius: 12px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.jenis-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15) !important;
}

.jenis-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.jenis-description {
    min-height: 60px;
}

.jenis-meta {
    border-top: 1px solid #e3e6f0;
    padding-top: 1rem;
    margin-top: auto;
}

.action-buttons .btn {
    border-radius: 6px;
    padding: 0.25rem 0.5rem;
}

/* Enhanced Pagination */
.pagination .page-link {
    border-radius: 8px;
    margin: 0 2px;
    border: none;
    color: #6c757d;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stat-value {
        font-size: 1.5rem;
    }

    .jenis-card {
        margin-bottom: 1rem;
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

    // Animasi hover untuk card
    const cards = document.querySelectorAll('.jenis-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
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
            if (!confirm('Yakin ingin menghapus jenis dokumen ini?')) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endsection
