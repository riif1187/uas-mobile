<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa')); // ✅ diubah
    }

    public function create()
    {
        return view('mahasiswa.create'); // ✅ diubah
    }

    public function store(Request $request)
    {
        Mahasiswa::create([
            'nama'              => $request->nama,
            'NIM'               => $request->NIM,
            'fakultas'          => $request->fakultas,
            'prodi'             => $request->prodi,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'email'             => $request->email,
            'no_telepon'        => $request->no_telepon,
            'alamat'            => $request->alamat,
            'agama'             => $request->agama,
            'kewarganegaraan'   => $request->kewarganegaraan,
            'golongan_darah'    => $request->golongan_darah,
            'status_pernikahan' => $request->status_pernikahan,
            'status_aktif'      => $request->status_aktif
        ]);

        return redirect()->route('data-mahasiswa'); 
    }

    public function show($NIM)
    {
        $mahasiswa = Mahasiswa::where('NIM', $NIM)->firstOrFail();
        return view('mahasiswa.show', compact('mahasiswa')); 
    }

    public function edit($NIM)
    {
        $mahasiswa = Mahasiswa::where('NIM', $NIM)->firstOrFail();
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $NIM)
    {
        $mahasiswa = Mahasiswa::where('NIM', $NIM)->firstOrFail();
        
        $mahasiswa->update([
            'nama'              => $request->nama,
            'NIM'               => $request->NIM,
            'fakultas'          => $request->fakultas,
            'prodi'             => $request->prodi,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'email'             => $request->email,
            'no_telepon'        => $request->no_telepon,
            'alamat'            => $request->alamat,
            'agama'             => $request->agama,
            'kewarganegaraan'   => $request->kewarganegaraan,
            'golongan_darah'    => $request->golongan_darah,
            'status_pernikahan' => $request->status_pernikahan,
            'status_aktif'      => $request->status_aktif
        ]);

        return redirect()->route('data-mahasiswa');
    }

    public function destroy($NIM)
    {
        $mahasiswa = Mahasiswa::where('NIM', $NIM)->first();
        $mahasiswa->delete();

        return redirect()->route('data-mahasiswa');
    }
}