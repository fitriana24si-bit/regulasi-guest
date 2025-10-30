@extends('layouts.main')

@section('title', 'Data Warga')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 fw-bold text-primary">Data Warga</h3>

    <a href="{{ route('warga.create') }}" class="btn btn-success mb-3">+ Tambah Warga</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>No KTP</th>
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
            @foreach($warga as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->no_ktp }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->agama }}</td>
                    <td>{{ $item->pekerjaan }}</td>
                    <td>{{ $item->telp }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
