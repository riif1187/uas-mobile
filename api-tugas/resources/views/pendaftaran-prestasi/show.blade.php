@extends('layout.app')

@section('title', 'Detail Pendaftaran Prestasi')

@section('content')
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="title-page mb-0">Detail Pendaftaran Prestasi</h3>
            <div>
                <a href="{{ route('pendaftaran-prestasi.edit', $pendaftaran->pendaftaran_id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('pendaftaran-prestasi.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">ID Pendaftaran</label>
                <p><span class="badge bg-info">{{ $pendaftaran->pendaftaran_id }}</span></p>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Mahasiswa</label>
                <p>{{ $pendaftaran->mahasiswa->nama ?? '-' }}</p>
                <small class="text-muted">{{ $pendaftaran->NIM }}</small>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Kejuaraan</label>
                <p>{{ $pendaftaran->referensiKejuaraan->nama_kejuaraan ?? '-' }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">Bobot Poin</label>
                <p>
                    @if($pendaftaran->referensiKejuaraan)
                        <span class="badge bg-success">{{ $pendaftaran->referensiKejuaraan->bobot_poin }} poin</span>
                    @else
                        -
                    @endif
                </p>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Nama Kegiatan</label>
                <p>{{ $pendaftaran->nama_kegiatan }}</p>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Status Verifikasi</label>
                <p>
                    @if($pendaftaran->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($pendaftaran->status == 'disetujui')
                        <span class="badge bg-success">Disetujui</span>
                    @else
                        <span class="badge bg-danger">Ditolak</span>
                    @endif
                </p>

                @can('pendaftaran-prestasi.verify')
                    <div class="mt-2">
                        @if($pendaftaran->status == 'pending')
                            <form action="{{ route('pendaftaran-prestasi.verify', $pendaftaran->pendaftaran_id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="disetujui">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="bi bi-check-circle"></i> Setujui
                                </button>
                            </form>
                            <form action="{{ route('pendaftaran-prestasi.verify', $pendaftaran->pendaftaran_id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="tidak_disetujui">
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-x-circle"></i> Tolak
                                </button>
                            </form>
                        @elseif($pendaftaran->status == 'disetujui')
                            <form action="{{ route('pendaftaran-prestasi.verify', $pendaftaran->pendaftaran_id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="tidak_disetujui">
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-x-circle"></i> Ubah Jadi Tolak
                                </button>
                            </form>
                        @else
                            <form action="{{ route('pendaftaran-prestasi.verify', $pendaftaran->pendaftaran_id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="disetujui">
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-check-circle"></i> Ubah Jadi Setujui
                                </button>
                            </form>
                        @endif
                    </div>
                @endcan
            </div>
        </div>
    </div>
@endsection
