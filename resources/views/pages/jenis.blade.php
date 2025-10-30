@extends('layouts.main')

@section('title', 'Jenis Dokumen | Regna')

@section('content')
<section id="jenis-dokumen" class="py-5" style="background: linear-gradient(to bottom right, #f5faff, #e6f0ff); min-height: 100vh;">
  <div class="container" data-aos="fade-up">

    <!-- Header Halaman -->
    <div class="text-center mb-5">
      <h1 class="fw-bold mb-2" style="color:#0056d2;">Jenis Dokumen</h1>
      <p class="text-secondary fs-5">Daftar jenis-jenis dokumen hukum yang tersedia di portal ini.</p>
      <div class="mx-auto" style="width:100px; height:4px; background:linear-gradient(90deg, #007bff, #00c6ff); border-radius:2px;"></div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-end mb-4">
      <a href="{{ route('jenis.create') }}" class="btn btn-primary rounded-pill px-4">
        <i class="bi bi-plus-circle me-1"></i>Tambah
      </a>
    </div>

    <!-- Cards Grid Layout -->
    <div class="row">
      @foreach($jenisDokumen as $jenis)
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; overflow: hidden;">
          <!-- Card Header dengan ID -->
          <div class="card-header py-3 text-white text-center" style="background: linear-gradient(90deg, #007bff, #00c6ff);">
            <h6 class="mb-0 fw-bold">JD-{{ str_pad($jenis->id_jenis, 3, '0', STR_PAD_LEFT) }}</h6>
          </div>

          <!-- Card Body -->
          <div class="card-body py-4">
            <!-- Nama Jenis -->
            <h5 class="card-title fw-bold text-dark mb-2 text-center">{{ $jenis->nama_jenis }}</h5>

            <!-- Deskripsi -->
            <p class="card-text text-muted small mb-3 text-center">
              {{ $jenis->deskripsi ?: 'Tidak ada deskripsi' }}
            </p>

            <!-- Info Jumlah Dokumen -->
            <div class="d-flex align-items-center justify-content-center mb-3">
              <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                <i class="bi bi-file-text me-1"></i>
                0 Dokumen
              </span>
            </div>
          </div>

          <!-- Card Footer dengan Tombol Aksi -->
          <div class="card-footer bg-transparent border-0 pt-0">
            <div class="d-flex justify-content-center gap-2">
              <a href="{{ route('jenis.edit', $jenis->id_jenis) }}" class="btn btn-warning btn-sm rounded-pill px-3">
                <i class="bi bi-pencil me-1"></i>Edit
              </a>
              <form action="{{ route('jenis.destroy', $jenis->id_jenis) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus jenis dokumen ini?')">
                  <i class="bi bi-trash me-1"></i>Hapus
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach

      @if($jenisDokumen->count() == 0)
      <!-- Empty State -->
      <div class="col-12">
        <div class="card border-0 shadow-sm text-center" style="border-radius: 15px;">
          <div class="card-body py-5">
            <i class="bi bi-journal-x display-1 text-muted mb-3"></i>
            <h4 class="text-muted mb-3">Belum ada jenis dokumen</h4>
            <p class="text-muted mb-4">Klik tombol "Tambah" untuk menambahkan jenis dokumen pertama</p>
            <a href="{{ route('jenis.create') }}" class="btn btn-primary rounded-pill px-4">
              <i class="bi bi-plus-circle me-1"></i>Tambah Jenis Dokumen
            </a>
          </div>
        </div>
      </div>
      @endif
    </div>

    <!-- Info Statistik -->
    <div class="row mt-5">
      <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm text-center" style="border-radius: 15px;">
          <div class="card-body py-4">
            <i class="bi bi-journal-text display-4 text-primary mb-3"></i>
            <h3 class="fw-bold text-primary">{{ $jenisDokumen->count() }}</h3>
            <p class="text-muted mb-0">Total Jenis</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm text-center" style="border-radius: 15px;">
          <div class="card-body py-4">
            <i class="bi bi-check-circle display-4 text-success mb-3"></i>
            <h3 class="fw-bold text-success">{{ $jenisDokumen->count() }}</h3>
            <p class="text-muted mb-0">Jenis Aktif</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm text-center" style="border-radius: 15px;">
          <div class="card-body py-4">
            <i class="bi bi-file-earmark display-4 text-warning mb-3"></i>
            <h3 class="fw-bold text-warning">0</h3>
            <p class="text-muted mb-0">Total Dokumen</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Info -->
    <div class="text-center mt-4 text-muted small">
      <i class="bi bi-info-circle me-1"></i>Informasi ini bersumber dari database dokumen hukum resmi daerah.
    </div>

  </div>
</section>

<!-- Style Khusus -->
<style>
  section#jenis-dokumen {
    animation: fadeInUp 0.6s ease-out;
  }

  .card {
    transition: all 0.3s ease;
    border: none;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.15) !important;
  }

  .card-header {
    border-bottom: none;
    padding: 12px 20px;
  }

  .card-title {
    font-size: 1.1rem;
    line-height: 1.4;
  }

  .badge {
    font-size: 0.75rem;
    font-weight: 500;
  }

  .btn {
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .btn:hover {
    transform: translateY(-1px);
  }

  /* Animasi untuk card */
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .col-xl-4 {
    animation: fadeInUp 0.6s ease-out;
  }

  .col-xl-4:nth-child(1) { animation-delay: 0.1s; }
  .col-xl-4:nth-child(2) { animation-delay: 0.2s; }
  .col-xl-4:nth-child(3) { animation-delay: 0.3s; }
  .col-xl-4:nth-child(4) { animation-delay: 0.4s; }
  .col-xl-4:nth-child(5) { animation-delay: 0.5s; }
  .col-xl-4:nth-child(6) { animation-delay: 0.6s; }

  /* Responsive */
  @media (max-width: 768px) {
    .col-xl-4 {
      animation: none;
    }

    .card:hover {
      transform: none;
    }
  }
</style>

<!-- Script untuk animasi -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi AOS (jika digunakan)
    if (typeof AOS !== 'undefined') {
      AOS.init({
        duration: 600,
        once: true
      });
    }
  });
</script>
@endsection
