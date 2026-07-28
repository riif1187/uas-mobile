<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::latest()->paginate(25);
        return MahasiswaResource::collection($mahasiswa);
    }

    public function store(StoreMahasiswaRequest $request)
    {
        $mahasiswa = Mahasiswa::create($request->validated());
        return (new MahasiswaResource($mahasiswa))
            ->additional(['message' => 'Data berhasil ditambahkan'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($NIM)
    {
        $mahasiswa = Mahasiswa::findOrFail($NIM);
        return new MahasiswaResource($mahasiswa);
    }

    public function update(UpdateMahasiswaRequest $request, $NIM)
    {
        $mahasiswa = Mahasiswa::findOrFail($NIM);
        $mahasiswa->update($request->validated());
        return (new MahasiswaResource($mahasiswa->fresh()))
            ->additional(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($NIM)
    {
        $mahasiswa = Mahasiswa::findOrFail($NIM);
        $mahasiswa->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
