@extends('layouts.main')

@section('title', 'Riwayat Perubahan | Regna')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold text-info">Riwayat Perubahan</h3>
    <p class="text-secondary">Catatan seluruh pembaruan dan revisi dokumen hukum.</p>
</div>

<!-- Filter and Search Section -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-info btn-sm active">
                <i class="bi bi-funnel me-1"></i> Semua
            </button>
            <button class="btn btn-outline-info btn-sm">
                <i class="bi bi-arrow-clockwise me-1"></i> Revisi
            </button>
            <button class="btn btn-outline-info btn-sm">
                <i class="bi bi-arrow-up-circle me-1"></i> Pembaruan
            </button>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group input-group-sm">
            <input type="text" class="form-control" placeholder="Cari riwayat perubahan...">
            <button class="btn btn-info text-white" type="button">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card border-0 bg-info text-white shadow-sm">
            <div class="card-body py-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">2</h5>
                        <small>Total Perubahan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card border-0 bg-success text-white shadow-sm">
            <div class="card-body py-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-arrow-up-circle fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">1</h5>
                        <small>Pembaruan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card border-0 bg-warning text-dark shadow-sm">
            <div class="card-body py-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-arrow-clockwise fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">1</h5>
                        <small>Revisi</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card border-0 bg-secondary text-white shadow-sm">
            <div class="card-body py-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-calendar-month fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">2</h5>
                        <small>Bulan Aktif</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Timeline View -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="bi bi-clock me-2"></i>Timeline Perubahan</h5>
    </div>
    <div class="card-body">
        <div class="timeline">
            <!-- Timeline Item 1 -->
            <div class="timeline-item mb-4">
                <div class="timeline-marker bg-success"></div>
                <div class="timeline-content">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="fw-bold text-primary mb-0">Perda No.3/2024</h6>
                        <span class="badge bg-success">Pembaruan</span>
                    </div>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-calendar me-1"></i>2025-02-01
                        <i class="bi bi-clock ms-2 me-1"></i>14:30 WIB
                    </p>
                    <p class="mb-2">Pembaruan Pasal 5 Ayat 2 mengenai ketentuan wilayah administrasi dan penambahan lampiran peta wilayah.</p>
                    <div class="d-flex gap-2">
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-person me-1"></i>Admin Sistem
                        </span>
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-file-text me-1"></i>Peraturan Daerah
                        </span>
                    </div>
                </div>
            </div>

            <!-- Timeline Item 2 -->
            <div class="timeline-item">
                <div class="timeline-marker bg-warning"></div>
                <div class="timeline-content">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="fw-bold text-primary mb-0">SK Walikota RTRW</h6>
                        <span class="badge bg-warning text-dark">Revisi</span>
                    </div>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-calendar me-1"></i>2025-03-10
                        <i class="bi bi-clock ms-2 me-1"></i>09:15 WIB
                    </p>
                    <p class="mb-2">Perubahan nama instansi penerbit dari Dinas Tata Ruang menjadi Dinas Pekerjaan Umum dan Penataan Ruang sesuai Perubahan Struktur Organisasi.</p>
                    <div class="d-flex gap-2">
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-person me-1"></i>Tim Hukum
                        </span>
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-file-earmark-check me-1"></i>Keputusan Walikota
                        </span>
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
                <thead class="table-info">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Dokumen</th>
                        <th>Tanggal Perubahan</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4 fw-bold">1</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-info rounded-circle p-2 me-3">
                                    <i class="bi bi-journal-text text-white"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">Perda No.3/2024</div>
                                    <small class="text-muted">Peraturan Daerah</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>2025-02-01</div>
                            <small class="text-muted">14:30 WIB</small>
                        </td>
                        <td>
                            <span>Pembaruan Pasal 5 Ayat 2 mengenai ketentuan wilayah administrasi.</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-success">Pembaruan</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-4 fw-bold">2</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle p-2 me-3">
                                    <i class="bi bi-file-earmark-check text-white"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">SK Walikota RTRW</div>
                                    <small class="text-muted">Keputusan Walikota</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>2025-03-10</div>
                            <small class="text-muted">09:15 WIB</small>
                        </td>
                        <td>
                            <span>Perubahan nama instansi penerbit sesuai struktur organisasi baru.</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-warning text-dark">Revisi</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    padding-bottom: 1rem;
}

.timeline-marker {
    position: absolute;
    left: -2rem;
    top: 0.5rem;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 3px solid white;
    box-shadow: 0 0 0 3px #e9ecef;
}

.timeline-content {
    padding-left: 1rem;
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

.badge {
    font-weight: 500;
}

.btn-outline-info.active {
    background-color: #0dcaf0;
    border-color: #0dcaf0;
    color: white;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Filter button functionality
document.querySelectorAll('.btn-outline-info').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.btn-outline-info').forEach(b => {
            b.classList.remove('active');
        });
        this.classList.add('active');
    });
});

// Add hover effects to table rows
document.querySelectorAll('tbody tr').forEach(row => {
    row.addEventListener('mouseenter', function() {
        this.style.backgroundColor = 'rgba(13, 202, 240, 0.05)';
    });

    row.addEventListener('mouseleave', function() {
        this.style.backgroundColor = '';
    });
});
</script>
@endsection
