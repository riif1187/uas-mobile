<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_role' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug',
            'deskripsi' => 'nullable|string|max:255',
            'level_akses' => 'required|integer',
            'is_active' => 'nullable|boolean',
        ];
    }
}
