@extends('layout.app')

@section('title', 'Data Mata Kuliah')

@section('content')
    <div class="header-section">
        <h3 class="title-page">Data Mata Kuliah</h3>
        @can('mata-kuliah.create')
        <a href="{{ route('mata-kuliah.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
        </a>
        @endcan
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($mataKuliah->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 3%">#</th>
                            <th>Kode</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Semester</th>
                            <th>Prodi</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th style="width: 12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mataKuliah as $mk)
                            @php $modalId = 'deleteModal' . str_replace(['.', '-', ' '], '_', $mk->kode_matkul); @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge bg-info">{{ $mk->kode_matkul }}</span></td>
                                <td>{{ $mk->nama_matkul }}</td>
                                <td>{{ $mk->sks }}</td>
                                <td>{{ $mk->semester }}</td>
                                <td>{{ $mk->prodi }}</td>
                                <td>{{ ucfirst($mk->jenis) }}</td>
                                <td>
                                    @if($mk->status_aktif)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    @can('mata-kuliah.update')
                                    <a href="{{ route('mata-kuliah.edit', $mk->kode_matkul) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    @endcan
                                    @can('mata-kuliah.delete')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                    @endcan

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="{{ $modalId }}" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus mata kuliah <strong>{{ $mk->nama_matkul }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('mata-kuliah.destroy', $mk->kode_matkul) }}" method="POST" class="d-inline">
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
                <i class="bi bi-info-circle"></i> Belum ada data mata kuliah.
                @can('mata-kuliah.create')
                <a href="{{ route('mata-kuliah.create') }}" class="alert-link">Tambah sekarang</a>
                @endcan
            </div>
        @endif
    </div>
@endsection