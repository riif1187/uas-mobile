@extends('layout.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
    <div class="card-body p-4">
        <h3 class="title-page mb-4">Tambah Mata Kuliah</h3>

        <form action="{{ route('mata-kuliah.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
                <input type="text" id="kode_matkul" name="kode_matkul" 
                    class="form-control @error('kode_matkul') is-invalid @enderror" 
                    placeholder="Kode mata kuliah" required>
                @error('kode_matkul') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                <input type="text" id="nama_matkul" name="nama_matkul" 
                    class="form-control @error('nama_matkul') is-invalid @enderror" 
                    placeholder="Nama mata kuliah" required>
                @error('nama_matkul') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sks" class="form-label">SKS</label>
                        <input type="number" id="sks" name="sks" 
                            class="form-control @error('sks') is-invalid @enderror" 
                            placeholder="Jumlah SKS" required>
                        @error('sks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="number" id="semester" name="semester" 
                            class="form-control @error('semester') is-invalid @enderror" 
                            placeholder="Semester" required>
                        @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Program Studi</label>
                <input type="text" id="prodi" name="prodi" 
                    class="form-control @error('prodi') is-invalid @enderror" 
                    placeholder="Program studi" required>
                @error('prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select id="jenis" name="jenis" 
                            class="form-select @error('jenis') is-invalid @enderror" required>
                            <option value="">-- Pilih --</option>
                            <option value="wajib">Wajib</option>
                            <option value="pilihan">Pilihan</option>
                        </select>
                        @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status_aktif" class="form-label">Status Aktif</label>
                        <select id="status_aktif" name="status_aktif" 
                            class="form-select @error('status_aktif') is-invalid @enderror">
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
                <a href="{{ route('mata-kuliah.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection