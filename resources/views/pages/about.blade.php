@extends('layouts.guest.main')
@include('layouts.guest.css')

@section('title', 'Tentang Kami | Regna')

@section('content')
<section id="about" class="py-5" style="background: linear-gradient(135deg, #f7f9ff, #eaf3ff); min-height: 100vh;">
  <div class="container" data-aos="fade-up">

    <!-- Header -->
    <div class="text-center mb-5">
      <h1 class="fw-bold text-primary mb-3">Tentang Sistem Informasi Produk Hukum</h1>
      <p class="text-muted fs-5">Platform yang mempermudah akses terhadap berbagai produk hukum dan jenis dokumen resmi.</p>
      <div class="mx-auto" style="width: 100px; height: 4px; background: linear-gradient(90deg, #007bff, #00c6ff); border-radius: 2px;"></div>
    </div>

    <!-- Konten -->
    <div class="row align-items-center justify-content-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="https://img.freepik.com/free-vector/legal-document-concept-illustration_114360-4655.jpg"
             alt="Produk Hukum"
             class="img-fluid rounded-4 shadow">
      </div>

      <div class="col-md-6">
        <h3 class="fw-semibold text-dark mb-3">Membangun Akses Hukum yang Lebih Terbuka</h3>
        <p class="text-secondary">
          Website ini dirancang untuk memudahkan masyarakat dalam menemukan, memahami,
          dan mengelola berbagai produk hukum seperti peraturan daerah, keputusan, dan dokumen hukum lainnya.
          Kami percaya bahwa keterbukaan informasi hukum adalah kunci untuk menciptakan pemerintahan yang transparan dan akuntabel.
        </p>

        <p class="text-secondary">
          Melalui sistem ini, pengguna dapat menelusuri jenis-jenis dokumen hukum dengan mudah,
          menambahkan data secara terstruktur, serta memperoleh informasi terbaru seputar regulasi dan produk hukum daerah.
        </p>

        <ul class="list-unstyled mt-3">
          <li><i class="bi bi-check-circle text-primary me-2"></i>Menampilkan data jenis dan produk hukum secara interaktif</li>
          <li><i class="bi bi-check-circle text-primary me-2"></i>Mendukung validasi dan pengelolaan data secara mudah</li>
          <li><i class="bi bi-check-circle text-primary me-2"></i>Memberikan kemudahan akses untuk masyarakat umum</li>
        </ul>
      </div>
    </div>

    <!-- Section Bawah -->
    <div class="text-center mt-5">
      <h4 class="fw-bold text-primary">Visi Kami</h4>
      <p class="text-secondary mx-auto" style="max-width: 700px;">
        Menjadi platform digital yang mampu memperkuat transparansi dan efektivitas informasi hukum,
        serta menjadi sarana pembelajaran bagi masyarakat dalam mengenal lebih jauh tentang produk dan jenis dokumen hukum.
      </p>

      <h4 class="fw-bold text-primary mt-4">Misi Kami</h4>
      <p class="text-secondary mx-auto" style="max-width: 700px;">
        Menghadirkan sistem yang informatif, efisien, dan mudah digunakan untuk mendukung pengelolaan produk hukum berbasis digital.
      </p>
    </div>
  </div>
</section>
@endsection
