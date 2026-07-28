<?php

namespace App\Http\Controllers;

use App\Models\FuzzyKlasifikasi;
use App\Models\Mahasiswa;
use App\Services\FuzzyPrestasiService;
use Illuminate\Http\Request;

class FuzzyKlasifikasiController extends Controller
{
    public function index()
    {
        $klasifikasi = FuzzyKlasifikasi::with('mahasiswa')->latest()->get();
        return view('fuzzy-klasifikasi.index', compact('klasifikasi'));
    }

    public function show($NIM)
    {
        $data = FuzzyKlasifikasi::with('mahasiswa')->where('NIM', $NIM)->firstOrFail();
        return view('fuzzy-klasifikasi.show', compact('data'));
    }

    public function refresh()
    {
        $service = new FuzzyPrestasiService();
        $results = $service->classifyAll();

        foreach ($results as $r) {
            FuzzyKlasifikasi::updateOrCreate(
                ['NIM' => $r['NIM']],
                [
                    'jumlah_prestasi'  => $r['jumlah_prestasi'],
                    'total_poin'       => $r['total_poin'],
                    'peringkat_terbaik'=> is_numeric($r['peringkat_terbaik']) ? $r['peringkat_terbaik'] : 0,
                    'skor_fuzzy'       => $r['skor'],
                    'label_fuzzy'      => $r['label'],
                ]
            );
        }

        return redirect()->route('fuzzy-klasifikasi.index')
            ->with('success', 'Klasifikasi fuzzy berhasil diperbarui!');
    }
}
