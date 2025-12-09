@extends('layouts.guest.main')

@section('content')
<div class="container mt-4">

    <h3>Edit Lampiran</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lampiran.update', $lampiran->lampiran_id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <label class="mt-2">Nama / Keterangan Lampiran</label>
        <input type="text" class="form-control mb-3"
               name="nama_file"
               value="{{ $lampiran->nama_file }}">

        <label class="mt-2">Ganti File (opsional)</label>
        <input type="file" class="form-control mb-3" name="file">

        <button class="btn btn-primary">Simpan Perubahan</button>

    </form>

</div>
@endsection
