<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'NIM' => $this->NIM,
            'nama' => $this->nama,
            'fakultas' => $this->fakultas,
            'prodi' => $this->prodi,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'email' => $this->email,
            'no_telepon' => $this->no_telepon,
            'alamat' => $this->alamat,
            'agama' => $this->agama,
            'kewarganegaraan' => $this->kewarganegaraan,
            'golongan_darah' => $this->golongan_darah,
            'status_pernikahan' => $this->status_pernikahan,
            'status_aktif' => $this->status_aktif,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
