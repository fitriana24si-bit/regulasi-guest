@extends('layouts.main')

@section('title', 'Kategori Dokumen | Regna')

@section('content')
<div class="mb-4">
  <h3 class="fw-bold text-success">Kategori Dokumen</h3>
  <p class="text-secondary">Klasifikasi dokumen berdasarkan kategori tertentu.</p>
</div>

<div class="card p-4 shadow-sm">
  <ul class="list-group">
    <li class="list-group-item">Peraturan Umum</li>
    <li class="list-group-item">Kebijakan Daerah</li>
    <li class="list-group-item">Perjanjian Kerjasama</li>
  </ul>
</div>
@endsection
