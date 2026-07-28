<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TahunAkademikResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tahun_akademik' => $this->tahun_akademik,
            'semester' => $this->semester,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
