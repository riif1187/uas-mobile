@extends('layout.app')

@section('title', 'Edit Bimbingan')

@section('content')
    <div class="card-body p-4">
        <h3 class="title-page mb-4">Edit Data Bimbingan</h3>

        <form action="{{ route('bimbingan.update', $bimbingan->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nim_mahasiswa" class="form-label">Mahasiswa</label>
                        <select id="nim_mahasiswa" name="nim_mahasiswa"
                            class="form-select @error('nim_mahasiswa') is-invalid @enderror" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach($dataMahasiswa as $mahasiswa)
                                <option value="{{ $mahasiswa->NIM }}" {{ old('nim_mahasiswa', $bimbingan->nim_mahasiswa) == $mahasiswa->NIM ? 'selected' : '' }}>
                                    {{ $mahasiswa->NIM }} - {{ $mahasiswa->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('nim_mahasiswa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nip_dosen" class="form-label">Dosen Pembimbing</label>
                        <select id="nip_dosen" name="nip_dosen"
                            class="form-select @error('nip_dosen') is-invalid @enderror" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dataDosen as $dosen)
                                <option value="{{ $dosen->NIP }}" {{ old('nip_dosen', $bimbingan->nip_dosen) == $dosen->NIP ? 'selected' : '' }}>
                                    {{ $dosen->NIP }} - {{ $dosen->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('nip_dosen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="tanggal_bimbingan" class="form-label">Tanggal Bimbingan</label>
                <input type="date" id="tanggal_bimbingan" name="tanggal_bimbingan"
                    class="form-control @error('tanggal_bimbingan') is-invalid @enderror"
                    value="{{ old('tanggal_bimbingan', $bimbingan->tanggal_bimbingan) }}" required>
                @error('tanggal_bimbingan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update
                </button>
                <a href="{{ route('bimbingan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection
