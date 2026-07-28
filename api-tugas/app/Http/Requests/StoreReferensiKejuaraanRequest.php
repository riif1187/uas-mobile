<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReferensiKejuaraanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_kejuaraan' => 'required|string|max:255',
            'bobot_poin' => 'required|integer',
        ];
    }
}
