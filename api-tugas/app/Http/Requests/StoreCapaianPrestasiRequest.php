<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCapaianPrestasiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'pendaftaran_id' => 'required|string|exists:pendaftaran_prestasi,pendaftaran_id',
            'peringkat' => 'required|string|max:255',
            'file_bukti' => 'nullable|file|max:2048',
            'NIP' => 'required|string|exists:dosen_tabel,NIP',
        ];
    }
}
