<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBimbinganRequest;
use App\Http\Requests\UpdateBimbinganRequest;
use App\Http\Resources\BimbinganResource;
use App\Models\Bimbingan;

class BimbinganController extends Controller
{
    public function index()
    {
        $bimbingan = Bimbingan::latest()->paginate(25);
        return BimbinganResource::collection($bimbingan);
    }

    public function store(StoreBimbinganRequest $request)
    {
        $bimbingan = Bimbingan::create($request->validated());
        return (new BimbinganResource($bimbingan))
            ->additional(['message' => 'Data berhasil ditambahkan'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->load(['mahasiswa', 'dosen']);
        return new BimbinganResource($bimbingan);
    }

    public function update(UpdateBimbinganRequest $request, $id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->update($request->validated());
        return (new BimbinganResource($bimbingan->fresh()))
            ->additional(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
