@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">403 - Akses Ditolak</h5>
                </div>

                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-ban fa-5x text-danger"></i>
                    </div>

                    <h3 class="mb-3">Akses Ditolak!</h3>
                    <p class="text-muted mb-4">
                        Anda tidak memiliki izin untuk mengakses halaman ini.
                        <br>
                        Halaman ini hanya dapat diakses oleh <strong>{{ $requiredRole ?? 'role tertentu' }}</strong>.
                    </p>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ url()->previous() }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-success">
                            <i class="fas fa-home"></i> Ke Dashboard
                        </a>

                        @if(auth()->check() && auth()->user()->isUser())
                            <a href="{{ route('user.my-profile') }}" class="btn btn-info">
                                <i class="fas fa-user"></i> Ke Profile Saya
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
