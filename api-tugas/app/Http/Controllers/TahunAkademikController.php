<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    public function index()
    {
        $tahunAkademik = TahunAkademik::all();
        return view('tahun-akademik.index', compact('tahunAkademik'));
    }

    public function create()
    {
        return view('tahun-akademik.create');
    }

    public function store(Request $request)
    {
        TahunAkademik::create([
            'tahun_akademik'  => $request->tahun_akademik,
            'semester'        => $request->semester,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status'          => $request->status,
        ]);

        return redirect()->route('tahun-akademik.index')->with('success', 'Tahun Akademik berhasil ditambahkan!');
    }

    public function show($id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($id);
        return view('tahun-akademik.show', compact('tahunAkademik'));
    }

    public function edit($id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($id);
        return view('tahun-akademik.edit', compact('tahunAkademik'));
    }

    public function update(Request $request, $id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($id);
        $tahunAkademik->update([
            'tahun_akademik'  => $request->tahun_akademik,
            'semester'        => $request->semester,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status'          => $request->status,
        ]);

        return redirect()->route('tahun-akademik.index')->with('success', 'Tahun Akademik berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($id);
        $tahunAkademik->delete();

        return redirect()->route('tahun-akademik.index')->with('success', 'Tahun Akademik berhasil dihapus!');
    }
}