@extends('layouts.main')

@section('title', 'Lampiran Dokumen | Regna')

@section('content')
<div class="mb-4">
  <h3 class="fw-bold text-danger">Lampiran Dokumen</h3>
  <p class="text-secondary">Daftar file lampiran yang terkait dengan dokumen hukum.</p>
</div>

<div class="card p-4 shadow-sm">
  <table class="table table-striped">
    <thead class="table-danger">
      <tr>
        <th>No</th>
        <th>Nama Lampiran</th>
        <th>Tipe File</th>
        <th>Dokumen Terkait</th>
      </tr>
    </thead>
    <tbody>
      <tr><td>1</td><td>Lampiran Peta Wilayah.pdf</td><td>PDF</td><td>Perda No.3/2024</td></tr>
      <tr><td>2</td><td>Lampiran Draft Revisi.docx</td><td>Word</td><td>SK Walikota RTRW</td></tr>
    </tbody>
  </table>
</div>
@endsection
    