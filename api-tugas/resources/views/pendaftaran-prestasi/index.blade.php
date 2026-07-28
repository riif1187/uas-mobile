@extends('layout.app')

@section('title', 'Pendaftaran Prestasi')

@section('content')
    <div class="header-section">
        <h3 class="title-page">Pendaftaran Prestasi</h3>
        @can('pendaftaran-prestasi.create')
        <a href="{{ route('pendaftaran-prestasi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Pendaftaran
        </a>
        @endcan
    </div>

    <div class="card-body">
        @if($pendaftaran->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 3%">No</th>
                            <th>ID</th>
                            <th>Mahasiswa</th>
                            <th>Kejuaraan</th>
                            <th>Nama Kegiatan</th>
                            <th>Status</th>
                            <th style="width: 18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftaran as $daftar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge bg-info">{{ $daftar->pendaftaran_id }}</span></td>
                                <td>
                                    {{ $daftar->mahasiswa->nama ?? '-' }}
                                    <br>
                                    <small class="text-muted">{{ $daftar->NIM }}</small>
                                </td>
                                <td>
                                    {{ $daftar->referensiKejuaraan->nama_kejuaraan ?? '-' }}
                                    @if($daftar->referensiKejuaraan)
                                        <br>
                                        <span class="badge bg-success">{{ $daftar->referensiKejuaraan->bobot_poin }} poin</span>
                                    @endif
                                </td>
                                <td>{{ $daftar->nama_kegiatan }}</td>
                                <td>
                                    @if($daftar->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($daftar->status == 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group mb-1">
                                        <a href="{{ route('pendaftaran-prestasi.show', $daftar->pendaftaran_id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </div>
                                    <br>
                                    @can('pendaftaran-prestasi.update')
                                    <a href="{{ route('pendaftaran-prestasi.edit', $daftar->pendaftaran_id) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    @endcan

                                    @can('pendaftaran-prestasi.delete')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModalPendaftaran{{ $daftar->pendaftaran_id }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>

                                    <div class="modal fade" id="deleteModalPendaftaran{{ $daftar->pendaftaran_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus pendaftaran <strong>{{ $daftar->nama_kegiatan }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('pendaftaran-prestasi.destroy', $daftar->pendaftaran_id) }}" method="POST" class="d-inline">
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
                <i class="bi bi-info-circle"></i> Belum ada data pendaftaran prestasi.
                @can('pendaftaran-prestasi.create')
                <a href="{{ route('pendaftaran-prestasi.create') }}" class="alert-link">Tambah sekarang</a>
                @endcan
            </div>
        @endif
    </div>
@endsection
