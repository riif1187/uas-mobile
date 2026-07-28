<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMataKuliahRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kode_matkul' => 'required|string|max:255|unique:mata_kuliah_tabel,kode_matkul',
            'nama_matkul' => 'required|string|max:255',
            'sks' => 'required|integer',
            'semester' => 'required|integer',
            'prodi' => 'required|string|max:255',
            'jenis' => 'required|in:wajib,pilihan',
            'status_aktif' => 'nullable|boolean',
        ];
    }
}
