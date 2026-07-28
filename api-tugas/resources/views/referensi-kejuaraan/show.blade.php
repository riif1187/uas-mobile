@extends('layout.app')

@section('title', 'Detail Referensi Kejuaraan')

@section('content')
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="title-page mb-0">Detail Referensi Kejuaraan</h3>
            <div>
                <a href="{{ route('referensi-kejuaraan.edit', $referensi->ref_id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('referensi-kejuaraan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">ID Referensi</label>
                <p><span class="badge bg-info">{{ $referensi->ref_id }}</span></p>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Nama Kejuaraan</label>
                <p>{{ $referensi->nama_kejuaraan }}</p>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Bobot Poin</label>
                <p><span class="badge bg-success">{{ $referensi->bobot_poin }} poin</span></p>
            </div>
        </div>
    </div>
@endsection
