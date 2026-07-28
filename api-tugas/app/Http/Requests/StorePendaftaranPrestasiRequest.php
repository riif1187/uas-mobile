<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePendaftaranPrestasiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'NIM' => 'required|string|exists:mahasiswa_tabel,NIM',
            'ref_id' => 'required|string|exists:referensi_kejuaraan,ref_id',
            'nama_kegiatan' => 'required|string|max:255',
            'status' => 'nullable|in:pending,disetujui,tidak_disetujui',
        ];
    }
}
