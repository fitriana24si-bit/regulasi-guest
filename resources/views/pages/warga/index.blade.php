@extends('layouts.guest.main')

@section('title', 'Data Warga | Regulasi Desa')
@include('layouts.guest.css')

@section('content')
<style>
    body {
        background-color: #fff8f0 !important;
    }

    #data-warga {
        background: linear-gradient(180deg, #cc8624 0%, #fad492 100%);
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

    /* NEW STYLES FOR SEARCH & FILTER */
    .search-filter-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .search-filter-card .card-body {
        padding: 1.5rem;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    .btn-search {
        background: #dd2c2c;
        border: none;
        border-radius: 10px;
        color: white;
    }

    .btn-search:hover {
        background: #b02222;
    }

    .btn-reset {
        background: #6c757d;
        border: none;
        border-radius: 10px;
        color: white;
    }

    .pagination-info {
        color: white;
        font-size: 0.9rem;
    }

    .pagination .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: none;
        color: #6c757d;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }
</style>

<section id="data-warga" data-aos="fade-up">
    <div class="container">
        {{-- Header --}}
        <div class="section-header text-center mb-5">
            <h2>Data Warga</h2>
            <hr class="orange-line">
            <p>Daftar data warga yang terdaftar dalam sistem regulasi desa</p>
            {{-- Role Badge --}}
            <div class="mt-3">
                <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'danger' : 'primary' }} p-2">
                    <i class="bi bi-person-badge me-1"></i>
                    {{ auth()->user()->role === 'admin' ? 'Administrator' : 'User' }}
                    @if(auth()->user()->role === 'user')
                        (Hanya Baca)
                    @endif
                </span>
            </div>
        </div>

        {{-- NEW: Search & Filter Section --}}
        <div class="card search-filter-card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('warga.index') }}" id="searchForm">
                    <div class="row g-3 align-items-end">
                        {{-- Search Input --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted">Pencarian</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                       value="{{ request('search') }}"
                                       placeholder="Cari nama, KTP, email...">
                                <button type="submit" class="btn btn-search">
                                    <i class="bi bi-search"></i>
                                </button>
                                @if(request('search'))
                                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                       class="btn btn-reset">
                                        <i class="bi bi-x"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Jenis Kelamin Filter --}}
                        <div class="col-md-2">
                            <label class="form-label fw-bold text-muted">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua</option>
                                @foreach($jenisKelaminList as $jk)
                                    <option value="{{ $jk }}" {{ request('jenis_kelamin') == $jk ? 'selected' : '' }}>
                                        {{ $jk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Agama Filter --}}
                        <div class="col-md-2">
                            <label class="form-label fw-bold text-muted">Agama</label>
                            <select name="agama" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua</option>
                                @foreach($agamaList as $agama)
                                    <option value="{{ $agama }}" {{ request('agama') == $agama ? 'selected' : '' }}>
                                        {{ $agama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Pekerjaan Filter --}}
                        <div class="col-md-2">
                            <label class="form-label fw-bold text-muted">Pekerjaan</label>
                            <select name="pekerjaan" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua</option>
                                @foreach($pekerjaanList as $pekerjaan)
                                    <option value="{{ $pekerjaan }}" {{ request('pekerjaan') == $pekerjaan ? 'selected' : '' }}>
                                        {{ $pekerjaan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Reset Filter --}}
                        <div class="col-md-2">
                            <label class="form-label fw-bold text-muted">&nbsp;</label>
                            <div>
                                <a href="{{ route('warga.index') }}" class="btn btn-reset w-100">
                                    <i class="bi bi-arrow-clockwise me-1"></i>Reset
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Filter Info --}}
                    <div class="row mt-3">
                        <div class="col-12">
                            <span class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                {{ $warga->total() }} warga ditemukan
                                @if(request('search') || request('jenis_kelamin') || request('agama') || request('pekerjaan'))
                                    (difilter)
                                @endif
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tombol Tambah --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="pagination-info">
                Menampilkan {{ $warga->firstItem() ?? 0 }} - {{ $warga->lastItem() ?? 0 }} dari {{ $warga->total() }} warga
            </div>
            {{-- Tombol Tambah hanya untuk admin --}}
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('warga.create') }}" class="btn btn-success px-4 shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Warga
                </a>
            @endif
        </div>

        {{-- Grid Card --}}
        <div class="row g-4">
            @forelse($warga as $index => $w)
                <div class="col-md-4 col-lg-3">
                    <div class="card-warga">
                        <div class="card-body text-center">
                            {{-- NEW: Nomor Urut --}}
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-dark">#{{ ($warga->currentPage() - 1) * $warga->perPage() + $loop->iteration }}</span>
                            </div>

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
                            {{-- Action Buttons dengan role checking --}}
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Edit button hanya untuk admin --}}
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('warga.edit', $w->warga_id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                @endif
                                {{-- Delete button hanya untuk admin --}}
                                @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('warga.destroy', $w->warga_id) }}" method="POST" class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-white">
                    <i class="bi bi-info-circle" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">Belum ada data warga</h4>
                    <p class="mb-4">
                        @if(request('search') || request('jenis_kelamin') || request('agama') || request('pekerjaan'))
                            Tidak ditemukan warga dengan filter yang dipilih
                        @else
                            Mulai dengan menambahkan data warga pertama
                        @endif
                    </p>
                    {{-- Tombol Tambah hanya untuk admin --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('warga.create') }}" class="btn btn-success btn-lg">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Warga Pertama
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- NEW: Pagination --}}
        @if($warga->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <nav>
                        {{ $warga->links('pagination::bootstrap-5') }}
                    </nav>
                </div>
            </div>
        </div>
        @endif
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

    // NEW: Auto search dengan delay
    document.addEventListener('DOMContentLoaded', function() {
        let searchTimeout;
        const searchInput = document.querySelector('input[name="search"]');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    document.getElementById('searchForm').submit();
                }, 500);
            });
        }
    });
</script>
@endsection
