@extends('layout.app')

@section('title', 'Detail Mahasiswa - ' . $mahasiswa->nama)

@section('content')
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="title-page mb-0">Detail Mahasiswa</h3>
            <div>
                <a href="{{ route('edit-mahasiswa', $mahasiswa->NIM) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('data-mahasiswa') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                {{-- Bagian Identitas --}}
                <div class="mb-4">
                    <h5 class="fw-bold text-muted mb-3"><i class="bi bi-person"></i> Data Identitas</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nama</label>
                            <p>{{ $mahasiswa->nama }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">NIM</label>
                            <p><span class="badge bg-info">{{ $mahasiswa->NIM }}</span></p>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <p>{{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Bagian Akademik --}}
                <div class="mb-4">
                    <h5 class="fw-bold text-muted mb-3"><i class="bi bi-book"></i> Data Akademik</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Fakultas</label>
                            <p>{{ $mahasiswa->fakultas }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Program Studi</label>
                            <p>{{ $mahasiswa->prodi }}</p>
                        </div>
                    </div>
                </div>

                {{-- Bagian Kelahiran --}}
                <div class="mb-4">
                    <h5 class="fw-bold text-muted mb-3"><i class="bi bi-calendar-event"></i> Data Kelahiran</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tempat Lahir</label>
                            <p>{{ $mahasiswa->tempat_lahir }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal Lahir</label>
                            <p>{{ \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Bagian Kontak --}}
                <div class="mb-4">
                    <h5 class="fw-bold text-muted mb-3"><i class="bi bi-telephone"></i> Data Kontak</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <p>{{ $mahasiswa->email ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">No. Telepon</label>
                            <p>{{ $mahasiswa->no_telepon }}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <p>{{ $mahasiswa->alamat }}</p>
                    </div>
                </div>

                {{-- Bagian Data Pribadi --}}
                <div class="mb-4">
                    <h5 class="fw-bold text-muted mb-3"><i class="bi bi-heart"></i> Data Pribadi</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Agama</label>
                            <p>{{ $mahasiswa->agama }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kewarganegaraan</label>
                            <p>{{ $mahasiswa->kewarganegaraan }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Golongan Darah</label>
                            <p>{{ $mahasiswa->golongan_darah ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status Pernikahan</label>
                            <p>{{ $mahasiswa->status_pernikahan }}</p>
                        </div>
                    </div>
                </div>

                {{-- Bagian Status --}}
                <div class="mb-4">
                    <h5 class="fw-bold text-muted mb-3"><i class="bi bi-check-circle"></i> Status Keaktifan</h5>
                    <div>
                        @if($mahasiswa->status_aktif == 'Aktif')
                            <span class="badge bg-success" style="font-size: 14px; padding: 8px 12px;">{{ $mahasiswa->status_aktif }}</span>
                        @else
                            <span class="badge bg-danger" style="font-size: 14px; padding: 8px 12px;">{{ $mahasiswa->status_aktif ?? '-' }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" style="border: 1px solid #ddd; border-radius: 8px;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-info-circle"></i> Ringkasan</h5>
                        <hr>
                        <div class="mb-3">
                            <small class="text-muted">NIM</small>
                            <p class="fw-bold">{{ $mahasiswa->NIM }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Nama Lengkap</small>
                            <p class="fw-bold">{{ $mahasiswa->nama }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Program Studi</small>
                            <p class="fw-bold">{{ $mahasiswa->prodi }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Kontak</small>
                            <p class="fw-bold">{{ $mahasiswa->no_telepon }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Status</small>
                            <p>
                                @if($mahasiswa->status_aktif == 'Aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </p>
                        </div>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="{{ route('edit-mahasiswa', $mahasiswa->NIM) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Edit Data
                            </a>
                            <a href="{{ route('data-mahasiswa') }}" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
