<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
use App\Http\Resources\DosenResource;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::latest()->paginate(25);
        return DosenResource::collection($dosen);
    }

    public function store(StoreDosenRequest $request)
    {
        $dosen = Dosen::create($request->validated());
        return (new DosenResource($dosen))
            ->additional(['message' => 'Data berhasil ditambahkan'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($NIP)
    {
        $dosen = Dosen::findOrFail($NIP);
        return new DosenResource($dosen);
    }

    public function update(UpdateDosenRequest $request, $NIP)
    {
        $dosen = Dosen::findOrFail($NIP);
        $dosen->update($request->validated());
        return (new DosenResource($dosen->fresh()))
            ->additional(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($NIP)
    {
        $dosen = Dosen::findOrFail($NIP);
        $dosen->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
