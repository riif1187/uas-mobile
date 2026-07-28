@extends('layout.app')

@section('title', 'Edit Tahun Akademik')

@section('content')
    <div class="card-body p-4">
        <h3 class="title-page mb-4">Edit Tahun Akademik</h3>

        <form action="{{ route('tahun-akademik.update', $tahunAkademik->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                        <input type="text" id="tahun_akademik" name="tahun_akademik" 
                            class="form-control @error('tahun_akademik') is-invalid @enderror"
                            value="{{ old('tahun_akademik', $tahunAkademik->tahun_akademik) }}" required>
                        @error('tahun_akademik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <select id="semester" name="semester" 
                            class="form-select @error('semester') is-invalid @enderror" required>
                            <option value="Ganjil" {{ old('semester', $tahunAkademik->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ old('semester', $tahunAkademik->semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                        @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" 
                            class="form-select @error('status') is-invalid @enderror" required>
                            <option value="aktif" {{ old('status', $tahunAkademik->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $tahunAkademik->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" 
                            class="form-control @error('tanggal_mulai') is-invalid @enderror"
                            value="{{ old('tanggal_mulai', $tahunAkademik->tanggal_mulai) }}" required>
                        @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" 
                            class="form-control @error('tanggal_selesai') is-invalid @enderror"
                            value="{{ old('tanggal_selesai', $tahunAkademik->tanggal_selesai) }}" required>
                        @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update
                </button>
                <a href="{{ route('tahun-akademik.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection