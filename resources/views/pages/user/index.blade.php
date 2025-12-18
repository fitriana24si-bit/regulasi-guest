@extends('layouts.guest.main')

@section('content')
    <div class="container py-4">

        {{-- TITLE + TOMBOL TAMBAH USER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0" style="color:#4b0082;">
                <i class="bi bi-people-fill"></i> Daftar User Terdaftar
            </h2>

            {{-- TOMBOL TAMBAH USER --}}
            <a href="{{ route('pages.user.create') }}" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah User
            </a>
        </div>

        {{-- ================= FILTER FORM ================= --}}
        <form method="GET" action="{{ route('pages.user.index') }}" class="mb-4">
            <div class="row g-2">

                <div class="col-md-3">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari nama / email"
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-2">
                    <select name="role" class="form-select">
                        <option value="all">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="all">Semua Status</option>
                        <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                        <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>Unverified</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="sort" class="form-select">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                    </select>
                </div>

                <div class="col-md-1">
                    <select name="per_page" class="form-select">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
            </div>

            @if (request()->query() != [])
                <div class="mt-2">
                    <a href="{{ route('pages.user.index') }}" class="btn btn-secondary btn-sm">Reset Filter</a>
                </div>
            @endif
        </form>

        {{-- ================= USER CARD UI ================= --}}
        <div class="row">
            @forelse($users as $u)
                <div class="col-md-3 mb-4">

                    @if (Auth::id() == $u->id)
                        <div class="text-center mb-1">
                            <span class="badge"
                                style="background:#28a745;color:white;padding:6px 12px;border-radius:20px;font-size:13px;">
                                Kamu
                            </span>
                        </div>
                    @endif

                    <div class="card shadow-sm p-3"
                        style="border-radius: 20px; background: #fffde7;">
                        <div class="text-center">

                            {{-- Profile Image or Initials --}}
                            @if($u->profile_image)
                                <img src="{{ asset('storage/' . $u->profile_image) }}"
                                     style="width:70px;height:70px;border-radius:50%;object-fit:cover;margin:auto;border:3px solid #ffcc66;"
                                     alt="{{ $u->name }}" class="img-fluid">
                            @else
                                <div
                                    style="width:70px;height:70px;border-radius:50%;background:#ffcc66;display:flex;align-items:center;justify-content:center;font-size:24px;font-weight:bold;margin:auto;border:3px solid #ffcc66;">
                                    {{ strtoupper(substr($u->name, 0, 2)) }}
                                </div>
                            @endif

                            <h5 class="mt-3 fw-bold">{{ $u->name }}</h5>
                            <small class="text-muted">{{ $u->email }}</small>

                            <hr>

                            <p class="mb-1"><strong>Role:</strong> {{ $u->role ?? '-' }}</p>
                            <p class="mb-1"><strong>Bergabung:</strong> {{ $u->created_at->format('d M Y') }}</p>

                            <p class="mt-2">
                                @if ($u->email_verified_at)
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-danger">Unverified</span>
                                @endif
                            </p>

                            {{-- Buttons --}}
                            <div class="d-flex justify-content-center gap-2 mt-2">
                                {{-- EDIT --}}
                                <a href="{{ route('pages.user.edit', $u->id) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                {{-- DELETE --}}
                                <form method="POST" action="{{ route('pages.user.destroy', $u->id) }}">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            @empty
                <div class="text-center text-muted py-5">Tidak ada data ditemukan</div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
