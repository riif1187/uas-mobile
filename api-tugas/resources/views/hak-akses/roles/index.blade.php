@extends('layout.app')

@section('title', 'Manajemen Role')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3 p-3 border-bottom">
        <h4 class="mb-0 fw-bold text-primary">
            <i class="bi bi-shield-lock-fill me-2"></i>Manajemen Hak Akses
        </h4>
        @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('administrator'))
        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Role Baru
        </a>
        @endif
    </div>

    <div class="card border-0 shadow-none">
        <div class="card-body p-0">
            @if($roles->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4" style="width:5%">#</th>
                                <th style="width:20%">Role / Jabatan</th>
                                <th style="width:15%">Level Akses</th>
                                <th>Cakupan Izin CRUD (Modul)</th>
                                <th class="text-center" style="width:15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                @php
                                    $tingkatan = match(true) {
                                        $role->level_akses >= 9 => ['label' => 'Administrator', 'class' => 'bg-danger'],
                                        $role->level_akses >= 5 => ['label' => 'Staff / Dosen',  'class' => 'bg-warning text-dark'],
                                        default                 => ['label' => 'User / Mahasiswa', 'class' => 'bg-info text-dark'],
                                    };
                                    
                                    // Group permissions by module for the summary
                                    $moduleSummary = $role->permissions->groupBy('modul')->map(function($perms) {
                                        return count($perms);
                                    });
                                @endphp
                                <tr>
                                    <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $role->nama_role }}</div>
                                        <small class="text-muted text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">{{ $role->slug }}</small>
                                    </td>
                                    <td>
                                        <span class="badge {{ $tingkatan['class'] }} px-2 py-1" style="font-size: 11px;">
                                            {{ $tingkatan['label'] }} ({{ $role->level_akses }})
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            @if($moduleSummary->isEmpty())
                                                <span class="text-muted small italic">Tidak ada akses spesifik</span>
                                            @else
                                                @foreach($moduleSummary as $modul => $count)
                                                    <span class="badge border text-dark bg-light fw-normal" style="font-size: 10px;">
                                                        <i class="bi bi-check2-circle text-success me-1"></i>{{ str_replace('-', ' ', $modul) }} ({{ $count }})
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('administrator'))
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-outline-warning border-0" title="Atur Izin">
                                                <i class="bi bi-gear-fill"></i> Atur Izin
                                            </a>
                                            
                                            {{-- Don't allow deleting core admin roles via UI easily --}}
                                            @if(!in_array($role->slug, ['superadmin', 'administrator', 'admin']))
                                            <button type="button" class="btn btn-sm btn-outline-danger border-0"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $role->id }}" title="Hapus Role">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            @endif
                                        @else
                                            <span class="badge bg-light text-muted fw-normal">Read Only</span>
                                        @endif

                                        {{-- Modal Hapus --}}
                                        @if(!in_array($role->slug, ['superadmin', 'administrator', 'admin']))
                                        <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-body p-4 text-center">
                                                        <i class="bi bi-exclamation-triangle text-danger fs-1 mb-3"></i>
                                                        <h5 class="fw-bold">Hapus Role?</h5>
                                                        <p class="text-muted small">Role <strong>{{ $role->nama_role }}</strong> akan dihapus permanen. Pengguna dengan role ini akan kehilangan akses.</p>
                                                        <div class="d-flex justify-content-center gap-2 mt-4">
                                                            <button class="btn btn-light btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm px-3">Ya, Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-5 text-center text-muted">
                    <i class="bi bi-shield-slash fs-1 d-block mb-3 opacity-25"></i>
                    <p>Belum ada role yang terdaftar.</p>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">Tambah Role Sekarang</a>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection