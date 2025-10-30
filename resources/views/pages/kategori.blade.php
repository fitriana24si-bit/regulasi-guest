@extends('layouts.main')

@section('title', 'Kategori Dokumen | Regna')

@section('content')
<div class="container py-5" data-aos="fade-up">
  <div class="text-center mb-5">
    <h2 class="fw-bold text-success">📂 Kategori Dokumen</h2>
    <p class="text-muted">Klasifikasi dokumen berdasarkan kategori tertentu.</p>
    <hr class="w-25 mx-auto border-success border-2">
  </div>

  <div class="row justify-content-center g-4">
    <!-- Card 1 -->
    <div class="col-md-4">
      <div class="card border-0 shadow-lg hover-zoom rounded-4 h-100 text-center p-4">
        <div class="card-body">
          <div class="mb-3 fs-1 text-success"><i class="bi bi-file-earmark-text"></i></div>
          <h5 class="fw-bold">Peraturan Umum</h5>
          <p class="text-muted small">Dokumen berisi ketentuan umum dan pedoman dasar yang berlaku secara menyeluruh.</p>
          <a href="#" class="btn btn-outline-success btn-sm mt-2">Lihat Detail</a>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-4">
      <div class="card border-0 shadow-lg hover-zoom rounded-4 h-100 text-center p-4">
        <div class="card-body">
          <div class="mb-3 fs-1 text-primary"><i class="bi bi-building"></i></div>
          <h5 class="fw-bold">Kebijakan Daerah</h5>
          <p class="text-muted small">Berisi kebijakan dan keputusan resmi pemerintah daerah terkait regulasi lokal.</p>
          <a href="#" class="btn btn-outline-primary btn-sm mt-2">Lihat Detail</a>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-4">
      <div class="card border-0 shadow-lg hover-zoom rounded-4 h-100 text-center p-4">
        <div class="card-body">
          <div class="mb-3 fs-1 text-warning"><i class="bi bi-people"></i></div>
          <h5 class="fw-bold">Perjanjian Kerjasama</h5>
          <p class="text-muted small">Kumpulan dokumen kerja sama antar lembaga, instansi, atau pihak ketiga.</p>
          <a href="#" class="btn btn-outline-warning btn-sm mt-2">Lihat Detail</a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .hover-zoom {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .hover-zoom:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  }
</style>
@endsection
    