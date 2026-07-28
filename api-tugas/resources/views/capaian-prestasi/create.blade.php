@extends('layout.app')

@section('title', 'Tambah Capaian Prestasi')

@section('content')
    <div class="card-body p-4">
        <h3 class="title-page mb-4">Tambah Capaian Prestasi</h3>

        <form action="{{ route('capaian-prestasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pendaftaran_id" class="form-label">Pendaftaran</label>
                        <select id="pendaftaran_id" name="pendaftaran_id" class="form-select @error('pendaftaran_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Pendaftaran --</option>
                            @foreach($pendaftaran as $daftar)
                                <option value="{{ $daftar->pendaftaran_id }}" {{ old('pendaftaran_id') == $daftar->pendaftaran_id ? 'selected' : '' }}>
                                    {{ $daftar->nama_kegiatan }} ({{ $daftar->mahasiswa->nama ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        @error('pendaftaran_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="NIP" class="form-label">Dosen Pembimbing</label>
                        <select id="NIP" name="NIP" class="form-select @error('NIP') is-invalid @enderror" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dosen as $dsn)
                                <option value="{{ $dsn->NIP }}" {{ old('NIP') == $dsn->NIP ? 'selected' : '' }}>
                                    {{ $dsn->NIP }} - {{ $dsn->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('NIP') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="peringkat" class="form-label">Peringkat</label>
                        <input type="text" id="peringkat" name="peringkat"
                            class="form-control @error('peringkat') is-invalid @enderror"
                            placeholder="Contoh: Juara 1" value="{{ old('peringkat') }}" required>
                        @error('peringkat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="file_bukti" class="form-label">File Bukti</label>
                        <input type="file" id="file_bukti" name="file_bukti"
                            class="form-control @error('file_bukti') is-invalid @enderror"
                            accept=".pdf,.jpg,.jpeg,.png" required>
                        <small class="text-muted">PDF, JPG, JPEG, atau PNG. Maksimal 2MB.</small>
                        @error('file_bukti') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Simpan
                </button>
                <a href="{{ route('capaian-prestasi.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection
