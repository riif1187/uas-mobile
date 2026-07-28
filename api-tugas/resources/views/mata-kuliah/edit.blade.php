    @extends('layout.app')

    @section('title', 'Edit Mata Kuliah')

    @section('content')
        <div class="card-body p-4">
            <h3 class="title-page mb-4">Edit Mata Kuliah</h3>

            <form action="{{ route('mata-kuliah.update', $mataKuliah->kode_matkul) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
                    <input type="text" id="kode_matkul" name="kode_matkul" 
                        class="form-control bg-light" 
                        value="{{ $mataKuliah->kode_matkul }}" readonly>
                    <small class="text-muted">Kode tidak dapat diubah</small>
                </div>
                <div class="mb-3">
                    <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                    <input type="text" id="nama_matkul" name="nama_matkul" 
                        class="form-control @error('nama_matkul') is-invalid @enderror" 
                        value="{{ old('nama_matkul', $mataKuliah->nama_matkul) }}" required>
                    @error('nama_matkul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sks" class="form-label">SKS</label>
                            <input type="number" id="sks" name="sks" 
                                class="form-control @error('sks') is-invalid @enderror" 
                                value="{{ old('sks', $mataKuliah->sks) }}" required>
                            @error('sks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="number" id="semester" name="semester" 
                                class="form-control @error('semester') is-invalid @enderror" 
                                value="{{ old('semester', $mataKuliah->semester) }}" required>
                            @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <input type="text" id="prodi" name="prodi" 
                        class="form-control @error('prodi') is-invalid @enderror" 
                        value="{{ old('prodi', $mataKuliah->prodi) }}" required>
                    @error('prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis</label>
                            <select id="jenis" name="jenis" 
                                class="form-select @error('jenis') is-invalid @enderror">
                                <option value="wajib" {{ old('jenis', $mataKuliah->jenis) == 'wajib' ? 'selected' : '' }}>Wajib</option>
                                <option value="pilihan" {{ old('jenis', $mataKuliah->jenis) == 'pilihan' ? 'selected' : '' }}>Pilihan</option>
                            </select>
                            @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status_aktif" class="form-label">Status Aktif</label>
                            <select id="status_aktif" name="status_aktif" 
                                class="form-select @error('status_aktif') is-invalid @enderror">
                                <option value="1" {{ old('status_aktif', $mataKuliah->status_aktif) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status_aktif', $mataKuliah->status_aktif) == 0 ? 'selected' : '' }}>Nonaktif</option>
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
                    <a href="{{ route('mata-kuliah.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    @endsection