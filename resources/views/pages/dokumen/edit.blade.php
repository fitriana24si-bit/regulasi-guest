@extends('layouts.guest.main')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Dokumen Hukum</h1>
        <a href="{{ route('dokumen.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Dokumen Hukum</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('dokumen.update', $dokumen->dokumen_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_jenis">Jenis Dokumen *</label>
                            <select class="form-control @error('id_jenis') is-invalid @enderror"
                                    id="id_jenis" name="id_jenis" required>
                                <option value="">Pilih Jenis Dokumen</option>
                                @foreach($jenis as $item)
                                    <option value="{{ $item->id_jenis }}"
                                        {{ old('id_jenis', $dokumen->id_jenis) == $item->id_jenis ? 'selected' : '' }}>
                                        {{ $item->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori_id">Kategori Dokumen *</label>
                            <select class="form-control @error('kategori_id') is-invalid @enderror"
                                    id="kategori_id" name="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->kategori_id }}"
                                        {{ old('kategori_id', $dokumen->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nomor">Nomor Dokumen *</label>
                    <input type="text" class="form-control @error('nomor') is-invalid @enderror"
                           id="nomor" name="nomor" value="{{ old('nomor', $dokumen->nomor) }}" required>
                    @error('nomor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Judul Dokumen *</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                           id="judul" name="judul" value="{{ old('judul', $dokumen->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Dokumen *</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                   id="tanggal" name="tanggal" value="{{ old('tanggal', $dokumen->tanggal->format('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status Dokumen *</label>
                            <select class="form-control @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option value="aktif" {{ old('status', $dokumen->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ old('status', $dokumen->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ringkasan">Ringkasan Dokumen</label>
                    <textarea class="form-control @error('ringkasan') is-invalid @enderror"
                              id="ringkasan" name="ringkasan" rows="4">{{ old('ringkasan', $dokumen->ringkasan) }}</textarea>
                    @error('ringkasan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file_dokumen">File Dokumen</label>
                    <input type="file" class="form-control @error('file_dokumen') is-invalid @enderror"
                           id="file_dokumen" name="file_dokumen" accept=".pdf,.doc,.docx,.xls,.xlsx">
                    @error('file_dokumen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($dokumen->file_path)
                        <small class="form-text text-muted">
                            File saat ini:
                            <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank" class="text-decoration-none">
                                <i class="fas fa-file me-1"></i>{{ basename($dokumen->file_path) }}
                            </a>
                        </small>
                    @endif
                </div>

                <!-- Tombol Update yang sebelumnya tidak ada -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dokumen.show', $dokumen->dokumen_id) }}"
                           class="btn btn-outline-primary" target="_blank">
                            <i class="fas fa-eye me-1"></i> Preview
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Dokumen
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-group {
    margin-bottom: 1.5rem;
}

.form-control, .form-select {
    border-radius: 0.35rem;
    padding: 0.75rem;
}

.btn {
    border-radius: 0.35rem;
    padding: 0.5rem 1.5rem;
    font-weight: 500;
}

.btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
}

.btn-primary:hover {
    background-color: #2e59d9;
    border-color: #2e59d9;
    transform: translateY(-1px);
    transition: all 0.2s;
}

.card {
    border: none;
    border-radius: 0.35rem;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.invalid-feedback {
    display: block;
}

.border-top {
    border-top: 1px solid #e3e6f0 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validasi form sebelum submit
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');

                // Buat pesan error jika belum ada
                if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = 'Field ini wajib diisi.';
                    field.parentNode.insertBefore(errorDiv, field.nextSibling);
                }
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            // Scroll ke field pertama yang error
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    // Real-time validation
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });

    // File size validation
    const fileInput = document.getElementById('file_dokumen');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const fileSize = file.size / 1024 / 1024; // Size in MB
                if (fileSize > 10) {
                    alert('Ukuran file maksimal 10MB');
                    this.value = '';
                }
            }
        });
    }
});
</script>
@endsection
