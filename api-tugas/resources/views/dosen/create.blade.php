@extends('layout.app')

@section('title', 'Tambah Dosen')

@section('content')
    <div class="card-body p-4">
        <h3 class="title-page mb-4">Tambah Data Dosen</h3>

        <form action="{{ route('dosen.store') }}" method="POST">
            @csrf
            <div class="row">
                {{-- Kolom Kiri --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="NIP" class="form-label">NIP</label>
                        <input type="text" id="NIP" name="NIP" 
                            class="form-control @error('NIP') is-invalid @enderror" 
                            placeholder="Nomor Induk Pegawai" required>
                        @error('NIP') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" 
                            class="form-control @error('nama') is-invalid @enderror" 
                            placeholder="Nama lengkap dosen" required>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <input type="text" id="fakultas" name="fakultas" 
                            class="form-control @error('fakultas') is-invalid @enderror" 
                            placeholder="Nama fakultas" required>
                        @error('fakultas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <input type="text" id="prodi" name="prodi" 
                            class="form-control @error('prodi') is-invalid @enderror" 
                            placeholder="Program studi" required>
                        @error('prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jabatan_akademik" class="form-label">Jabatan Akademik</label>
                        <select id="jabatan_akademik" name="jabatan_akademik" 
                            class="form-select @error('jabatan_akademik') is-invalid @enderror" required>
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="Dosen akademik">Dosen akademik</option>
                            <option value="Kaprodi">Kaprodi</option>
                            <option value="Dekan">Dekan</option>
                            <option value="Rektor">Rektor</option>
                        </select>
                        @error('jabatan_akademik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            placeholder="Email dosen" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No. Telepon</label>
                        <input type="text" id="no_telepon" name="no_telepon" 
                            class="form-control @error('no_telepon') is-invalid @enderror" 
                            placeholder="Nomor telepon" required>
                        @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status_aktif" class="form-label">Status Aktif</label>
                        <select id="status_aktif" name="status_aktif" 
                            class="form-select @error('status_aktif') is-invalid @enderror" required>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                        @error('status_aktif') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Simpan
                </button>
                <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection