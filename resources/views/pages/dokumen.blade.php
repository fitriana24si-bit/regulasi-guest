@extends('layouts.main')

@section('content')
<div class="container py-5">
  <div class="text-center mb-5" data-aos="fade-down">
    <h2 class="fw-bold text-primary mb-2">📚 Daftar Dokumen Hukum</h2>
    <p class="text-muted">Berikut daftar dokumen hukum yang telah diterbitkan berdasarkan jenis dan kategori tertentu.</p>
  </div>

  <!-- Search & Filter -->
  <div class="row mb-4 justify-content-center">
    <div class="col-md-4">
      <input type="text" class="form-control shadow-sm" placeholder="Cari berdasarkan judul atau nomor...">
    </div>
    <div class="col-md-3">
      <select class="form-select shadow-sm">
        <option selected>Filter Kategori</option>
        <option>Peraturan Daerah</option>
        <option>Peraturan Bupati</option>
        <option>Keputusan</option>
      </select>
    </div>
  </div>

  <!-- Daftar Dokumen -->
  <div class="row g-4">
    <!-- Contoh Card Dokumen -->
    <div class="col-md-6 col-lg-4" data-aos="zoom-in">
      <div class="card border-0 shadow-sm h-100 rounded-4">
        <div class="card-body">
          <h5 class="fw-bold text-dark">Nomor: 01/2025</h5>
          <h6 class="text-primary">Judul: Peraturan Daerah Tentang Ketertiban Umum</h6>
          <p class="small text-muted mb-2"><i class="bi bi-calendar"></i> 20 Januari 2025</p>
          <p class="text-secondary small">Ringkasan: Peraturan ini mengatur ketertiban umum di wilayah Kabupaten...</p>
          <span class="badge bg-success">Status: Aktif</span>
        </div>
        <div class="card-footer bg-light text-end border-0">
          <a href="#" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
        </div>
      </div>
    </div>

    <!-- Ulangi Card sesuai data -->
    <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="100">
      <div class="card border-0 shadow-sm h-100 rounded-4">
        <div class="card-body">
          <h5 class="fw-bold text-dark">Nomor: 02/2025</h5>
          <h6 class="text-primary">Judul: Keputusan Bupati Tentang Retribusi Daerah</h6>
          <p class="small text-muted mb-2"><i class="bi bi-calendar"></i> 15 Februari 2025</p>
          <p class="text-secondary small">Ringkasan: Dokumen ini membahas tentang penetapan tarif retribusi daerah...</p>
          <span class="badge bg-warning text-dark">Status: Revisi</span>
        </div>
        <div class="card-footer bg-light text-end border-0">
          <a href="#" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
