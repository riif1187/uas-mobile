<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBimbinganRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nim_mahasiswa' => 'required|string|exists:mahasiswa_tabel,NIM',
            'nip_dosen' => 'required|string|exists:dosen_tabel,NIP',
            'tanggal_bimbingan' => 'required|date',
        ];
    }
}
