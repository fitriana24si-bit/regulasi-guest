@extends('layouts.guest.main')

@section('content')
<div class="container">

    <h4>Upload File</h4>

    <form method="POST" action="{{ route('media.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <input type="file" name="file" class="form-control" required>
        </div>

        <button class="btn btn-primary">Upload</button>
        <a href="{{ route('media.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection
