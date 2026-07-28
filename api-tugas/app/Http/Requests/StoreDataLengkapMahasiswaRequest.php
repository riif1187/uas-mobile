<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataLengkapMahasiswaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nim_mahasiswa' => 'required|string|exists:mahasiswa_tabel,NIM',
            'matkul' => 'required|string|exists:mata_kuliah_tabel,kode_matkul',
            'tahun_akademik_id' => 'required|integer|exists:tahun_akademik_tabel,id',
        ];
    }
}
