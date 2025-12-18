@extends('layouts.guest.main')

@section('content')
    <div class="container mt-4">

        <h3>Tambah Lampiran</h3>

        {{-- TAMPIL ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lampiran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Pilih Dokumen</label>
            <select name="dokumen_id" class="form-control mb-3" required>
                @foreach ($dokumen as $d)
                    <option value="{{ $d->dokumen_id }}">{{ $d->judul }}</option>
                @endforeach
            </select>

            <label>Pilih File</label>
            <input type="file" name="file[]" multiple class="form-control">

            <button class="btn btn-primary mt-3">Upload</button>
        </form>

    </div>
@endsection
