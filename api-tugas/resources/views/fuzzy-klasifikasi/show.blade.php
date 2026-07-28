@extends('layout.app')

@section('title', 'Detail Klasifikasi')

@section('content')
<div class="header-section">
    <h3 class="title-page">Detail Klasifikasi Fuzzy</h3>
    <a href="{{ route('fuzzy-klasifikasi.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th style="width:200px;">NIM</th>
                <td><span class="badge bg-info">{{ $data->NIM }}</span></td>
            </tr>
            <tr>
                <th>Nama Mahasiswa</th>
                <td>{{ $data->mahasiswa->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Fakultas</th>
                <td>{{ $data->mahasiswa->fakultas ?? '-' }}</td>
            </tr>
            <tr>
                <th>Prodi</th>
                <td>{{ $data->mahasiswa->prodi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jumlah Prestasi</th>
                <td>{{ $data->jumlah_prestasi }}</td>
            </tr>
            <tr>
                <th>Total Poin</th>
                <td>{{ $data->total_poin }}</td>
            </tr>
            <tr>
                <th>Peringkat Terbaik</th>
                <td>{{ $data->peringkat_terbaik ?: '-' }}</td>
            </tr>
            <tr>
                <th>Skor Fuzzy</th>
                <td class="fw-bold">{{ $data->skor_fuzzy }}</td>
            </tr>
            <tr>
                <th>Klasifikasi</th>
                <td>
                    @php
                        $color = match(true) {
                            $data->skor_fuzzy < 26 => 'danger',
                            $data->skor_fuzzy < 51 => 'warning',
                            $data->skor_fuzzy < 76 => 'success',
                            default => 'primary',
                        };
                    @endphp
                    <span class="badge bg-{{ $color }} fs-6">{{ $data->label_fuzzy }}</span>
                </td>
            </tr>
        </table>
        </div>
    </div>
</div>
@endsection
