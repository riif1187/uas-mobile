<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePendaftaranPrestasiRequest;
use App\Http\Requests\UpdatePendaftaranPrestasiRequest;
use App\Http\Resources\PendaftaranPrestasiResource;
use App\Models\PendaftaranPrestasi;
use Illuminate\Http\Request;

class PendaftaranPrestasiController extends Controller
{
    public function index(Request $request)
    {
        $query = PendaftaranPrestasi::latest();
        if ($request->has('nim')) {
            $query->where('NIM', $request->nim);
        }
        $pendaftaran = $query->paginate(25);
        return PendaftaranPrestasiResource::collection($pendaftaran);
    }

    public function store(StorePendaftaranPrestasiRequest $request)
    {
        $pendaftaran = PendaftaranPrestasi::create($request->validated());
        return (new PendaftaranPrestasiResource($pendaftaran))
            ->additional(['message' => 'Data berhasil ditambahkan'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($pendaftaran_id)
    {
        $pendaftaran = PendaftaranPrestasi::findOrFail($pendaftaran_id);
        $pendaftaran->load(['mahasiswa', 'referensiKejuaraan', 'capaianPrestasi']);
        return new PendaftaranPrestasiResource($pendaftaran);
    }

    public function update(UpdatePendaftaranPrestasiRequest $request, $pendaftaran_id)
    {
        $pendaftaran = PendaftaranPrestasi::findOrFail($pendaftaran_id);
        $pendaftaran->update($request->validated());
        return (new PendaftaranPrestasiResource($pendaftaran->fresh()))
            ->additional(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($pendaftaran_id)
    {
        $pendaftaran = PendaftaranPrestasi::findOrFail($pendaftaran_id);
        $pendaftaran->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
