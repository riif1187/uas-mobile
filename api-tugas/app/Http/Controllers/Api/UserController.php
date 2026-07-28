<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(25);
        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }
        return (new UserResource($user->load('roles')))
            ->additional(['message' => 'Data berhasil ditambahkan'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }
        return (new UserResource($user->fresh()->load('roles')))
            ->additional(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
