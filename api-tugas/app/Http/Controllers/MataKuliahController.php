<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::all();
        return view('mata-kuliah.index', compact('mataKuliah'));
    }

    public function create()
    {
        return view('mata-kuliah.create');
    }

    public function store(Request $request)
    {
        MataKuliah::create([
            'kode_matkul'  => $request->kode_matkul,
            'nama_matkul'  => $request->nama_matkul,
            'sks'          => $request->sks,
            'semester'     => $request->semester,
            'prodi'        => $request->prodi,
            'jenis'        => $request->jenis,
            'status_aktif' => $request->status_aktif,
        ]);

        return redirect()->route('mata-kuliah.index');
    }

    public function show($kode_matkul)
    {
        $mataKuliah = MataKuliah::where('kode_matkul', $kode_matkul)->firstOrFail();
        return view('mata-kuliah.show', compact('mataKuliah'));
    }

    public function edit($kode_matkul)
    {
        $mataKuliah = MataKuliah::where('kode_matkul', $kode_matkul)->firstOrFail();
        return view('mata-kuliah.edit', compact('mataKuliah')); // ✅ Huruf kecil 'm'
    }

    public function update(Request $request, $kode_matkul)
    {
        $mataKuliah = MataKuliah::where('kode_matkul', $kode_matkul)->firstOrFail();
        $mataKuliah->update([
            'nama_matkul'  => $request->nama_matkul,
            'sks'          => $request->sks,
            'semester'     => $request->semester,
            'prodi'        => $request->prodi,
            'jenis'        => $request->jenis,
            'status_aktif' => $request->status_aktif,
        ]);

        return redirect()->route('mata-kuliah.index');
    }

    public function destroy($kode_matkul)
    {
        $mataKuliah = MataKuliah::where('kode_matkul', $kode_matkul)->firstOrFail();
        $mataKuliah->delete();

        return redirect()->route('mata-kuliah.index');
    }
}