@extends('layout.app')

@section('title', 'Edit Role')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Role</h4>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">
            &larr; Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header text-white d-flex align-items-center gap-2"
             style="background: linear-gradient(135deg, #4a6cf7, #6a3de8);">
            <i class="bi bi-pencil-square"></i>
            <strong>Form Edit Role</strong>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Pilih Role Bertingkat --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-person-badge text-muted me-1"></i> Nama Role
                    </label>
                    <select name="nama_role" class="form-select @error('nama_role') is-invalid @enderror">
                        <option value="">-- Pilih Role --</option>
                        <optgroup label="Tingkat Dasar">
                            <option value="mahasiswa"     {{ old('nama_role', $role->nama_role) == 'mahasiswa'     ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="member"        {{ old('nama_role', $role->nama_role) == 'member'        ? 'selected' : '' }}>Member</option>
                        </optgroup>
                        <optgroup label="Tingkat Menengah">
                            <option value="operator"      {{ old('nama_role', $role->nama_role) == 'operator'      ? 'selected' : '' }}>Operator</option>
                            <option value="editor"        {{ old('nama_role', $role->nama_role) == 'editor'        ? 'selected' : '' }}>Editor</option>
                            <option value="dosen"         {{ old('nama_role', $role->nama_role) == 'dosen'         ? 'selected' : '' }}>Dosen</option>
                            <option value="kaprodi"       {{ old('nama_role', $role->nama_role) == 'kaprodi'       ? 'selected' : '' }}>Kepala Program Studi</option>
                        </optgroup>
                        <optgroup label="Tingkat Tinggi">
                            <option value="supervisor"    {{ old('nama_role', $role->nama_role) == 'supervisor'    ? 'selected' : '' }}>Supervisor</option>
                            <option value="administrator" {{ old('nama_role', $role->nama_role) == 'administrator' ? 'selected' : '' }}>Administrator</option>
                            <option value="superadmin"    {{ old('nama_role', $role->nama_role) == 'superadmin'    ? 'selected' : '' }}>Super Admin</option>
                        </optgroup>
                    </select>
                    @error('nama_role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active"
                            id="is_active" {{ $role->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Role aktif</label>
                    </div>
                </div>

                {{-- Permissions --}}
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-bold mb-0">Permission yang dimiliki role ini</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAllGlobal"
                                {{ count($selectedPermissions) == $permissions->count() ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold small" for="selectAllGlobal">Pilih Semua</label>
                        </div>
                    </div>

                    @php $grouped = $permissions->groupBy('modul'); @endphp
                    @foreach($grouped as $modul => $items)
                        @php
                            $groupSelected = $items->pluck('id')->every(fn($id) => in_array($id, $selectedPermissions));
                        @endphp
                        <div class="mb-3 p-3 permission-group" style="background:#f8f9fa;border-radius:6px;border-left:3px solid #4a6cf7;">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                <strong class="text-uppercase" style="font-size:11px;color:#4a6cf7;">
                                    <i class="bi bi-grid-fill me-1"></i> {{ str_replace('-', ' ', $modul) }}
                                </strong>
                                <div class="form-check">
                                    <input class="form-check-input select-all-modul" type="checkbox" id="select_{{ $modul }}"
                                        {{ $groupSelected ? 'checked' : '' }}>
                                    <label class="form-check-label text-muted small" for="select_{{ $modul }}" style="font-size: 10px;">Pilih Modul</label>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($items as $permission)
                                    <div class="col-md-3 col-sm-4 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input perm-checkbox" type="checkbox"
                                                name="permissions[]"
                                                value="{{ $permission->id }}"
                                                id="perm_{{ $permission->id }}"
                                                {{ in_array($permission->id, $selectedPermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label small text-capitalize" for="perm_{{ $permission->id }}">
                                                {{ $permission->aksi }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pilih User --}}
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-bold mb-0">Berikan Role ini kepada User (Email)</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAllUsers" 
                                {{ count($selectedUsers) == $users->count() ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold small" for="selectAllUsers">Pilih Semua User</label>
                        </div>
                    </div>
                    
                    <div class="p-3 border rounded bg-light" style="max-height: 200px; overflow-y: auto;">
                        <div class="row">
                            @foreach($users as $user)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input user-checkbox" type="checkbox" 
                                            name="users[]" value="{{ $user->id }}" id="user_{{ $user->id }}"
                                            {{ in_array($user->id, $selectedUsers) ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="user_{{ $user->id }}">
                                            {{ $user->email }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <small class="text-muted">User yang dipilih akan memiliki role ini. User yang tidak dicentang akan kehilangan role ini.</small>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <a href="{{ route('roles.index') }}" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const globalCheckbox = document.getElementById('selectAllGlobal');
        const moduleCheckboxes = document.querySelectorAll('.select-all-modul');
        const allPermCheckboxes = document.querySelectorAll('.perm-checkbox');

        // Global Select All
        globalCheckbox.addEventListener('change', function() {
            allPermCheckboxes.forEach(cb => cb.checked = this.checked);
            moduleCheckboxes.forEach(cb => cb.checked = this.checked);
        });

        // Module Select All
        moduleCheckboxes.forEach(modCheckbox => {
            modCheckbox.addEventListener('change', function() {
                const group = this.closest('.permission-group');
                const checkboxes = group.querySelectorAll('.perm-checkbox');
                checkboxes.forEach(cb => cb.checked = this.checked);
                updateGlobalCheckbox();
            });
        });

        // Individual Checkbox Change
        allPermCheckboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const group = this.closest('.permission-group');
                const modCheckbox = group.querySelector('.select-all-modul');
                const groupCheckboxes = group.querySelectorAll('.perm-checkbox');
                const allChecked = Array.from(groupCheckboxes).every(c => c.checked);
                
                modCheckbox.checked = allChecked;
                updateGlobalCheckbox();
            });
        });

        function updateGlobalCheckbox() {
            const anyUnchecked = Array.from(allPermCheckboxes).some(c => !c.checked);
            globalCheckbox.checked = !anyUnchecked;
        }

        // Select All Users
        const selectAllUsers = document.getElementById('selectAllUsers');
        const userCheckboxes = document.querySelectorAll('.user-checkbox');
        if (selectAllUsers) {
            selectAllUsers.addEventListener('change', function() {
                userCheckboxes.forEach(cb => cb.checked = this.checked);
            });
        }
    });
</script>
@endpush
@endsection
