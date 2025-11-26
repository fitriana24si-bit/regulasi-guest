@extends('layouts.guest.main')

@section('title', 'Daftar User')

@section('content')
    <section class="section py-5" style="background: linear-gradient(135deg, #fff8e1, #ffecb3, #ffe082); min-height: 100vh;">
        <div class="container">
            {{-- Header Halaman --}}
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-bold text-success mb-0" style="letter-spacing: .5px;">
                    👥 Daftar User Terdaftar
                </h2>
                <div>
                    <a href="{{ route('users.create') }}" class="btn btn-success rounded-pill shadow-sm px-4 me-2"
                        style="background: linear-gradient(90deg, #43a047, #66bb6a); border: none;">
                        + Tambah User
                    </a>
                   
                </div>
            </div>

            {{-- Grid User --}}
            <div class="row g-4 justify-content-center">
                @foreach ($users as $user)
                    <div class="col-md-4 col-lg-3 col-sm-6">
                        <div class="card border-0 rounded-4 shadow-sm p-4 text-center position-relative"
                            style="background: rgba(255,255,255,0.75); backdrop-filter: blur(8px); transition: all .3s ease;">

                            {{-- Highlight untuk user login --}}
                            @if (Auth::id() == $user->id)
                                <span
                                    class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-success px-3 py-2 shadow-sm"
                                    style="transform: translate(-50%, -50%);">
                                    Kamu
                                </span>
                            @endif

                            {{-- Avatar --}}
                            <div class="mb-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ffb74d&color=fff"
                                    class="rounded-circle shadow-sm border border-3 border-light" width="90"
                                    height="90" alt="Avatar">
                            </div>

                            {{-- Nama & Email --}}
                            <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
                            <p class="text-muted small mb-3">{{ $user->email }}</p>

                            {{-- Info tambahan --}}
                            <div class="border-top pt-2 small text-start mx-auto" style="max-width: 220px;">
                                <p class="mb-1"><strong>Role:</strong> <span class="text-secondary">User</span></p>
                                <p class="mb-0"><strong>Bergabung:</strong> {{ $user->created_at->format('d M Y') }}</p>
                            </div>

                            {{-- Aksi Khusus User Login --}}

                            @if (Auth::id() != $user->id)
                                <div class="mt-3 d-flex justify-content-center gap-2">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-outline-primary rounded-pill px-3 fw-semibold shadow-sm">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="delete-user-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn btn-outline-danger rounded-pill px-3 fw-semibold shadow-sm btn-hapus">
                                            🗑️ Hapus
                                        </button>
                                    </form>

                                </div>
                            @endif

                            @if (Auth::id() == $user->id)
                                <div class="mt-3 d-flex justify-content-center gap-2">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-warning rounded-pill">
                                        ✏️ Edit Profil
                                    </a>

                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-danger rounded-pill px-3 fw-semibold shadow-sm">
                                            🚪 Logout
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Style tambahan biar lembut & interaktif --}}
    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
    </style>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.btn-hapus');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const form = this.closest('.delete-user-form');

                        Swal.fire({
                            title: 'Yakin ingin menghapus?',
                            text: 'Data ini akan dihapus permanen!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal',
                            reverseButtons: true,
                            customClass: {
                                popup: 'rounded-4 shadow-lg',
                                title: 'fw-bold fs-5',
                                confirmButton: 'px-4 py-2 rounded-3',
                                cancelButton: 'px-4 py-2 rounded-3'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush

@endsection
