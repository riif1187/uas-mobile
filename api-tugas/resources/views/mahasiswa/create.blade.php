@extends('layout.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="card-body p-4">
        <h3 class="title-page mb-4">Tambah Mahasiswa</h3>

        <form action="{{ route('store-mahasiswa') }}" method="post">
            @csrf

            {{-- 1. Identitas --}}
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" id="nama" name="nama"
                    class="form-control @error('nama') is-invalid @enderror"
                    placeholder="Nama mahasiswa" value="{{ old('nama') }}">
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="NIM" class="form-label">NIM</label>
                <input type="text" id="NIM" name="NIM" maxlength="15"
                    class="form-control @error('NIM') is-invalid @enderror"
                    placeholder="NIM mahasiswa" value="{{ old('NIM') }}">
                @error('NIM') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- 2. Akademik --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <input type="text" id="fakultas" name="fakultas"
                            class="form-control @error('fakultas') is-invalid @enderror"
                            placeholder="Fakultas mahasiswa" value="{{ old('fakultas') }}">
                        @error('fakultas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <input type="text" id="prodi" name="prodi"
                            class="form-control @error('prodi') is-invalid @enderror"
                            placeholder="Program studi" value="{{ old('prodi') }}">
                        @error('prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- 3. Kelahiran & Gender --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir"
                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                            placeholder="Tempat lahir" value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin"
                    class="form-select @error('jenis_kelamin') is-invalid @enderror">
                    <option value="">Pilih jenis kelamin</option>
                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- 4. Data Kontak --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-muted fw-normal">(opsional)</span></label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email mahasiswa" value="{{ old('email') }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No. Telepon</label>
                        <input type="text" id="no_telepon" name="no_telepon"
                            class="form-control @error('no_telepon') is-invalid @enderror"
                            placeholder="No telepon mahasiswa" value="{{ old('no_telepon') }}">
                        @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3"
                    class="form-control @error('alamat') is-invalid @enderror"
                    placeholder="Alamat mahasiswa">{{ old('alamat') }}</textarea>
                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- 5. Biodata Pribadi --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <select id="agama" name="agama"
                            class="form-select @error('agama') is-invalid @enderror">
                            <option value="">Pilih agama</option>
                            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                                <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                            @endforeach
                        </select>
                        @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                        <input type="text" id="kewarganegaraan" name="kewarganegaraan"
                            class="form-control @error('kewarganegaraan') is-invalid @enderror"
                            placeholder="Kewarganegaraan" value="{{ old('kewarganegaraan', 'WNI') }}">
                        @error('kewarganegaraan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="golongan_darah" class="form-label">Golongan Darah <span class="text-muted fw-normal">(opsional)</span></label>
                        <select id="golongan_darah" name="golongan_darah"
                            class="form-select @error('golongan_darah') is-invalid @enderror">
                            <option value="">Pilih golongan darah</option>
                            @foreach(['A','B','AB','O','A+','A-','B+','B-','AB+','AB-','O+','O-'] as $gol)
                                <option value="{{ $gol }}" {{ old('golongan_darah') == $gol ? 'selected' : '' }}>{{ $gol }}</option>
                            @endforeach
                        </select>
                        @error('golongan_darah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                        <select id="status_pernikahan" name="status_pernikahan"
                            class="form-select @error('status_pernikahan') is-invalid @enderror">
                            <option value="">Pilih status pernikahan</option>
                            @foreach(['Belum Menikah','Menikah','Cerai'] as $status)
                                <option value="{{ $status }}" {{ old('status_pernikahan') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                        @error('status_pernikahan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- 6. Status Keaktifan --}}
            <div class="mb-4">
                <label for="status_aktif" class="form-label">Status Aktif</label>
                <select id="status_aktif" name="status_aktif"
                    class="form-select @error('status_aktif') is-invalid @enderror">
                    <option value="">Pilih status aktif</option>
                    <option value="Aktif" {{ old('status_aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ old('status_aktif') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('status_aktif') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Simpan
                </button>
                <a href="{{ route('data-mahasiswa') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>

        </form>
    </div>
@endsection