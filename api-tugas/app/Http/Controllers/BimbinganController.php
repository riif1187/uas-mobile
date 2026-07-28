<?php

namespace App\Http\Controllers;

use App\Models\bimbingan as Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class BimbinganController extends Controller
{
    public function index()
    {
        $bimbingan = Bimbingan::with(['mahasiswa', 'dosen'])->latest()->get();

        return view('bimbingan.index', compact('bimbingan'));
    }

    public function create()
    {
        $dataMahasiswa = Mahasiswa::orderBy('nama')->get();
        $dataDosen = Dosen::orderBy('nama')->get();

        return view('bimbingan.create', compact('dataMahasiswa', 'dataDosen'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim_mahasiswa' => ['required', 'exists:mahasiswa_tabel,NIM'],
            'nip_dosen' => ['required', 'exists:dosen_tabel,NIP'],
            'tanggal_bimbingan' => ['required', 'date'],
        ]);

        Bimbingan::create($validated);

        return redirect()->route('bimbingan.index')->with('success', 'Bimbingan berhasil ditambahkan!');
    }

    public function show($id)
    {
        return redirect()->route('bimbingan.index');
    }

    public function edit($id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        $dataMahasiswa = Mahasiswa::orderBy('nama')->get();
        $dataDosen = Dosen::orderBy('nama')->get();

        return view('bimbingan.edit', compact('bimbingan', 'dataMahasiswa', 'dataDosen'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nim_mahasiswa' => ['required', 'exists:mahasiswa_tabel,NIM'],
            'nip_dosen' => ['required', 'exists:dosen_tabel,NIP'],
            'tanggal_bimbingan' => ['required', 'date'],
        ]);

        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->update($validated);

        return redirect()->route('bimbingan.index')->with('success', 'Bimbingan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Bimbingan::findOrFail($id)->delete();

        return redirect()->route('bimbingan.index')->with('success', 'Bimbingan berhasil dihapus!');
    }
}
