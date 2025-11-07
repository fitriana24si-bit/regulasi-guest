@extends('layouts.guest.main')

@section('title', 'Data Warga | Regulasi Desa')

@section('content')
<!-- ====== STYLE KHUSUS HALAMAN DATA WARGA ====== -->
<style>
    body {
        background-color: #fff8f0 !important;
    }

    #data-warga {
        background: linear-gradient(180deg, #cc8624 0%, #a17f19 100%);
        min-height: 100vh;
        padding: 100px 0 60px;
        color: #333;
    }

    .section-header h2 {
        color: #fff;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .section-header p {
        color: #fff8f0;
    }

    .card {
        border: none;
        border-radius: 15px;
        background: #fff;
    }

    .card-body {
        padding: 2rem;
    }

    table thead {
        background-color: #da8729;
        color: #fff;
        font-weight: bold;
    }

    table tbody tr:hover {
        background-color: #fff3e0;
        transition: all 0.3s ease;
    }

    .btn-success {
        background-color: #dd2c2c;
        border: none;
        font-weight: 600;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #000;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .badge.bg-primary {
        background-color: #ff7043 !important;
    }

    .badge.bg-danger {
        background-color: #e53935 !important;
    }

    hr.orange-line {
        width: 100px;
        height: 3px;
        background: #dfc9c9;
        border: none;
        margin: 0 auto 30px;
    }
</style>

<!-- ======= Data Warga Section ======= -->
<section id="data-warga" data-aos="fade-up">

  <div class="container">

    {{-- Header --}}
    <div class="section-header text-center mb-5">
      <h2>Data Warga</h2>
      <hr class="orange-line">
      <p>Daftar data warga yang terdaftar dalam sistem regulasi desa</p>
    </div>

    {{-- Tombol Tambah --}}
    <div class="d-flex justify-content-end mb-3">
      <a href="{{ route('warga.create') }}" class="btn btn-success px-4 shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Tambah Warga
      </a>
    </div>

    {{-- Card --}}
    <div class="card shadow-lg rounded-4">
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-hover align-middle text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>No. KTP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Pekerjaan</th>
                <th>Telp</th>
                <th>Email</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($warga as $index => $w)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $w->no_ktp }}</td>
                <td class="fw-semibold">{{ $w->nama }}</td>
                <td>
                  <span class="badge {{ $w->jenis_kelamin == 'L' ? 'bg-primary' : 'bg-danger' }}">
                    {{ $w->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                  </span>
                </td>
                <td>{{ $w->agama }}</td>
                <td>{{ ucfirst($w->pekerjaan) }}</td>
                <td>{{ $w->telp ?? '-' }}</td>
                <td>{{ $w->email ?? '-' }}</td>
                <td>
                  <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('warga.edit', $w->warga_id) }}" class="btn btn-warning btn-sm">
                      <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('warga.destroy', $w->warga_id) }}" method="POST" class="form-delete">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-danger btn-sm btn-delete">
                        <i class="bi bi-trash"></i> Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="9" class="text-center py-4 text-muted">
                  <i class="bi bi-info-circle"></i> Belum ada data warga
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>
</section>

{{-- ==== SweetAlert2 ==== --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Konfirmasi Hapus
  document.querySelectorAll('.btn-delete').forEach(button => {
      button.addEventListener('click', function(e) {
          e.preventDefault();
          const form = this.closest('.form-delete');
          Swal.fire({
              title: 'Yakin ingin menghapus?',
              text: "Data ini akan dihapus permanen!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Ya, hapus!',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  form.submit();
              }
          });
      });
  });

  // Notifikasi sukses (dari session)
  @if (session('success'))
      Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: '{{ session('success') }}',
          showConfirmButton: false,
          timer: 2000
      });
  @endif
</script>
@endsection
