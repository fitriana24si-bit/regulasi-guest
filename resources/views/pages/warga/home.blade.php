@extends('layouts.main')

@section('title', 'Home | Data Warga')

@section('content')
<div class="container py-5">
  <h2 class="text-center mb-4 fw-bold text-primary">📋 Data Warga</h2>

  <div class="table-responsive">
    <table class="table table-bordered table-hover shadow-sm align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>No</th>
          <th>No. KTP</th>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>Agama</th>
          <th>Pekerjaan</th>
          <th>Telp</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        @forelse($wargas as $index => $w)
        <tr>
          <td class="text-center">{{ $index + 1 }}</td>
          <td>{{ $w->no_ktp }}</td>
          <td>{{ $w->nama }}</td>
          <td>{{ $w->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
          <td>{{ $w->agama }}</td>
          <td>{{ $w->pekerjaan }}</td>
          <td>{{ $w->telp ?? '-' }}</td>
          <td>{{ $w->email ?? '-' }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="text-center text-muted py-4">Belum ada data warga</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
