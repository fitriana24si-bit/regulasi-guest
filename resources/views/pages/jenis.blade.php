@extends('layouts.guest.main')

@section('title', 'Jenis Dokumen | Regna')
@include('layouts.guest.css')
@section('content')

<section id="jenis-dokumen" class="py-8"
    style="
      background: linear-gradient(180deg, #cc8624 0%, #a17f19 100%);
      min-height: 100vh;
      padding-top: 140px; /* ✅ Tambahan jarak dari navbar */
    ">
  <div class="container" data-aos="fade-up">

    <!-- 🧭 Header Halaman -->
    <div class="text-center mb-5">
      <h1 class="fw-bold mb-2" style="color:#ffffff;">Jenis Dokumen</h1>
      <p class="text-light fs-5">Daftar jenis-jenis dokumen hukum yang tersedia di portal ini.</p>
      <div class="mx-auto"
           style="width:120px; height:5px; background:linear-gradient(90deg, #ff9800, #ff6f00); border-radius:3px;"></div>
    </div>

    <!-- 🔔 Alert Messages -->
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4"
           role="alert" style="background-color:#fff7e6; border-color:#ffe0b2;">
          <i class="bi bi-check-circle-fill me-2 text-success"></i>
          <strong>Berhasil!</strong> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4"
           role="alert" style="background-color:#fff0f0;">
          <i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i>
          <strong>Error!</strong> {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- ➕ Tombol Tambah -->
    <div class="d-flex justify-content-end mb-4">
      <a href="{{ route('jenis.create') }}"
         class="btn btn-warning text-white rounded-pill px-4 shadow-sm add-btn">
        <i class="bi bi-plus-circle me-1"></i>Tambah Jenis
      </a>
    </div>

    <!-- 🗂️ Cards Grid Layout -->
    <div class="row g-4">
      @forelse($jenisDokumen as $jenis)
      <div class="col-xl-4 col-md-6">
        <div class="card shadow-sm border-0 h-100 glass-card">
          <div class="card-header text-white text-center fw-bold py-3"
               style="background: linear-gradient(90deg, #ff9800, #ff6f00);
                      border-top-left-radius:15px; border-top-right-radius:15px;">
            JD-{{ str_pad($jenis->id_jenis, 3, '0', STR_PAD_LEFT) }}
          </div>

          <div class="card-body text-center py-4">
            <h5 class="fw-bold text-dark mb-2">{{ $jenis->nama_jenis }}</h5>
            <p class="text-muted small mb-3">{{ $jenis->deskripsi ?: 'Tidak ada deskripsi' }}</p>

            <span class="badge bg-light text-dark px-3 py-2 rounded-pill mb-3">
              <i class="bi bi-file-text me-1 text-warning"></i> 0 Dokumen
            </span>
          </div>

          <div class="card-footer bg-transparent border-0 pb-4">
            <div class="d-flex justify-content-center gap-2">
              <a href="{{ route('jenis.edit', $jenis->id_jenis) }}"
                 class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-semibold edit-btn">
                <i class="bi bi-pencil me-1"></i>Edit
              </a>
              <form action="{{ route('jenis.destroy', $jenis->id_jenis) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold delete-btn"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus jenis dokumen ini?')">
                  <i class="bi bi-trash me-1"></i>Hapus
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      @empty
      <!-- 🕳️ Empty State -->
      <div class="col-12 text-center">
        <div class="card shadow-sm border-0 p-5 mx-auto"
             style="max-width: 600px; border-radius: 15px; background: rgba(255,255,255,0.85);">
          <i class="bi bi-journal-x display-1 text-muted mb-3"></i>
          <h4 class="fw-semibold text-muted mb-2">Belum ada jenis dokumen</h4>
          <p class="text-muted mb-4">Klik tombol “Tambah Jenis” untuk menambahkan jenis dokumen baru.</p>
          <a href="{{ route('jenis.create') }}" class="btn btn-warning text-white rounded-pill px-4 shadow-sm add-btn">
            <i class="bi bi-plus-circle me-1"></i>Tambah Jenis Dokumen
          </a>
        </div>
      </div>
      @endforelse
    </div>

    <!-- 📊 Statistik -->
    <div class="row mt-5 g-4">
      <div class="col-md-4">
        <div class="stat-card text-center py-4 rounded-4"
             style="background: linear-gradient(135deg, #fff3e0, #ffe0b2);">
          <i class="bi bi-journal-text display-5 text-warning mb-3"></i>
          <h3 class="fw-bold text-dark">{{ $jenisDokumen->count() }}</h3>
          <p class="text-muted mb-0">Total Jenis</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-card text-center py-4 rounded-4"
             style="background: linear-gradient(135deg, #fffde7, #fff8e1);">
          <i class="bi bi-check-circle display-5 text-success mb-3"></i>
          <h3 class="fw-bold text-dark">{{ $jenisDokumen->count() }}</h3>
          <p class="text-muted mb-0">Jenis Aktif</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-card text-center py-4 rounded-4"
             style="background: linear-gradient(135deg, #fff3e0, #ffe0b2);">
          <i class="bi bi-file-earmark display-5 text-warning mb-3"></i>
          <h3 class="fw-bold text-dark">0</h3>
          <p class="text-muted mb-0">Total Dokumen</p>
        </div>
      </div>
    </div>

    <!-- ℹ️ Footer Info -->
    <div class="text-center mt-5 text-muted small">
      <i class="bi bi-info-circle me-1 text-warning"></i>
      Informasi ini bersumber dari database dokumen hukum resmi daerah.
    </div>

  </div>
</section>

<!-- ✨ Style Kustom -->


<!-- ⚡ Script Animasi -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    if (typeof AOS !== 'undefined') {
      AOS.init({ duration: 800, once: true });
    }
  });
</script>
@endsection
