<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTahunAkademikRequest;
use App\Http\Requests\UpdateTahunAkademikRequest;
use App\Http\Resources\TahunAkademikResource;
use App\Models\TahunAkademik;

class TahunAkademikController extends Controller
{
    public function index()
    {
        $tahunAkademik = TahunAkademik::latest()->paginate(25);
        return TahunAkademikResource::collection($tahunAkademik);
    }

    public function store(StoreTahunAkademikRequest $request)
    {
        $tahunAkademik = TahunAkademik::create($request->validated());
        return (new TahunAkademikResource($tahunAkademik))
            ->additional(['message' => 'Data berhasil ditambahkan'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($id);
        return new TahunAkademikResource($tahunAkademik);
    }

    public function update(UpdateTahunAkademikRequest $request, $id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($id);
        $tahunAkademik->update($request->validated());
        return (new TahunAkademikResource($tahunAkademik->fresh()))
            ->additional(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($id);
        $tahunAkademik->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
