<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReferensiKejuaraanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'ref_id' => $this->ref_id,
            'nama_kejuaraan' => $this->nama_kejuaraan,
            'bobot_poin' => $this->bobot_poin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
