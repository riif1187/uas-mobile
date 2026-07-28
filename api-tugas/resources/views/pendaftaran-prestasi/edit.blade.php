@extends('layout.app')

@section('title', 'Edit Pendaftaran Prestasi')

@section('content')
    <div class="card-body p-4">
        <h3 class="title-page mb-4">Edit Pendaftaran Prestasi</h3>

        <form action="{{ route('pendaftaran-prestasi.update', $pendaftaran->pendaftaran_id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="NIM" class="form-label">Mahasiswa</label>
                        <select id="NIM" name="NIM" class="form-select @error('NIM') is-invalid @enderror" required>
                            @foreach($mahasiswa as $mhs)
                                <option value="{{ $mhs->NIM }}" {{ old('NIM', $pendaftaran->NIM) == $mhs->NIM ? 'selected' : '' }}>
                                    {{ $mhs->NIM }} - {{ $mhs->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('NIM') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="ref_id" class="form-label">Referensi Kejuaraan</label>
                        <select id="ref_id" name="ref_id" class="form-select @error('ref_id') is-invalid @enderror" required>
                            @foreach($referensi as $ref)
                                <option value="{{ $ref->ref_id }}" {{ old('ref_id', $pendaftaran->ref_id) == $ref->ref_id ? 'selected' : '' }}>
                                    {{ $ref->nama_kejuaraan }} ({{ $ref->bobot_poin }} poin)
                                </option>
                            @endforeach
                        </select>
                        @error('ref_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                    class="form-control @error('nama_kegiatan') is-invalid @enderror"
                    value="{{ old('nama_kegiatan', $pendaftaran->nama_kegiatan) }}" required>
                @error('nama_kegiatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update
                </button>
                <a href="{{ route('pendaftaran-prestasi.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection
