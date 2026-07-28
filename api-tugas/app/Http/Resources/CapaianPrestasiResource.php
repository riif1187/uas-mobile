<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CapaianPrestasiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'capaian_id' => $this->capaian_id,
            'pendaftaran_id' => $this->pendaftaran_id,
            'peringkat' => $this->peringkat,
            'file_bukti' => $this->file_bukti,
            'NIP' => $this->NIP,
            'pendaftaran_prestasi' => new PendaftaranPrestasiResource($this->whenLoaded('pendaftaranPrestasi')),
            'dosen' => new DosenResource($this->whenLoaded('dosen')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
