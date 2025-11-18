@extends('layouts.guest.main')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <div class="mb-3 mb-md-0">
            <h1 class="h3 mb-2 text-gradient-primary">
                <i class="fas fa-folder-tree me-2"></i>Kategori Dokumen
            </h1>
            <p class="text-muted mb-0">
                <i class="fas fa-info-circle me-1"></i>
                Kelola kategori untuk mengorganisir dokumen dengan baik
            </p>
        </div>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i>Tambah Kategori
        </a>
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
                            <div class="stat-value">{{ $kategoris->count() }}</div>
                            <div class="stat-label">Total Kategori</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-folder fa-2x"></i>
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
                            <div class="stat-value">{{ $kategoris->sum('dokumen_count') ?? 0 }}</div>
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
            <div class="card stat-card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="stat-value">{{ $kategoris->where('status', 'aktif')->count() }}</div>
                            <div class="stat-label">Kategori Aktif</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-check-circle fa-2x"></i>
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
                            @php
                                $currentMonth = now()->month;
                                $currentYear = now()->year;
                                $kategoriTerbaru = $kategoris->filter(function($kategori) use ($currentMonth, $currentYear) {
                                    return $kategori->created_at->month == $currentMonth &&
                                           $kategori->created_at->year == $currentYear;
                                })->count();
                            @endphp
                            <div class="stat-value">{{ $kategoriTerbaru }}</div>
                            <div class="stat-label">Ditambah Bulan Ini</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-calendar-plus fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kategori Cards Grid -->
    <div class="row" id="kategoriCards">
        @foreach($kategoris as $kategori)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card kategori-card h-100 border-0 shadow-sm">
                <!-- Category Header with Gradient -->
                <div class="card-header-custom position-relative overflow-hidden">
                    <div class="category-gradient-{{ ($loop->index % 4) + 1 }}"></div>
                    <div class="position-relative z-1">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="category-icon">
                                <i class="fas fa-folder-open"></i>
                            </div>
                            <span class="badge bg-white text-dark category-badge">
                                {{ $kategori->dokumen_count ?? 0 }} Dokumen
                            </span>
                        </div>
                        <h5 class="category-title mt-3 mb-1">{{ $kategori->nama }}</h5>
                        <small class="text-white-50">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $kategori->created_at->format('d/m/Y') }}
                        </small>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Description -->
                    <div class="category-description mb-3">
                        <p class="text-muted mb-2">
                            {{ $kategori->deskripsi ? Str::limit($kategori->deskripsi, 120) : 'Tidak ada deskripsi' }}
                        </p>
                    </div>

                    <!-- Metadata -->
                    <div class="category-meta mb-3">
                        <div class="meta-item">
                            <i class="fas fa-hashtag text-primary me-2"></i>
                            <small class="text-muted">ID: {{ $kategori->kategori_id }}</small>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clock text-warning me-2"></i>
                            <small class="text-muted">
                                Diperbarui: {{ $kategori->updated_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="category-actions d-flex gap-2">
                        <a href="{{ route('kategori.edit', $kategori->kategori_id) }}"
                           class="btn btn-outline-warning btn-sm flex-fw d-flex align-items-center justify-content-center">
                            <i class="fas fa-edit me-1"></i>
                            <span class="d-none d-sm-inline">Edit</span>
                        </a>
                        <a href="#"
                           class="btn btn-outline-info btn-sm flex-fw d-flex align-items-center justify-content-center"
                           data-bs-toggle="modal" data-bs-target="#detailModal{{ $kategori->kategori_id }}">
                            <i class="fas fa-eye me-1"></i>
                            <span class="d-none d-sm-inline">Detail</span>
                        </a>
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
                                        <p class="mb-0 fw-bold">{{ $kategori->dokumen_count ?? 0 }} Dokumen</p>
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
                        <a href="{{ route('kategori.edit', $kategori->kategori_id ) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i>Edit Kategori
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @if($kategoris->isEmpty())
        <div class="col-12">
            <div class="card shadow-lg border-0 text-center py-5">
                <div class="card-body">
                    <i class="fas fa-folder-open fa-4x text-gray-300 mb-4"></i>
                    <h4 class="text-gray-500 mb-3">Belum ada kategori</h4>
                    <p class="text-muted mb-4">Mulai dengan menambahkan kategori pertama Anda</p>
                    <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Kategori Pertama
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Simple Pagination Info -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Menampilkan {{ $kategoris->count() }} dari {{ $kategoris->count() }} kategori
                </div>
                <div class="text-muted small">
                    <i class="fas fa-info-circle me-1"></i>
                    Semua kategori ditampilkan
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

/* Kategori Card Styling */
.kategori-card {
    border-radius: 12px;
    transition: all 0.3s ease;
    overflow: hidden;
}

.kategori-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15) !important;
}

.card-header-custom {
    padding: 1.5rem;
    color: white;
    position: relative;
}

.category-gradient-1 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.category-gradient-2 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.category-gradient-3 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.category-gradient-4 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
}

.category-icon {
    font-size: 2rem;
    opacity: 0.9;
}

.category-badge {
    border-radius: 20px;
    padding: 0.5rem 0.75rem;
    font-weight: 600;
}

.category-title {
    font-weight: 700;
    font-size: 1.25rem;
}

.category-description {
    min-height: 60px;
}

.category-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
}

.category-actions .btn {
    border-radius: 8px;
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
}

.flex-fw {
    flex: 1;
}

/* Responsive Design */
@media (max-width: 768px) {
    .category-actions {
        flex-direction: column;
    }

    .stat-value {
        font-size: 1.5rem;
    }

    .category-meta {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effects
    const cards = document.querySelectorAll('.kategori-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endsection
