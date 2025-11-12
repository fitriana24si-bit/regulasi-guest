@extends('layouts.guest.main')

@section('title', 'Kategori Dokumen | Regna')
@include('layouts.guest.css')
@section('content')
<div class="container py-5 mt-5" data-aos="fade-up" style="margin-top: 120px !important;">
  <div class="text-center mb-5">
    <h2 class="fw-bold text-white">📂 Kategori Dokumen</h2>
    <p class="text-light">Klasifikasi dokumen berdasarkan kategori tertentu.</p>
    <hr class="w-25 mx-auto border-light border-2">
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
@endsection
