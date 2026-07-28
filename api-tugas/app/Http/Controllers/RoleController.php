<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('hak-akses.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('modul')->get();
        $users = User::orderBy('email')->get();
        return view('hak-akses.roles.create', compact('permissions', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role'   => 'required|string|max:100|unique:roles,nama_role',
            'permissions' => 'nullable|array',
            'users'       => 'nullable|array',
        ]);

        $role = Role::create([
            'nama_role'   => $request->nama_role,
            'slug'        => Str::slug($request->nama_role),
            'deskripsi'   => null,
            'level_akses' => $this->getLevelAkses($request->nama_role),
            'is_active'   => true,
        ]);

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        if ($request->has('users')) {
            $role->users()->sync($request->users);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $role = Role::with(['permissions', 'users'])->findOrFail($id);
        $permissions = Permission::orderBy('modul')->get();
        $users = User::orderBy('email')->get();
        $selectedPermissions = $role->permissions->pluck('id')->toArray();
        $selectedUsers = $role->users->pluck('id')->toArray();
        return view('hak-akses.roles.edit', compact('role', 'permissions', 'users', 'selectedPermissions', 'selectedUsers'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'nama_role'   => 'required|string|max:100|unique:roles,nama_role,' . $role->id,
            'permissions' => 'nullable|array',
            'users'       => 'nullable|array',
        ]);

        $role->update([
            'nama_role'   => $request->nama_role,
            'level_akses' => $this->getLevelAkses($request->nama_role),
            'is_active'   => $request->has('is_active'),
        ]);

        $role->permissions()->sync($request->permissions ?? []);
        $role->users()->sync($request->users ?? []);

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil dihapus.');
    }

    // ✅ Helper: auto-assign level berdasarkan nama role
    private function getLevelAkses(string $namaRole): int
    {
        return match($namaRole) {
            'mahasiswa', 'member'        => 1,
            'operator', 'editor'         => 3,
            'dosen', 'kaprodi'           => 5,
            'supervisor'                 => 7,
            'administrator'              => 9,
            'superadmin'                 => 10,
            default                      => 1,
        };
    }
}