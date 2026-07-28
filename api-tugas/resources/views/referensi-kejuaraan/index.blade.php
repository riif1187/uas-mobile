@extends('layout.app')

@section('title', 'Referensi Kejuaraan')

@section('content')
    <div class="header-section">
        <h3 class="title-page">Referensi Kejuaraan</h3>
        @can('referensi-kejuaraan.create')
        <a href="{{ route('referensi-kejuaraan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Referensi
        </a>
        @endcan
    </div>

    <div class="card-body">
        @if($referensi->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 3%">No</th>
                            <th>ID</th>
                            <th>Nama Kejuaraan</th>
                            <th>Bobot Poin</th>
                            <th style="width: 18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($referensi as $ref)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge bg-info">{{ $ref->ref_id }}</span></td>
                                <td>{{ $ref->nama_kejuaraan }}</td>
                                <td><span class="badge bg-success">{{ $ref->bobot_poin }} poin</span></td>
                                <td>
                                    <a href="{{ route('referensi-kejuaraan.show', $ref->ref_id) }}" class="btn btn-sm btn-info mb-1">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    @can('referensi-kejuaraan.update')
                                    <a href="{{ route('referensi-kejuaraan.edit', $ref->ref_id) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    @endcan

                                    @can('referensi-kejuaraan.delete')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModalReferensi{{ $ref->ref_id }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>

                                    <div class="modal fade" id="deleteModalReferensi{{ $ref->ref_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus referensi <strong>{{ $ref->nama_kejuaraan }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('referensi-kejuaraan.destroy', $ref->ref_id) }}" method="POST" class="d-inline">
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
                <i class="bi bi-info-circle"></i> Belum ada data referensi kejuaraan.
                @can('referensi-kejuaraan.create')
                <a href="{{ route('referensi-kejuaraan.create') }}" class="alert-link">Tambah sekarang</a>
                @endcan
            </div>
        @endif
    </div>
@endsection
