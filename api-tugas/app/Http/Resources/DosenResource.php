<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DosenResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'NIP' => $this->NIP,
            'nama' => $this->nama,
            'fakultas' => $this->fakultas,
            'prodi' => $this->prodi,
            'jabatan_akademik' => $this->jabatan_akademik,
            'email' => $this->email,
            'no_telepon' => $this->no_telepon,
            'status_aktif' => $this->status_aktif,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
