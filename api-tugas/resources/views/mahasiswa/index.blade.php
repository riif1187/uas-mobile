@extends('layout.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="header-section">
        <h3 class="title-page">Data Mahasiswa</h3>
        @can('mahasiswa.create')
        <a href="{{ route('create-mahasiswa') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
        @endcan
    </div>

    <div class="card-body">
        @if($mahasiswa->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 3%">No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Fakultas</th>
                            <th>Program Studi</th>
                            <th>Status Aktif</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge bg-info">{{ $item->NIM }}</span></td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->fakultas }}</td>
                                <td>{{ $item->prodi }}</td>
                                <td>
                                    @if($item->status_aktif == 'Aktif')
                                        <span class="badge bg-success">{{ $item->status_aktif }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $item->status_aktif ?? '-' }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('show-mahasiswa', $item->NIM) }}" class="btn btn-sm btn-info mb-1">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    @can('mahasiswa.update')
                                    <a href="{{ route('edit-mahasiswa', $item->NIM) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    @endcan
                                    @can('mahasiswa.delete')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->NIM }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                    @endcan

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteModal{{ $item->NIM }}" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data <strong>{{ $item->nama }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <a href="{{ route('hapus-mahasiswa', $item->NIM) }}" class="btn btn-dark btn-sm">
                                                        Ya, Hapus
                                                    </a>
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
                <i class="bi bi-info-circle"></i> Belum ada data mahasiswa.
                @can('mahasiswa.create')
                <a href="{{ route('create-mahasiswa') }}" class="alert-link">Tambah sekarang</a>
                @endcan
            </div>
        @endif
    </div>
@endsection