@extends('layouts.guest.main')

@section('title', 'Lampiran Dokumen | Regna')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-danger mb-2">Lampiran Dokumen</h3>
                <p class="text-secondary mb-0">Daftar file lampiran yang terkait dengan dokumen hukum.</p>
            </div>
            <span class="badge bg-danger px-3 py-2">
                <i class="bi bi-paperclip me-1"></i> Total: 2 Lampiran
            </span>
        </div>
    </div>

    <!-- Filter and Action Bar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-danger btn-sm filter-btn active">
                <i class="bi bi-funnel me-1"></i> Semua File
            </button>
            <button class="btn btn-outline-danger btn-sm filter-btn">
                <i class="bi bi-filetype-pdf me-1"></i> PDF
            </button>
            <button class="btn btn-outline-danger btn-sm filter-btn">
                <i class="bi bi-filetype-docx me-1"></i> Word
            </button>
        </div>
        <div class="d-flex gap-2">
            <div class="input-group input-group-sm" style="width: 280px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Cari lampiran...">
            </div>
            <button class="btn btn-danger btn-sm text-white px-3">
                <i class="bi bi-cloud-upload me-1"></i> Unggah
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 bg-danger text-white shadow">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-file-earmark-pdf fs-4"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">1</h4>
                            <small>File PDF</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 bg-primary text-white shadow">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-file-earmark-word fs-4"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">1</h4>
                            <small>File Word</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 bg-success text-white shadow">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-check-circle fs-4"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">2</h4>
                            <small>Terverifikasi</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 bg-warning text-dark shadow">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-hdd fs-4"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">4.2 MB</h4>
                            <small>Total Ukuran</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- File Grid View -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-danger text-white border-0">
            <h5 class="mb-0"><i class="bi bi-grid me-2"></i>Grid View Lampiran</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- PDF File Card -->
                <div class="col-md-6 mb-4">
                    <div class="card file-card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <div class="file-icon bg-danger rounded p-3 me-3">
                                    <i class="bi bi-file-earmark-pdf text-white fs-2"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold text-dark mb-1">Lampiran Peta Wilayah.pdf</h6>
                                    <div class="d-flex align-items-center text-muted small mb-2">
                                        <span class="me-3"><i class="bi bi-filetype-pdf me-1"></i>PDF Document</span>
                                        <span><i class="bi bi-hdd me-1"></i>2.8 MB</span>
                                    </div>
                                    <span class="badge bg-success">Terverifikasi</span>
                                </div>
                            </div>
                            <div class="file-info">
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-link-45deg me-1"></i>
                                    <strong>Dokumen Terkait:</strong> Perda No.3/2024
                                </p>
                                <p class="text-muted small mb-3">
                                    <i class="bi bi-calendar me-1"></i>
                                    Diunggah: 15 Jan 2025
                                </p>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-download me-1"></i> Unduh
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-eye me-1"></i> Preview
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-trash me-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Word File Card -->
                <div class="col-md-6 mb-4">
                    <div class="card file-card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <div class="file-icon bg-primary rounded p-3 me-3">
                                    <i class="bi bi-file-earmark-word text-white fs-2"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold text-dark mb-1">Lampiran Draft Revisi.docx</h6>
                                    <div class="d-flex align-items-center text-muted small mb-2">
                                        <span class="me-3"><i class="bi bi-filetype-docx me-1"></i>Word Document</span>
                                        <span><i class="bi bi-hdd me-1"></i>1.4 MB</span>
                                    </div>
                                    <span class="badge bg-success">Terverifikasi</span>
                                </div>
                            </div>
                            <div class="file-info">
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-link-45deg me-1"></i>
                                    <strong>Dokumen Terkait:</strong> SK Walikota RTRW
                                </p>
                                <p class="text-muted small mb-3">
                                    <i class="bi bi-calendar me-1"></i>
                                    Diunggah: 20 Jan 2025
                                </p>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-download me-1"></i> Unduh
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-eye me-1"></i> Preview
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-trash me-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table View -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-danger">
                        <tr>
                            <th width="8%" class="text-center">No</th>
                            <th width="35%">Nama Lampiran</th>
                            <th width="15%">Tipe File</th>
                            <th width="25%">Dokumen Terkait</th>
                            <th width="17%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center fw-bold">1</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="file-icon-sm bg-danger rounded p-2 me-3">
                                        <i class="bi bi-file-earmark-pdf text-white"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Lampiran Peta Wilayah.pdf</div>
                                        <small class="text-muted">2.8 MB • Diunggah: 15 Jan 2025</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-danger">PDF</span>
                            </td>
                            <td>
                                <div class="text-dark">Perda No.3/2024</div>
                                <small class="text-muted">Peraturan Daerah</small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-outline-danger" title="Unduh">
                                        <i class="bi bi-download"></i>
                                    </button>
                                    <button class="btn btn-outline-primary" title="Preview">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">2</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="file-icon-sm bg-primary rounded p-2 me-3">
                                        <i class="bi bi-file-earmark-word text-white"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Lampiran Draft Revisi.docx</div>
                                        <small class="text-muted">1.4 MB • Diunggah: 20 Jan 2025</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary">Word</span>
                            </td>
                            <td>
                                <div class="text-dark">SK Walikota RTRW</div>
                                <small class="text-muted">Keputusan Walikota</small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-outline-danger" title="Unduh">
                                        <i class="bi bi-download"></i>
                                    </button>
                                    <button class="btn btn-outline-primary" title="Preview">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.file-card {
    transition: transform 0.2s, box-shadow 0.2s;
    border-radius: 10px;
}

.file-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15) !important;
}

.file-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.file-icon-sm {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    border-radius: 10px;
}

.table th {
    border-top: none;
    font-weight: 600;
    padding: 1rem 0.75rem;
}

.table td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
}

.filter-btn.active {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}

.badge {
    font-weight: 500;
}

.btn-group .btn {
    border-radius: 6px;
    margin: 0 2px;
}
</style>

<script>
// Filter button functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('active');
        });
        this.classList.add('active');
    });
});

// Add hover effects to table rows
document.querySelectorAll('tbody tr').forEach(row => {
    row.addEventListener('mouseenter', function() {
        this.style.backgroundColor = 'rgba(220, 53, 69, 0.05)';
    });

    row.addEventListener('mouseleave', function() {
        this.style.backgroundColor = '';
    });
});

// Search functionality
const searchInput = document.querySelector('input[type="text"]');
if (searchInput) {
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
}
</script>
@endsection
