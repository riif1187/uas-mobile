<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPrestasi;
use App\Models\Mahasiswa;
use App\Models\ReferensiKejuaraan;
use Illuminate\Http\Request;

class PendaftaranPrestasiController extends Controller
{
    public function index()
    {
        $pendaftaran = PendaftaranPrestasi::with(['mahasiswa', 'referensiKejuaraan'])->latest()->get();
        return view('pendaftaran-prestasi.index', compact('pendaftaran'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::orderBy('nama')->get();
        $referensi = ReferensiKejuaraan::orderBy('nama_kejuaraan')->get();
        return view('pendaftaran-prestasi.create', compact('mahasiswa', 'referensi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NIM'           => 'required|exists:mahasiswa_tabel,NIM',
            'ref_id'        => 'required|exists:referensi_kejuaraan,ref_id',
            'nama_kegiatan' => 'required|string',
        ]);

        PendaftaranPrestasi::create([
            'NIM'           => $request->NIM,
            'ref_id'        => $request->ref_id,
            'nama_kegiatan' => $request->nama_kegiatan,
        ]);

        return redirect()->route('pendaftaran-prestasi.index')->with('success', 'Pendaftaran berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pendaftaran = PendaftaranPrestasi::with(['mahasiswa', 'referensiKejuaraan', 'capaianPrestasi'])->findOrFail($id);
        return view('pendaftaran-prestasi.show', compact('pendaftaran'));
    }

    public function edit($id)
    {
        $pendaftaran = PendaftaranPrestasi::findOrFail($id);
        $mahasiswa   = Mahasiswa::orderBy('nama')->get();
        $referensi   = ReferensiKejuaraan::orderBy('nama_kejuaraan')->get();
        return view('pendaftaran-prestasi.edit', compact('pendaftaran', 'mahasiswa', 'referensi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'NIM'           => 'required|exists:mahasiswa_tabel,NIM',
            'ref_id'        => 'required|exists:referensi_kejuaraan,ref_id',
            'nama_kegiatan' => 'required|string',
        ]);

        $pendaftaran = PendaftaranPrestasi::findOrFail($id);
        $pendaftaran->update([
            'NIM'           => $request->NIM,
            'ref_id'        => $request->ref_id,
            'nama_kegiatan' => $request->nama_kegiatan,
        ]);

        return redirect()->route('pendaftaran-prestasi.index')->with('success', 'Pendaftaran berhasil diupdate!');
    }

    public function destroy($id)
    {
        PendaftaranPrestasi::findOrFail($id)->delete();
        return redirect()->route('pendaftaran-prestasi.index')->with('success', 'Pendaftaran berhasil dihapus!');
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,tidak_disetujui',
        ]);

        $pendaftaran = PendaftaranPrestasi::findOrFail($id);
        $pendaftaran->update([
            'status' => $request->status,
        ]);

        $statusText = $request->status == 'disetujui' ? 'disetujui' : 'ditolak';
        return redirect()->back()->with('success', "Pendaftaran berhasil {$statusText}!");
    }
}
