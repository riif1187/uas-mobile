@extends('layout.app')

@section('title', 'Klasifikasi Fuzzy')

@section('content')
<div class="header-section">
    <h3 class="title-page">Klasifikasi Fuzzy Mahasiswa</h3>
    <form action="{{ route('fuzzy-klasifikasi.refresh') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-arrow-clockwise"></i> Refresh Klasifikasi
        </button>
    </form>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th class="text-center">Jml Prestasi</th>
                <th class="text-center">Total Poin</th>
                <th class="text-center">Peringkat Terbaik</th>
                <th class="text-center">Skor</th>
                <th>Klasifikasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($klasifikasi as $i => $k)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><span class="badge bg-info">{{ $k->NIM }}</span></td>
                    <td>{{ $k->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $k->mahasiswa->prodi ?? '-' }}</td>
                    <td class="text-center">{{ $k->jumlah_prestasi }}</td>
                    <td class="text-center">{{ $k->total_poin }}</td>
                    <td class="text-center">{{ $k->peringkat_terbaik ?: '-' }}</td>
                    <td class="text-center fw-bold">{{ $k->skor_fuzzy }}</td>
                    <td>
                        @php
                            $color = match(true) {
                                $k->skor_fuzzy < 26 => 'danger',
                                $k->skor_fuzzy < 51 => 'warning',
                                $k->skor_fuzzy < 76 => 'success',
                                default => 'primary',
                            };
                        @endphp
                        <span class="badge bg-{{ $color }}">{{ $k->label_fuzzy }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">
                        <i class="bi bi-info-circle"></i> Belum ada data. 
                        <a href="{{ route('fuzzy-klasifikasi.refresh') }}" 
                           onclick="event.preventDefault(); document.getElementById('refresh-form').submit();">
                           Klik refresh
                        </a>
                        <form id="refresh-form" action="{{ route('fuzzy-klasifikasi.refresh') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
