<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        // Ambil semua user beserta role mereka
        $users = User::with('roles')->get();
        $roles = Role::all();
        
        return view('hak-akses.users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = User::findOrFail($id);
        
        // Update role user (menggunakan sync)
        $user->roles()->sync([$request->role_id]);

        return redirect()->route('users.index')
            ->with('success', 'Role user ' . $user->name . ' berhasil diperbarui.');
    }
}
