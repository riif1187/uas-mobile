<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReferensiKejuaraanRequest;
use App\Http\Requests\UpdateReferensiKejuaraanRequest;
use App\Http\Resources\ReferensiKejuaraanResource;
use App\Models\ReferensiKejuaraan;

class ReferensiKejuaraanController extends Controller
{
    public function index()
    {
        $referensi = ReferensiKejuaraan::latest()->paginate(25);
        return ReferensiKejuaraanResource::collection($referensi);
    }

    public function store(StoreReferensiKejuaraanRequest $request)
    {
        $referensi = ReferensiKejuaraan::create($request->validated());
        return (new ReferensiKejuaraanResource($referensi))
            ->additional(['message' => 'Data berhasil ditambahkan'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($ref_id)
    {
        $referensi = ReferensiKejuaraan::findOrFail($ref_id);
        return new ReferensiKejuaraanResource($referensi);
    }

    public function update(UpdateReferensiKejuaraanRequest $request, $ref_id)
    {
        $referensi = ReferensiKejuaraan::findOrFail($ref_id);
        $referensi->update($request->validated());
        return (new ReferensiKejuaraanResource($referensi->fresh()))
            ->additional(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($ref_id)
    {
        $referensi = ReferensiKejuaraan::findOrFail($ref_id);
        $referensi->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
