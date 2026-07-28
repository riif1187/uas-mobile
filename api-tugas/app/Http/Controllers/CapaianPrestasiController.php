<?php

namespace App\Http\Controllers;

use App\Models\CapaianPrestasi;
use App\Models\PendaftaranPrestasi;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CapaianPrestasiController extends Controller
{
    public function index()
    {
        $capaian = CapaianPrestasi::with(['pendaftaranPrestasi', 'dosen'])->latest()->get();
        return view('capaian-prestasi.index', compact('capaian'));
    }

    public function create()
    {
        $pendaftaran = PendaftaranPrestasi::with('mahasiswa')->get();
        $dosen       = Dosen::where('status_aktif', true)->get();
        return view('capaian-prestasi.create', compact('pendaftaran', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran_prestasi,pendaftaran_id',
            'peringkat'      => 'required|string',
            'file_bukti'     => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'NIP'            => 'required|exists:dosen_tabel,NIP',
        ]);

        $filePath = $request->file('file_bukti')->store('bukti', 'public');

        CapaianPrestasi::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'peringkat'      => $request->peringkat,
            'file_bukti'     => $filePath,
            'NIP'            => $request->NIP,
        ]);

        return redirect()->route('capaian-prestasi.index')->with('success', 'Capaian prestasi berhasil ditambahkan!');
    }

    public function show($id)
    {
        $capaian = CapaianPrestasi::with(['pendaftaranPrestasi.mahasiswa', 'dosen'])->findOrFail($id);
        return view('capaian-prestasi.show', compact('capaian'));
    }

    public function file($id)
    {
        $capaian = CapaianPrestasi::findOrFail($id);

        if (!$capaian->file_bukti || !Storage::disk('public')->exists($capaian->file_bukti)) {
            return redirect()
                ->route('capaian-prestasi.index')
                ->withErrors(['file_bukti' => 'File bukti tidak ditemukan.']);
        }

        return Storage::disk('public')->response($capaian->file_bukti);
    }

    public function edit($id)
    {
        $capaian     = CapaianPrestasi::findOrFail($id);
        $pendaftaran = PendaftaranPrestasi::with('mahasiswa')->get();
        $dosen       = Dosen::where('status_aktif', true)->get();
        return view('capaian-prestasi.edit', compact('capaian', 'pendaftaran', 'dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran_prestasi,pendaftaran_id',
            'peringkat'      => 'required|string',
            'file_bukti'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'NIP'            => 'required|exists:dosen_tabel,NIP',
        ]);

        $capaian = CapaianPrestasi::findOrFail($id);

        $data = [
            'pendaftaran_id' => $request->pendaftaran_id,
            'peringkat'      => $request->peringkat,
            'NIP'            => $request->NIP,
        ];

        if ($request->hasFile('file_bukti')) {
            $data['file_bukti'] = $request->file('file_bukti')->store('bukti', 'public');
        }

        $capaian->update($data);
        return redirect()->route('capaian-prestasi.index')->with('success', 'Capaian prestasi berhasil diupdate!');
    }

    public function destroy($id)
    {
        CapaianPrestasi::findOrFail($id)->delete();
        return redirect()->route('capaian-prestasi.index')->with('success', 'Capaian prestasi berhasil dihapus!');
    }
}
