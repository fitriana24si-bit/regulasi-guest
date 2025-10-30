@extends('layouts.main')

@section('title', 'Jenis Dokumen | Regna')

@section('content')
<section id="jenis-dokumen" class="py-5" style="background: linear-gradient(to bottom right, #f5faff, #e6f0ff); min-height: 100vh;">
  <div class="container" data-aos="fade-up">

    <!-- Header Halaman -->
    <div class="text-center mb-5">
      <h2 class="fw-bold mb-2" style="color:#0056d2;">📚 Jenis Dokumen</h2>
      <p class="text-secondary fs-5">Daftar jenis-jenis dokumen hukum yang tersedia di portal ini.</p>
      <div class="mx-auto" style="width:100px; height:4px; background:linear-gradient(90deg, #007bff, #00c6ff); border-radius:2px;"></div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Kartu Utama -->
    <div class="card border-0 shadow-lg rounded-5 overflow-hidden" style="background:white;">
      <div class="card-header d-flex align-items-center justify-content-between text-white fw-semibold px-4 py-3"
           style="background: linear-gradient(90deg, #007bff, #00c6ff);">
        <div><i class="bi bi-journal-text me-2"></i>Daftar Jenis Dokumen</div>
        <div>
          <!-- Tombol Tambah Selalu Muncul -->
          <a href="{{ route('jenis.create') }}" class="btn btn-light btn-sm rounded-pill shadow-sm px-3 me-2">
            <i class="bi bi-plus-circle me-1"></i>Tambah
          </a>
          <button class="btn btn-light btn-sm fw-semibold rounded-pill shadow-sm px-3" onclick="window.location.reload()">
            <i class="bi bi-arrow-clockwise me-1"></i>Refresh
          </button>
        </div>
      </div>

      <div class="card-body p-4">
        @if($jenisDokumen->count() > 0)
        <div class="table-responsive">
          <table class="table table-borderless align-middle">
            <thead>
              <tr class="text-white" style="background: linear-gradient(90deg, #007bff, #00c6ff);">
                <th class="text-center py-3" style="width: 70px;">No</th>
                <th class="py-3">Nama Jenis Dokumen</th>
                <th class="py-3">Deskripsi</th>
                <th class="text-center py-3" style="width: 150px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($jenisDokumen as $index => $jenis)
              <tr class="table-row">
                <td class="text-center fw-bold text-primary">{{ $index + 1 }}</td>
                <td class="fw-semibold">{{ $jenis->nama_jenis }}</td>
                <td>{{ $jenis->deskripsi ?: '-' }}</td>
                <td class="text-center">
                  <div class="btn-group" role="group">
                    <a href="{{ route('jenis.edit', $jenis->id_jenis) }}" class="btn btn-warning btn-sm rounded-pill px-3 me-1" title="Edit">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('jenis.destroy', $jenis->id_jenis) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3"
                              onclick="return confirm('Apakah Anda yakin ingin menghapus jenis dokumen ini?')" title="Hapus">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="text-center py-5">
          <i class="bi bi-journal-x display-4 text-muted mb-3"></i>
          <h5 class="text-muted">Belum ada jenis dokumen</h5>
          <p class="text-muted">Klik tombol "Tambah" di atas untuk menambahkan jenis dokumen pertama</p>
        </div>
        @endif
      </div>
    </div>

    <!-- Info Statistik -->
    <div class="row mt-4">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 text-center">
          <div class="card-body py-4">
            <i class="bi bi-journal-text display-4 text-primary mb-3"></i>
            <h4 class="fw-bold text-primary">{{ $jenisDokumen->count() }}</h4>
            <p class="text-muted mb-0">Total Jenis Dokumen</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 text-center">
          <div class="card-body py-4">
            <i class="bi bi-check-circle display-4 text-success mb-3"></i>
            <h4 class="fw-bold text-success">{{ $jenisDokumen->count() }}</h4>
            <p class="text-muted mb-0">Jenis Aktif</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 text-center">
          <div class="card-body py-4">
            <i class="bi bi-clock display-4 text-warning mb-3"></i>
            <h4 class="fw-bold text-warning">0</h4>
            <p class="text-muted mb-0">Dalam Proses</p>
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
  /* Efek animasi masuk */
  @keyframes fadeInUp {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
  }

  section#jenis-dokumen {
    animation: fadeInUp 0.6s ease-out;
  }

  .card {
    transition: all 0.3s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.2);
  }

  .table-row {
    transition: all 0.25s ease;
  }

  .table-row:hover {
    background: #f0f7ff;
    transform: scale(1.01);
  }

  th {
    border-bottom: none !important;
    letter-spacing: 0.5px;
  }

  td {
    border-bottom: 1px solid #e6f0ff;
  }

  button.btn-light:hover, a.btn-light:hover {
    background-color: #f1f7ff !important;
    color: #007bff !important;
  }

  .btn-group .btn {
    border-radius: 20px !important;
  }

  .alert {
    border: none;
    border-left: 4px solid;
  }

  .alert-success {
    border-left-color: #198754;
  }

  .alert-danger {
    border-left-color: #dc3545;
  }

  /* Statistik Cards */
  .card .bi {
    opacity: 0.8;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .card-header .btn {
      margin-bottom: 5px;
      width: 100%;
    }

    .card-header > div {
      flex-direction: column;
      width: 100%;
    }

    .card-header > div > div {
      display: flex;
      flex-direction: column;
      width: 100%;
    }
  }
</style>

<!-- Script untuk animasi -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const tableRows = document.querySelectorAll('.table-row');
    tableRows.forEach((row, index) => {
      row.style.animationDelay = `${index * 0.1}s`;
    });
  });
</script>
@endsection
