<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BimbinganResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nim_mahasiswa' => $this->nim_mahasiswa,
            'nip_dosen' => $this->nip_dosen,
            'tanggal_bimbingan' => $this->tanggal_bimbingan,
            'mahasiswa' => new MahasiswaResource($this->whenLoaded('mahasiswa')),
            'dosen' => new DosenResource($this->whenLoaded('dosen')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
