<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataLengkapMahasiswaRequest;
use App\Http\Requests\UpdateDataLengkapMahasiswaRequest;
use App\Http\Resources\DataLengkapMahasiswaResource;
use App\Models\DataLengkapMahasiswa;

class DataLengkapMahasiswaController extends Controller
{
    public function index()
    {
        $dataLengkap = DataLengkapMahasiswa::latest()->paginate(25);
        return DataLengkapMahasiswaResource::collection($dataLengkap);
    }

    public function store(StoreDataLengkapMahasiswaRequest $request)
    {
        $dataLengkap = DataLengkapMahasiswa::create($request->validated());
        return (new DataLengkapMahasiswaResource($dataLengkap))
            ->additional(['message' => 'Data berhasil ditambahkan'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $dataLengkap = DataLengkapMahasiswa::findOrFail($id);
        $dataLengkap->load(['mahasiswa', 'mataKuliah', 'tahunAkademik']);
        return new DataLengkapMahasiswaResource($dataLengkap);
    }

    public function update(UpdateDataLengkapMahasiswaRequest $request, $id)
    {
        $dataLengkap = DataLengkapMahasiswa::findOrFail($id);
        $dataLengkap->update($request->validated());
        return (new DataLengkapMahasiswaResource($dataLengkap->fresh()))
            ->additional(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $dataLengkap = DataLengkapMahasiswa::findOrFail($id);
        $dataLengkap->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
