@extends('layouts.guest.main')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <div class="mb-3 mb-md-0">
            <h1 class="h3 mb-2 text-gradient-primary">
                <i class="fas fa-file-contract me-2"></i>Detail Dokumen Hukum
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dokumen.index') }}">Dokumen</a></li>
                    <li class="breadcrumb-item active">Detail Dokumen</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('dokumen.edit', $dokumen->dokumen_id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Document Info -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Dokumen
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Jenis Dokumen</label>
                                <p class="fs-6">{{ $dokumen->jenis->nama_jenis ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Kategori</label>
                                <p class="fs-6">{{ $dokumen->kategori->nama ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Nomor Dokumen</label>
                                <p class="fs-6 text-primary fw-bold">{{ $dokumen->nomor }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Tanggal Dokumen</label>
                                <p class="fs-6">{{ $dokumen->tanggal->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted">Judul Dokumen</label>
                        <p class="fs-6">{{ $dokumen->judul }}</p>
                    </div>

                    @if($dokumen->ringkasan)
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted">Ringkasan</label>
                        <p class="fs-6 text-justify">{{ $dokumen->ringkasan }}</p>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Status</label>
                                <span class="badge {{ $dokumen->status == 'aktif' ? 'bg-success' : 'bg-danger' }} fs-6">
                                    {{ ucfirst($dokumen->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Dibuat Pada</label>
                                <p class="fs-6">{{ $dokumen->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- File Document Section -->
            @if($dokumen->file_path)
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-file-pdf me-2"></i>
                        File Dokumen
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-pdf fa-3x text-danger me-3"></i>
                            <div>
                                <h6 class="mb-1">{{ basename($dokumen->file_path) }}</h6>
                                <small class="text-muted">
                                    Terakhir diupdate: {{ $dokumen->updated_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ asset('storage/' . $dokumen->file_path) }}"
                               target="_blank"
                               class="btn btn-primary">
                                <i class="fas fa-eye me-1"></i> Lihat
                            </a>
                            <a href="{{ asset('storage/' . $dokumen->file_path) }}"
                               download
                               class="btn btn-success">
                                <i class="fas fa-download me-1"></i> Unduh
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar - Metadata & Actions -->
        <div class="col-lg-4">
            <!-- Document Status Card -->
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white py-3">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Status Dokumen
                    </h6>
                </div>
                <div class="card-body text-center">
                    <div class="status-indicator {{ $dokumen->status == 'aktif' ? 'status-active' : 'status-inactive' }} mb-3">
                        <i class="fas {{ $dokumen->status == 'aktif' ? 'fa-check-circle' : 'fa-times-circle' }} fa-3x"></i>
                    </div>
                    <h5 class="{{ $dokumen->status == 'aktif' ? 'text-success' : 'text-danger' }}">
                        {{ $dokumen->status == 'aktif' ? 'Dokumen Aktif' : 'Dokumen Tidak Aktif' }}
                    </h5>
                    <p class="text-muted small">
                        {{ $dokumen->status == 'aktif' ? 'Dokumen ini sedang berlaku dan dapat diakses' : 'Dokumen ini tidak berlaku untuk saat ini' }}
                    </p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header bg-warning text-dark py-3">
                    <h6 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Aksi Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('dokumen.edit', $dokumen->dokumen_id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i> Edit Dokumen
                        </a>
                        <form action="{{ route('dokumen.destroy', $dokumen->dokumen_id) }}" method="POST"
                              onsubmit="return confirm('Yakin menghapus dokumen ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                <i class="fas fa-trash me-1"></i> Hapus Dokumen
                            </button>
                        </form>
                        <a href="{{ route('dokumen.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-list me-1"></i> Lihat Semua Dokumen
                        </a>
                    </div>
                </div>
            </div>

            <!-- Document Metadata -->
            <div class="card shadow">
                <div class="card-header bg-secondary text-white py-3">
                    <h6 class="mb-0">
                        <i class="fas fa-database me-2"></i>
                        Metadata
                    </h6>
                </div>
                <div class="card-body">
                    <div class="metadata-item">
                        <small class="text-muted">ID Dokumen</small>
                        <p class="mb-2 fw-bold">{{ $dokumen->dokumen_id }}</p>
                    </div>
                    <div class="metadata-item">
                        <small class="text-muted">Dibuat</small>
                        <p class="mb-2">{{ $dokumen->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="metadata-item">
                        <small class="text-muted">Diperbarui</small>
                        <p class="mb-0">{{ $dokumen->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
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

.card {
    border: none;
    border-radius: 12px;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
}

.status-indicator {
    padding: 1.5rem;
    border-radius: 50%;
    display: inline-block;
}

.status-active {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.status-inactive {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.metadata-item {
    margin-bottom: 1rem;
}

.metadata-item:last-child {
    margin-bottom: 0;
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item a {
    text-decoration: none;
    color: #6c757d;
}

.breadcrumb-item.active {
    color: #495057;
    font-weight: 500;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Konfirmasi sebelum menghapus dokumen
    const deleteForms = document.querySelectorAll('form[onsubmit]');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Yakin ingin menghapus dokumen ini?')) {
                e.preventDefault();
            }
        });
    });

    // Animasi hover untuk card
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.transition = 'all 0.3s ease';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endsection
