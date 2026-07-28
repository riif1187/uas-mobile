<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('role');
        return [
            'nama_role' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug,' . $id,
            'deskripsi' => 'nullable|string|max:255',
            'level_akses' => 'required|integer',
            'is_active' => 'nullable|boolean',
        ];
    }
}
