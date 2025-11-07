@extends('layouts.guest.main')

@section('title', 'Tambah Data Warga | Regna')

@section('content')
<section id="tambah-warga" class="py-5" style="background: linear-gradient(to bottom right, #f5faff, #e6f0ff); min-height: 100vh;">
  <div class="container" data-aos="fade-up">

    <!-- Header Halaman -->
    <div class="text-center mb-5">
      <h1 class="fw-bold mb-2" style="color:#0056d2;">Tambah Data Warga</h1>
      <div class="mx-auto" style="width:100px; height:4px; background:linear-gradient(90deg, #007bff, #00c6ff); border-radius:2px;"></div>
    </div>

    <!-- Kartu Form -->
    <div class="card border-0 shadow-lg rounded-5 overflow-hidden mx-auto" style="background:white; max-width: 800px;">
      <div class="card-header text-white fw-semibold px-4 py-3 text-center"
           style="background: linear-gradient(90deg, #007bff, #00c6ff);">
        <i class="bi bi-person-plus me-2"></i>Form Tambah Data Warga
      </div>

      <div class="card-body p-4">
        <form action="{{ route('warga.store') }}" method="POST">
          @csrf

          <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
              <div class="mb-4">
                <label for="no_ktp" class="form-label fw-semibold">No. KTP <span class="text-danger">*</span></label>
                <input type="text" class="form-control rounded-4 @error('no_ktp') is-invalid @enderror"
                       id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}"
                       placeholder="Masukkan nomor KTP" required>
                @error('no_ktp')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-control rounded-4 @error('jenis_kelamin') is-invalid @enderror"
                        id="jenis_kelamin" name="jenis_kelamin" required>
                  <option value="">- Pilih -</option>
                  <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label for="pekerjaan" class="form-label fw-semibold">Pekerjaan</label>
                <input type="text" class="form-control rounded-4 @error('pekerjaan') is-invalid @enderror"
                       id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}"
                       placeholder="Masukkan pekerjaan">
                @error('pekerjaan')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label for="email" class="form-label fw-semibold">Alamat Email</label>
                <input type="email" class="form-control rounded-4 @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}"
                       placeholder="Masukkan alamat email">
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
              <div class="mb-4">
                <label for="nama" class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control rounded-4 @error('nama') is-invalid @enderror"
                       id="nama" name="nama" value="{{ old('nama') }}"
                       placeholder="Masukkan nama lengkap" required>
                @error('nama')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label for="agama" class="form-label fw-semibold">Agama</label>
                <select class="form-control rounded-4 @error('agama') is-invalid @enderror"
                        id="agama" name="agama">
                  <option value="">- Pilih Agama -</option>
                  <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                  <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                  <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                  <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                  <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                  <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
                @error('agama')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label for="telp" class="form-label fw-semibold">No. Telepon</label>
                <input type="text" class="form-control rounded-4 @error('telp') is-invalid @enderror"
                       id="telp" name="telp" value="{{ old('telp') }}"
                       placeholder="Masukkan nomor telepon">
                @error('telp')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <!-- Tombol Aksi -->
          <div class="d-flex gap-2 justify-content-end mt-4">
            <a href="{{ route('warga.index') }}" class="btn btn-secondary rounded-pill px-4">
              <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
            <button type="submit" class="btn btn-primary rounded-pill px-4">
              <i class="bi bi-save me-1"></i>Simpan
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</section>

<style>
  section#tambah-warga {
    animation: fadeInUp 0.6s ease-out;
  }

  .form-control {
    border: 1px solid #e0e0e0;
    padding: 12px 16px;
    transition: all 0.3s ease;
  }

  .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.1);
  }

  .btn {
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .btn:hover {
    transform: translateY(-2px);
  }

  select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 16px 12px;
  }
</style>
@endsection
