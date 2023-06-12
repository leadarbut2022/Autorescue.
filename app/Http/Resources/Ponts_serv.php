<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Ponts_serv extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
              
            'id' => $this->id,
            'type' => $this->type,
            'prise' => $this->pise,
            'iduser_prfoder' => $this->iduser_prfoder,
            'texRecord' => $this->texRecord,
            
         
        ];
    }
}
