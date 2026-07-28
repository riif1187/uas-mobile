<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMahasiswaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'NIM' => 'required|string|max:15|unique:mahasiswa_tabel,NIM',
            'nama' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_telepon' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:255',
            'golongan_darah' => 'nullable|string|max:5',
            'status_pernikahan' => 'required|string|max:255',
            'status_aktif' => 'nullable|string|max:255',
        ];
    }
}
