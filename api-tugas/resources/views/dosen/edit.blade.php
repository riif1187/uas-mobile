@extends('layout.app')

@section('title', 'Edit Dosen')

@section('content')
    <div class="card-body p-4">
        <h3 class="title-page mb-4">Edit Data Dosen</h3>

        <form action="{{ route('dosen.update', $dosen->NIP) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                {{-- Kolom Kiri --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="NIP" class="form-label">NIP</label>
                        <input type="text" id="NIP" name="NIP" 
                            class="form-control bg-light" 
                            value="{{ $dosen->NIP }}" readonly>
                        <small class="text-muted">NIP tidak dapat diubah</small>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" 
                            class="form-control @error('nama') is-invalid @enderror" 
                            value="{{ old('nama', $dosen->nama) }}" required>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <input type="text" id="fakultas" name="fakultas" 
                            class="form-control @error('fakultas') is-invalid @enderror" 
                            value="{{ old('fakultas', $dosen->fakultas) }}" required>
                        @error('fakultas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <input type="text" id="prodi" name="prodi" 
                            class="form-control @error('prodi') is-invalid @enderror" 
                            value="{{ old('prodi', $dosen->prodi) }}" required>
                        @error('prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jabatan_akademik" class="form-label">Jabatan Akademik</label>
                        <select id="jabatan_akademik" name="jabatan_akademik" 
                            class="form-select @error('jabatan_akademik') is-invalid @enderror" required>
                            <option value="Dosen akademik" {{ old('jabatan_akademik', $dosen->jabatan_akademik) == 'Dosen akademik' ? 'selected' : '' }}>Dosen akademik</option>
                            <option value="Kaprodi" {{ old('jabatan_akademik', $dosen->jabatan_akademik) == 'Kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                            <option value="Dekan" {{ old('jabatan_akademik', $dosen->jabatan_akademik) == 'Dekan' ? 'selected' : '' }}>Dekan</option>
                            <option value="Rektor" {{ old('jabatan_akademik', $dosen->jabatan_akademik) == 'Rektor' ? 'selected' : '' }}>Rektor</option>
                        </select>
                        @error('jabatan_akademik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email', $dosen->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No. Telepon</label>
                        <input type="text" id="no_telepon" name="no_telepon" 
                            class="form-control @error('no_telepon') is-invalid @enderror" 
                            value="{{ old('no_telepon', $dosen->no_telepon) }}" required>
                        @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status_aktif" class="form-label">Status Aktif</label>
                        <select id="status_aktif" name="status_aktif" 
                            class="form-select @error('status_aktif') is-invalid @enderror">
                            <option value="1" {{ old('status_aktif', $dosen->status_aktif) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_aktif', $dosen->status_aktif) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status_aktif') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update
                </button>
                <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection