@extends('layout.app')

@section('title', 'Manajemen User')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3 p-3 border-bottom">
        <h4 class="mb-0 fw-bold text-primary">
            <i class="bi bi-people-fill me-2"></i>Manajemen User & Role
        </h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-none">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" style="width:5%">#</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Role Saat Ini</th>
                            <th class="text-center" style="width:20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->roles->count() > 0)
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-primary px-2 py-1">
                                            {{ $role->nama_role }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="badge bg-secondary px-2 py-1">Belum ada role</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                    data-bs-toggle="modal" data-bs-target="#updateRoleModal{{ $user->id }}">
                                    <i class="bi bi-shield-check me-1"></i> Ubah Role
                                </button>

                                <!-- Modal Update Role -->
                                <div class="modal fade text-start" id="updateRoleModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Atur Role: {{ $user->name }}</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('users.update-role', $user->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body p-4">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Pilih Role Baru</label>
                                                        <select name="role_id" class="form-select" required>
                                                            <option value="" disabled>-- Pilih Role --</option>
                                                            @foreach($roles as $role)
                                                                <option value="{{ $role->id }}" 
                                                                    {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                                                    {{ $role->nama_role }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="form-text mt-2 small text-muted">
                                                            Pilih role yang akan diberikan kepada user ini untuk mengatur hak aksesnya.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light border-0">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-sm px-4">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
