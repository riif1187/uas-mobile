<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('mahasiswa')) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $dosen = Dosen::all();
        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        Dosen::create([
            'NIP'              => $request->NIP,
            'nama'             => $request->nama,
            'fakultas'         => $request->fakultas,
            'prodi'            => $request->prodi,
            'jabatan_akademik' => $request->jabatan_akademik,
            'email'            => $request->email,
            'no_telepon'       => $request->no_telepon,
            'status_aktif'     => $request->status_aktif,
        ]);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan!');
    }

    public function show($NIP)
    {
        $dosen = Dosen::where('NIP', $NIP)->firstOrFail();
        return view('dosen.show', compact('dosen'));
    }

    public function edit($NIP)
    {
        $dosen = Dosen::where('NIP', $NIP)->firstOrFail();
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $NIP)
    {
        $dosen = Dosen::where('NIP', $NIP)->firstOrFail();
        $dosen->update([
            'nama'             => $request->nama,
            'fakultas'         => $request->fakultas,
            'prodi'            => $request->prodi,
            'jabatan_akademik' => $request->jabatan_akademik,
            'email'            => $request->email,
            'no_telepon'       => $request->no_telepon,
            'status_aktif'     => $request->status_aktif,
        ]);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbarui!');
    }

    public function destroy($NIP)
    {
        $dosen = Dosen::where('NIP', $NIP)->firstOrFail();
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus!');
    }
}