<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MataKuliahResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'kode_matkul' => $this->kode_matkul,
            'nama_matkul' => $this->nama_matkul,
            'sks' => $this->sks,
            'semester' => $this->semester,
            'prodi' => $this->prodi,
            'jenis' => $this->jenis,
            'status_aktif' => $this->status_aktif,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
