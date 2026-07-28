<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataLengkapMahasiswaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nim_mahasiswa' => $this->nim_mahasiswa,
            'matkul' => $this->matkul,
            'tahun_akademik_id' => $this->tahun_akademik_id,
            'mahasiswa' => new MahasiswaResource($this->whenLoaded('mahasiswa')),
            'mata_kuliah' => new MataKuliahResource($this->whenLoaded('mataKuliah')),
            'tahun_akademik' => new TahunAkademikResource($this->whenLoaded('tahunAkademik')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
