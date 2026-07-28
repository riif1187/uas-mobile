<?php

namespace App\Http\Controllers;

use App\Models\ReferensiKejuaraan;
use Illuminate\Http\Request;

class ReferensiKejuaraanController extends Controller
{
    public function index()
    {
        $referensi = ReferensiKejuaraan::all();
        return view('referensi-kejuaraan.index', compact('referensi'));
    }

    public function create()
    {
        return view('referensi-kejuaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kejuaraan' => 'required|string',
            'bobot_poin'     => 'required|integer',
        ]);

        ReferensiKejuaraan::create([
            'nama_kejuaraan' => $request->nama_kejuaraan,
            'bobot_poin'     => $request->bobot_poin,
        ]);

        return redirect()->route('referensi-kejuaraan.index')->with('success', 'Referensi kejuaraan berhasil ditambahkan!');
    }

    public function show($ref_id)
    {
        $referensi = ReferensiKejuaraan::findOrFail($ref_id);
        return view('referensi-kejuaraan.show', compact('referensi'));
    }

    public function edit($ref_id)
    {
        $referensi = ReferensiKejuaraan::findOrFail($ref_id);
        return view('referensi-kejuaraan.edit', compact('referensi'));
    }

    public function update(Request $request, $ref_id)
    {
        $request->validate([
            'nama_kejuaraan' => 'required|string',
            'bobot_poin'     => 'required|integer',
        ]);

        $referensi = ReferensiKejuaraan::findOrFail($ref_id);
        $referensi->update([
            'nama_kejuaraan' => $request->nama_kejuaraan,
            'bobot_poin'     => $request->bobot_poin,
        ]);

        return redirect()->route('referensi-kejuaraan.index')->with('success', 'Referensi kejuaraan berhasil diupdate!');
    }

    public function destroy($ref_id)
    {
        ReferensiKejuaraan::findOrFail($ref_id)->delete();
        return redirect()->route('referensi-kejuaraan.index')->with('success', 'Referensi kejuaraan berhasil dihapus!');
    }
}
