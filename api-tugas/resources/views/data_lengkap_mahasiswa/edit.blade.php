@extends('layout.app')

@section('title', 'Edit Data Lengkap Mahasiswa')

@section('content')
    <div class="card-body p-4">
        <h3 class="title-page mb-4">Edit Data Lengkap Mahasiswa</h3>

        <form action="{{ route('data-lengkap-mahasiswa.update', $dataLengkapMahasiswa->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nim_mahasiswa" class="form-label">Mahasiswa</label>
                        <select id="nim_mahasiswa" name="nim_mahasiswa"
                            class="form-select @error('nim_mahasiswa') is-invalid @enderror" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach($dataMahasiswa as $mahasiswa)
                                <option value="{{ $mahasiswa->NIM }}" {{ old('nim_mahasiswa', $dataLengkapMahasiswa->nim_mahasiswa) == $mahasiswa->NIM ? 'selected' : '' }}>
                                    {{ $mahasiswa->NIM }} - {{ $mahasiswa->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('nim_mahasiswa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="matkul" class="form-label">Mata Kuliah</label>
                        <select id="matkul" name="matkul"
                            class="form-select @error('matkul') is-invalid @enderror" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach($dataMataKuliah as $mataKuliah)
                                <option value="{{ $mataKuliah->kode_matkul }}" {{ old('matkul', $dataLengkapMahasiswa->matkul) == $mataKuliah->kode_matkul ? 'selected' : '' }}>
                                    {{ $mataKuliah->kode_matkul }} - {{ $mataKuliah->nama_matkul }}
                                </option>
                            @endforeach
                        </select>
                        @error('matkul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="tahun_akademik_id" class="form-label">Tahun Akademik</label>
                <select id="tahun_akademik_id" name="tahun_akademik_id"
                    class="form-select @error('tahun_akademik_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Tahun Akademik --</option>
                    @foreach($dataTahunAkademik as $tahunAkademik)
                        <option value="{{ $tahunAkademik->id }}" {{ old('tahun_akademik_id', $dataLengkapMahasiswa->tahun_akademik_id) == $tahunAkademik->id ? 'selected' : '' }}>
                            {{ $tahunAkademik->tahun_akademik }} - {{ $tahunAkademik->semester }}
                        </option>
                    @endforeach
                </select>
                @error('tahun_akademik_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update
                </button>
                <a href="{{ route('data-lengkap-mahasiswa.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection
