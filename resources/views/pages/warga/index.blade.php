@extends('layouts.guest.main')

@section('title', 'Data Warga | Regulasi Desa')

@section('content')
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

    .card-warga {
        border: none;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-warga:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .card-warga .card-body {
        padding: 1.8rem;
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

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #000;
        font-weight: 600;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        font-weight: 600;
    }

    .btn-success {
        background-color: #dd2c2c;
        border: none;
        font-weight: 600;
    }

    .btn-success:hover {
        background-color: #b02222;
    }
</style>

<section id="data-warga" data-aos="fade-up">
    <div class="container">
        {{-- Header --}}
        <div class="section-header text-center mb-5">
            <h2>Data Warga</h2>
            <hr class="orange-line">
            <p>Daftar data warga yang terdaftar dalam sistem regulasi desa</p>
        </div>

        {{-- Tombol Tambah --}}
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('warga.create') }}" class="btn btn-success px-4 shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Warga
            </a>
        </div>

        {{-- Grid Card --}}
        <div class="row g-4">
            @forelse($warga as $index => $w)
                <div class="col-md-4 col-lg-3">
                    <div class="card-warga">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-person-circle text-warning" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="fw-bold mb-1">{{ $w->nama }}</h5>
                            <span class="badge {{ $w->jenis_kelamin == 'L' ? 'bg-primary' : 'bg-danger' }}">
                                {{ $w->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                            <hr>
                            <p class="mb-1"><strong>No. KTP:</strong> {{ $w->no_ktp }}</p>
                            <p class="mb-1"><strong>Agama:</strong> {{ $w->agama }}</p>
                            <p class="mb-1"><strong>Pekerjaan:</strong> {{ ucfirst($w->pekerjaan) }}</p>
                            <p class="mb-1"><strong>Telp:</strong> {{ $w->telp ?? '-' }}</p>
                            <p class="mb-3"><strong>Email:</strong> {{ $w->email ?? '-' }}</p>
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
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-white">
                    <i class="bi bi-info-circle"></i> Belum ada data warga
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- SweetAlert2 --}}
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

    // Notifikasi sukses
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
