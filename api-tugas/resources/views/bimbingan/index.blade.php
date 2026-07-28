@extends('layout.app')

@section('title', 'Data Bimbingan')

@section('content')
    <div class="header-section">
        <h3 class="title-page">Data Bimbingan</h3>
        @can('bimbingan.create')
        <a href="{{ route('bimbingan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Bimbingan
        </a>
        @endcan
    </div>

    <div class="card-body">
        @if($bimbingan->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 3%">#</th>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Dosen Pembimbing</th>
                            <th>NIP</th>
                            <th>Tanggal Bimbingan</th>
                            <th style="width: 12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bimbingan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($item->mahasiswa)->nama ?? '-' }}</td>
                                <td><span class="badge bg-info">{{ $item->nim_mahasiswa }}</span></td>
                                <td>{{ optional($item->dosen)->nama ?? '-' }}</td>
                                <td><span class="badge bg-info">{{ $item->nip_dosen }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_bimbingan)->format('d/m/Y') }}</td>
                                <td>
                                    @can('bimbingan.update')
                                    <a href="{{ route('bimbingan.edit', $item->id) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    @endcan

                                    @can('bimbingan.delete')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>

                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data bimbingan
                                                    <strong>{{ optional($item->mahasiswa)->nama ?? $item->nim_mahasiswa }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('bimbingan.destroy', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-dark btn-sm">
                                                            Ya, Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                <i class="bi bi-info-circle"></i> Belum ada data bimbingan.
                @can('bimbingan.create')
                <a href="{{ route('bimbingan.create') }}" class="alert-link">Tambah sekarang</a>
                @endcan
            </div>
        @endif
    </div>
@endsection
