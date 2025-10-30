@extends('layouts.main')

@section('title', 'Riwayat Perubahan | Regna')

@section('content')
<div class="mb-4">
  <h3 class="fw-bold text-info">Riwayat Perubahan</h3>
  <p class="text-secondary">Catatan seluruh pembaruan dan revisi dokumen hukum.</p>
</div>

<div class="card p-4 shadow-sm">
  <table class="table table-hover">
    <thead class="table-info">
      <tr>
        <th>No</th>
        <th>Dokumen</th>
        <th>Tanggal Perubahan</th>
        <th>Deskripsi</th>
      </tr>
    </thead>
    <tbody>
      <tr><td>1</td><td>Perda No.3/2024</td><td>2025-02-01</td><td>Pembaruan Pasal 5 Ayat 2</td></tr>
      <tr><td>2</td><td>SK Walikota RTRW</td><td>2025-03-10</td><td>Perubahan nama instansi penerbit</td></tr>
    </tbody>
  </table>
</div>
@endsection
