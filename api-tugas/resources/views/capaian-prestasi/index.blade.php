@extends('layout.app')

@section('title', 'Capaian Prestasi')

@section('content')
    <div class="header-section">
        <h3 class="title-page">Capaian Prestasi</h3>
        @can('capaian-prestasi.create')
        <a href="{{ route('capaian-prestasi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Capaian
        </a>
        @endcan
    </div>

    <div class="card-body">
        @if($capaian->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 3%">No</th>
                            <th>ID</th>
                            <th>Kegiatan</th>
                            <th>Mahasiswa</th>
                            <th>Peringkat</th>
                            <th>Dosen</th>
                            <th>Bukti</th>
                            <th style="width: 18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($capaian as $cap)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge bg-info">{{ $cap->capaian_id }}</span></td>
                                <td>{{ $cap->pendaftaranPrestasi->nama_kegiatan ?? '-' }}</td>
                                <td>{{ $cap->pendaftaranPrestasi->mahasiswa->nama ?? '-' }}</td>
                                <td><span class="badge bg-success">{{ $cap->peringkat }}</span></td>
                                <td>{{ $cap->dosen->nama ?? '-' }}</td>
                                <td>
                                    @if($cap->file_bukti)
                                        <a href="{{ route('capaian-prestasi.file', $cap->capaian_id) }}" target="_blank" class="btn btn-sm btn-secondary">
                                            <i class="bi bi-file-earmark-text"></i> File
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('capaian-prestasi.show', $cap->capaian_id) }}" class="btn btn-sm btn-info mb-1">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    @can('capaian-prestasi.update')
                                    <a href="{{ route('capaian-prestasi.edit', $cap->capaian_id) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    @endcan
                                    @can('capaian-prestasi.delete')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModalCapaian{{ $cap->capaian_id }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                    @endcan

                                    <div class="modal fade" id="deleteModalCapaian{{ $cap->capaian_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus capaian <strong>{{ $cap->peringkat }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('capaian-prestasi.destroy', $cap->capaian_id) }}" method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-dark btn-sm">
                                                            Ya, Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                <i class="bi bi-info-circle"></i> Belum ada data capaian prestasi.
                @can('capaian-prestasi.create')
                <a href="{{ route('capaian-prestasi.create') }}" class="alert-link">Tambah sekarang</a>
                @endcan
            </div>
        @endif
    </div>
@endsection
