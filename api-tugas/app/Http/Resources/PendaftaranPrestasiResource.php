<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PendaftaranPrestasiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'pendaftaran_id' => $this->pendaftaran_id,
            'NIM' => $this->NIM,
            'ref_id' => $this->ref_id,
            'nama_kegiatan' => $this->nama_kegiatan,
            'status' => $this->status,
            'mahasiswa' => new MahasiswaResource($this->whenLoaded('mahasiswa')),
            'referensi_kejuaraan' => new ReferensiKejuaraanResource($this->whenLoaded('referensiKejuaraan')),
            'capaian_prestasi' => new CapaianPrestasiResource($this->whenLoaded('capaianPrestasi')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
