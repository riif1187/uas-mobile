<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMataKuliahRequest;
use App\Http\Requests\UpdateMataKuliahRequest;
use App\Http\Resources\MataKuliahResource;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::latest()->paginate(25);
        return MataKuliahResource::collection($mataKuliah);
    }

    public function store(StoreMataKuliahRequest $request)
    {
        $mataKuliah = MataKuliah::create($request->validated());
        return (new MataKuliahResource($mataKuliah))
            ->additional(['message' => 'Data berhasil ditambahkan'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($kode_matkul)
    {
        $mataKuliah = MataKuliah::findOrFail($kode_matkul);
        return new MataKuliahResource($mataKuliah);
    }

    public function update(UpdateMataKuliahRequest $request, $kode_matkul)
    {
        $mataKuliah = MataKuliah::findOrFail($kode_matkul);
        $mataKuliah->update($request->validated());
        return (new MataKuliahResource($mataKuliah->fresh()))
            ->additional(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($kode_matkul)
    {
        $mataKuliah = MataKuliah::findOrFail($kode_matkul);
        $mataKuliah->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
