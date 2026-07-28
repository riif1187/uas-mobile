<?php

namespace App\Http\Controllers;

use App\Models\DataLengkapMahasiswa;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class DataLengkapMahasiswaController extends Controller
{
    public function index()
    {
        $dataLengkapMahasiswa = DataLengkapMahasiswa::with(['mahasiswa', 'mataKuliah', 'tahunAkademik'])
            ->latest()
            ->get();

        return view('data_lengkap_mahasiswa.index', compact('dataLengkapMahasiswa'));
    }

    public function create()
    {
        $dataMahasiswa = Mahasiswa::orderBy('nama')->get();
        $dataMataKuliah = MataKuliah::orderBy('nama_matkul')->get();
        $dataTahunAkademik = TahunAkademik::orderBy('tahun_akademik')->get();

        return view('data_lengkap_mahasiswa.create', compact(
            'dataMahasiswa',
            'dataMataKuliah',
            'dataTahunAkademik'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim_mahasiswa' => ['required', 'exists:mahasiswa_tabel,NIM'],
            'matkul' => ['required', 'exists:mata_kuliah_tabel,kode_matkul'],
            'tahun_akademik_id' => ['required', 'exists:tahun_akademik_tabel,id'],
        ]);

        DataLengkapMahasiswa::create($validated);

        return redirect()
            ->route('data-lengkap-mahasiswa.index')
            ->with('success', 'Data lengkap mahasiswa berhasil ditambahkan!');
    }

    public function show($id)
    {
        return redirect()->route('data-lengkap-mahasiswa.index');
    }

    public function edit($id)
    {
        $dataLengkapMahasiswa = DataLengkapMahasiswa::findOrFail($id);
        $dataMahasiswa = Mahasiswa::orderBy('nama')->get();
        $dataMataKuliah = MataKuliah::orderBy('nama_matkul')->get();
        $dataTahunAkademik = TahunAkademik::orderBy('tahun_akademik')->get();

        return view('data_lengkap_mahasiswa.edit', compact(
            'dataLengkapMahasiswa',
            'dataMahasiswa',
            'dataMataKuliah',
            'dataTahunAkademik'
        ));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nim_mahasiswa' => ['required', 'exists:mahasiswa_tabel,NIM'],
            'matkul' => ['required', 'exists:mata_kuliah_tabel,kode_matkul'],
            'tahun_akademik_id' => ['required', 'exists:tahun_akademik_tabel,id'],
        ]);

        $dataLengkapMahasiswa = DataLengkapMahasiswa::findOrFail($id);
        $dataLengkapMahasiswa->update($validated);

        return redirect()
            ->route('data-lengkap-mahasiswa.index')
            ->with('success', 'Data lengkap mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DataLengkapMahasiswa::findOrFail($id)->delete();

        return redirect()
            ->route('data-lengkap-mahasiswa.index')
            ->with('success', 'Data lengkap mahasiswa berhasil dihapus!');
    }
}
