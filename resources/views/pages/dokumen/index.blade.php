@extends('layouts.guest.main')

@section('content')
<div class="container-fluid">
    <!-- Enhanced Header -->
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <div class="mb-3 mb-md-0">
            <h1 class="h3 mb-2 text-gradient-primary">
                <i class="fas fa-file-contract me-2"></i>Dokumen Hukum
            </h1>
            <p class="text-muted mb-0">
                <i class="fas fa-info-circle me-1"></i>
                Kelola dan temukan dokumen hukum dengan mudah
            </p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#helpModal">
                <i class="fas fa-question-circle me-1"></i>Panduan
            </button>
            <a href="{{ route('dokumen.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle me-1"></i>Tambah Dokumen
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
                            <div class="stat-value">{{ $dokumens->total() }}</div>
                            <div class="stat-label">Total Dokumen</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-file-alt fa-2x"></i>
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
                            <div class="stat-value">{{ $dokumens->where('status', 'aktif')->count() }}</div>
                            <div class="stat-label">Dokumen Aktif</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="stat-value">{{ $kategoris->count() }}</div>
                            <div class="stat-label">Kategori</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-folder fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="stat-value">{{ $jenis->count() }}</div>
                            <div class="stat-label">Jenis Dokumen</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Filter Section -->
    <div class="card shadow-lg border-0 mb-4">
        <div class="card-header bg-transparent py-3">
            <h5 class="mb-0">
                <i class="fas fa-filter me-2 text-primary"></i>
                Filter & Pencarian
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('dokumen.index') }}" id="filterForm">
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold text-muted">Jenis Dokumen</label>
                        <select name="id_jenis" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Semua Jenis</option>
                            @foreach($jenis as $item)
                                <option value="{{ $item->id_jenis }}"
                                    {{ request('id_jenis') == $item->id_jenis ? 'selected' : '' }}>
                                    {{ $item->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold text-muted">Kategori</label>
                        <select name="kategori_id" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->kategori_id }}"
                                    {{ request('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold text-muted">Status</label>
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold text-muted">Pencarian</label>
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control"
                                   value="{{ request('search') }}"
                                   placeholder="Cari judul/nomor/ringkasan...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <a href="{{ route('dokumen.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-redo me-1"></i>Reset Filter
                        </a>
                        <span class="text-muted small ms-2">
                            Menampilkan {{ $dokumens->total() }} dokumen
                            @if(request('search') || request('id_jenis') || request('kategori_id') || request('status'))
                                (difilter)
                            @endif
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Enhanced Cards Section -->
    <div class="row" id="dokumenCards">
        @foreach($dokumens as $index => $dokumen)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card document-card h-100 border-0 shadow-sm">
                <!-- Status Badge -->
                <div class="card-status {{ $dokumen->status == 'aktif' ? 'bg-success' : 'bg-danger' }}"></div>

                <div class="card-body">
                    <!-- Nomor Urut dan Status -->
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <small class="text-muted">
                            {{ ($dokumens->currentPage() - 1) * $dokumens->perPage() + $loop->iteration }}
                        </small>
                        <span class="badge {{ $dokumen->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($dokumen->status) }}
                        </span>
                    </div>

                    <!-- Nomor Dokumen -->
                    <div class="document-number">
                        <h6 class="text-primary fw-bold mb-2">{{ $dokumen->nomor }}</h6>
                    </div>

                    <!-- Judul Dokumen -->
                    <h6 class="card-title text-dark mb-3" title="{{ $dokumen->judul }}">
                        {{ Str::limit($dokumen->judul, 60) }}
                    </h6>

                    <!-- Metadata -->
                    <div class="document-meta mb-3">
                        <div class="meta-item">
                            <i class="fas fa-tag text-muted me-1"></i>
                            <small class="text-muted">{{ $dokumen->jenis->nama_jenis }}</small>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-folder text-muted me-1"></i>
                            <small class="text-muted">{{ $dokumen->kategori->nama }}</small>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-calendar text-muted me-1"></i>
                            <small class="text-muted">{{ $dokumen->tanggal->format('d/m/Y') }}</small>
                        </div>
                    </div>

                    <!-- Ringkasan -->
                    @if($dokumen->ringkasan)
                    <div class="document-summary mb-3">
                        <small class="text-muted">
                            {{ Str::limit($dokumen->ringkasan, 100) }}
                        </small>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="document-actions mt-auto">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('dokumen.show', $dokumen->dokumen_id) }}"
                               class="btn btn-outline-primary btn-sm" title="Lihat Detail">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>
                            <a href="{{ route('dokumen.edit', $dokumen->dokumen_id) }}"
                               class="btn btn-outline-warning btn-sm" title="Edit">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <form action="{{ route('dokumen.destroy', $dokumen->dokumen_id) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Hapus dokumen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @if($dokumens->isEmpty())
        <div class="col-12">
            <div class="card shadow-lg border-0 text-center py-5">
                <div class="card-body">
                    <i class="fas fa-file-contract fa-4x text-gray-300 mb-4"></i>
                    <h4 class="text-gray-500 mb-3">Belum ada dokumen</h4>
                    <p class="text-muted mb-4">Mulai dengan menambahkan dokumen pertama Anda</p>
                    <a href="{{ route('dokumen.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Dokumen Pertama
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Enhanced Pagination -->
    @if($dokumens->hasPages())
    <div class="row mt-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Menampilkan {{ $dokumens->firstItem() ?? 0 }} - {{ $dokumens->lastItem() ?? 0 }}
                    dari {{ $dokumens->total() }} dokumen
                </div>
                <nav>
                    {{ $dokumens->links('pagination::bootstrap-5') }}
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
                    Panduan Penggunaan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6><i class="fas fa-filter text-primary me-2"></i>Filter Dokumen</h6>
                    <p class="small text-muted mb-2">Gunakan filter untuk menyaring dokumen berdasarkan jenis, kategori, atau status.</p>
                </div>
                <div class="mb-3">
                    <h6><i class="fas fa-search text-primary me-2"></i>Pencarian</h6>
                    <p class="small text-muted mb-2">Cari dokumen berdasarkan judul, nomor dokumen, atau ringkasan.</p>
                </div>
                <div class="mb-3">
                    <h6><i class="fas fa-sort-numeric-up text-primary me-2"></i>Pagination</h6>
                    <p class="small text-muted mb-0">Gunakan tombol halaman untuk melihat lebih banyak dokumen.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced Styling */
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

.document-card {
    border-radius: 12px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.document-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15) !important;
}

.card-status {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
}

.document-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
}

.document-actions .btn-group {
    gap: 1px;
}

.document-actions .btn {
    border-radius: 6px;
    flex: 1;
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
    .document-meta {
        flex-direction: column;
    }

    .document-actions .btn-group {
        flex-direction: column;
    }

    .stat-value {
        font-size: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto submit form ketika filter berubah
    const filterSelects = document.querySelectorAll('select[name="id_jenis"], select[name="kategori_id"], select[name="status"]');
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });

    // Animasi hover untuk card
    const cards = document.querySelectorAll('.document-card');
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
            if (!confirm('Yakin ingin menghapus dokumen ini?')) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endsection
