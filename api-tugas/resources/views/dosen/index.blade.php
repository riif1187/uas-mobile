@extends('layout.app')

@section('title', 'Data Dosen')

@section('content')
    <div class="header-section">
        <h3 class="title-page">Data Dosen</h3>
        @can('dosen.create')
        <a href="{{ route('dosen.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Dosen
        </a>
        @endcan
    </div>


        @if($dosen->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 3%">No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Fakultas</th>
                            <th>Prodi</th>
                            <th>Jabatan Akademik</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Status</th>
                            <th style="width: 12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dosen as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge bg-info">{{ $d->NIP }}</span></td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->fakultas }}</td>
                                <td>{{ $d->prodi }}</td>
                                <td>{{ $d->jabatan_akademik }}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->no_telepon }}</td>
                                <td>
                                    @if($d->status_aktif)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    @can('dosen.update')
                                    <a href="{{ route('dosen.edit', $d->NIP) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    @endcan
                                    @can('dosen.delete')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $d->NIP }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                    @endcan

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteModal{{ $d->NIP }}" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data dosen <strong>{{ $d->nama }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('dosen.destroy', $d->NIP) }}" method="POST" class="d-inline">
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
                <i class="bi bi-info-circle"></i> Belum ada data dosen.
                @can('dosen.create')
                <a href="{{ route('dosen.create') }}" class="alert-link">Tambah sekarang</a>
                @endcan
            </div>
        @endif
    </div>
@endsection