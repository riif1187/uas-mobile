<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCapaianPrestasiRequest;
use App\Http\Requests\UpdateCapaianPrestasiRequest;
use App\Http\Resources\CapaianPrestasiResource;
use App\Models\CapaianPrestasi;
use Illuminate\Http\Request;

class CapaianPrestasiController extends Controller
{
    public function index(Request $request)
    {
        $query = CapaianPrestasi::latest()->with([
            'pendaftaranPrestasi.mahasiswa',
            'pendaftaranPrestasi.referensiKejuaraan',
            'dosen'
        ]);
        if ($request->has('nim')) {
            $query->whereHas('pendaftaranPrestasi', function ($q) use ($request) {
                $q->where('NIM', $request->nim);
            });
        }
        $capaian = $query->paginate(25);
        return CapaianPrestasiResource::collection($capaian);
    }

    public function store(StoreCapaianPrestasiRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('file_bukti')) {
            $data['file_bukti'] = $request->file('file_bukti')->store('capaian-prestasi', 'public');
        }
        $capaian = CapaianPrestasi::create($data);
        return (new CapaianPrestasiResource($capaian))
            ->additional(['message' => 'Data berhasil ditambahkan'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($capaian_id)
    {
        $capaian = CapaianPrestasi::findOrFail($capaian_id);
        $capaian->load(['pendaftaranPrestasi', 'dosen']);
        return new CapaianPrestasiResource($capaian);
    }

    public function update(UpdateCapaianPrestasiRequest $request, $capaian_id)
    {
        $capaian = CapaianPrestasi::findOrFail($capaian_id);
        $data = $request->validated();
        if ($request->hasFile('file_bukti')) {
            $data['file_bukti'] = $request->file('file_bukti')->store('capaian-prestasi', 'public');
        }
        $capaian->update($data);
        return (new CapaianPrestasiResource($capaian->fresh()))
            ->additional(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($capaian_id)
    {
        $capaian = CapaianPrestasi::findOrFail($capaian_id);
        $capaian->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
