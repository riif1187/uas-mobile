@extends('layout.app')

@section('title', 'Detail Capaian Prestasi')

@section('content')
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="title-page mb-0">Detail Capaian Prestasi</h3>
            <div>
                <a href="{{ route('capaian-prestasi.edit', $capaian->capaian_id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('capaian-prestasi.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">ID Capaian</label>
                <p><span class="badge bg-info">{{ $capaian->capaian_id }}</span></p>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Kegiatan</label>
                <p>{{ $capaian->pendaftaranPrestasi->nama_kegiatan ?? '-' }}</p>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Mahasiswa</label>
                <p>{{ $capaian->pendaftaranPrestasi->mahasiswa->nama ?? '-' }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">Peringkat</label>
                <p><span class="badge bg-success">{{ $capaian->peringkat }}</span></p>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Dosen Pembimbing</label>
                <p>{{ $capaian->dosen->nama ?? '-' }}</p>
                <small class="text-muted">{{ $capaian->NIP }}</small>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">File Bukti</label>
                <p>
                    @if($capaian->file_bukti)
                        <a href="{{ route('capaian-prestasi.file', $capaian->capaian_id) }}" target="_blank" class="btn btn-sm btn-secondary">
                            <i class="bi bi-file-earmark-text"></i> Lihat File
                        </a>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection
