@extends('layouts.guest.main')

@section('title', 'Edit Jenis Dokumen | Regna')

@section('content')
<section id="edit-jenis" class="py-5" style="background: linear-gradient(to bottom right, #f5faff, #e6f0ff); min-height: 100vh;">
  <div class="container" data-aos="fade-up">

    <!-- Header Halaman -->
    <div class="text-center mb-5">
      <h2 class="fw-bold mb-2" style="color:#0056d2;">✏️ Edit Jenis Dokumen</h2>
      <p class="text-secondary fs-5">Perbarui informasi jenis dokumen.</p>
      <div class="mx-auto" style="width:100px; height:4px; background:linear-gradient(90deg, #007bff, #00c6ff); border-radius:2px;"></div>
    </div>

    <!-- Kartu Form -->
    <div class="card border-0 shadow-lg rounded-5 overflow-hidden mx-auto" style="background:white; max-width: 600px;">
      <div class="card-header text-white fw-semibold px-4 py-3 text-center"
           style="background: linear-gradient(90deg, #007bff, #00c6ff);">
        <i class="bi bi-pencil-square me-2"></i>Form Edit Jenis Dokumen
      </div>

      <div class="card-body p-4">
        <form action="{{ route('jenis.update', $jenis->id_jenis) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-4">
            <label for="nama_jenis" class="form-label fw-semibold">Nama Jenis Dokumen <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-4 @error('nama_jenis') is-invalid @enderror"
                   id="nama_jenis" name="nama_jenis"
                   value="{{ old('nama_jenis', $jenis->nama_jenis) }}"
                   placeholder="Masukkan nama jenis dokumen" required>
            @error('nama_jenis')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
            <textarea class="form-control rounded-4 @error('deskripsi') is-invalid @enderror"
                      id="deskripsi" name="deskripsi" rows="4"
                      placeholder="Masukkan deskripsi jenis dokumen">{{ old('deskripsi', $jenis->deskripsi) }}</textarea>
            @error('deskripsi')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('jenis.index') }}" class="btn btn-secondary rounded-pill px-4">
              <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
            <button type="submit" class="btn btn-primary rounded-pill px-4">
              <i class="bi bi-save me-1"></i>Update
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</section>


@endsection
