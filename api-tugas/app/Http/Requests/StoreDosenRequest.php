<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDosenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'NIP' => 'required|string|max:255|unique:dosen_tabel,NIP',
            'nama' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'jabatan_akademik' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:dosen_tabel,email',
            'no_telepon' => 'required|string|max:255',
            'status_aktif' => 'nullable|boolean',
        ];
    }
}
