@extends('layouts.main')

@section('title', 'Jenis Dokumen | Regna')

@section('content')
<div class="mb-4">
  <h3 class="fw-bold text-primary">Jenis Dokumen</h3>
  <p class="text-secondary">Daftar jenis-jenis dokumen hukum yang tersedia.</p>
</div>

<div class="card p-4 shadow-sm">
  <table class="table table-striped align-middle">
    <thead class="table-primary">
      <tr>
        <th>No</th>
        <th>Nama Jenis Dokumen</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <tr><td>1</td><td>Peraturan Daerah</td><td>Peraturan hukum tingkat daerah.</td></tr>
      <tr><td>2</td><td>Keputusan Walikota</td><td>Keputusan resmi dari kepala daerah.</td></tr>
    </tbody>
  </table>
</div>
@endsection
