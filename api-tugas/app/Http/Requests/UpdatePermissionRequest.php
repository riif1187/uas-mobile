<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_permission' => 'required|string|max:255',
            'modul' => 'required|string|max:255',
            'aksi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
        ];
    }
}
