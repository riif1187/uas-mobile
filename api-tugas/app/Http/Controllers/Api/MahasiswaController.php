<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Http\Resources\MahasiswaResource;
use App\Models\FuzzyKlasifikasi;
use App\Models\Mahasiswa;
use App\Services\FuzzyPrestasiService;

class MahasiswaController extends Controller
{
    public function fuzzy($nim)
    {
        $fuzzy = FuzzyKlasifikasi::with('mahasiswa')->where('NIM', $nim)->first();
        if (!$fuzzy) {
            return response()->json(['message' => 'Belum ada data klasifikasi'], 404);
        }
        return response()->json([
            'data' => [
                'id' => $fuzzy->id,
                'NIM' => $fuzzy->NIM,
                'jumlah_prestasi' => $fuzzy->jumlah_prestasi,
                'total_poin' => $fuzzy->total_poin,
                'peringkat_terbaik' => $fuzzy->peringkat_terbaik,
                'skor_fuzzy' => $fuzzy->skor_fuzzy,
                'label_fuzzy' => $fuzzy->label_fuzzy,
            ]
        ]);
    }

    public function byEmail($email)
    {
        $mahasiswa = Mahasiswa::where('email', $email)->firstOrFail();
        return new MahasiswaResource($mahasiswa);
    }

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

    public function fuzzyRefresh($nim)
    {
        $service = app(FuzzyPrestasiService::class);
        $result = $service->classify($nim);

        if (!$result) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        FuzzyKlasifikasi::updateOrCreate(
            ['NIM' => $nim],
            [
                'jumlah_prestasi'   => $result['jumlah_prestasi'],
                'total_poin'        => $result['total_poin'],
                'peringkat_terbaik' => $result['peringkat_terbaik'],
                'skor_fuzzy'        => $result['skor'],
                'label_fuzzy'       => $result['label'],
            ]
        );

        $fuzzy = FuzzyKlasifikasi::where('NIM', $nim)->first();

        return response()->json([
            'data' => [
                'id'                => $fuzzy->id,
                'NIM'               => $fuzzy->NIM,
                'jumlah_prestasi'   => $fuzzy->jumlah_prestasi,
                'total_poin'        => $fuzzy->total_poin,
                'peringkat_terbaik' => $fuzzy->peringkat_terbaik,
                'skor_fuzzy'        => $fuzzy->skor_fuzzy,
                'label_fuzzy'       => $fuzzy->label_fuzzy,
            ],
            'message' => 'Klasifikasi berhasil diperbarui',
        ]);
    }
}
