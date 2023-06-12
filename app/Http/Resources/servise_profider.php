<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class servise_profider extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            

         

            'id' => $this->id ,
            'prise' => ($this->prise === null) ? 'ok' : $this->prise,
            'type_serv' => ($this->prise === null) ? 'ok' : $this->type_serv,
            'LOT' => ($this->prise === null) ? 'ok' : $this->LOT,
            // 'image' => ($this->prise == null) ? 'ok' : $this->image,
            'long' => ($this->prise === null) ? 'ok' : $this->location,
            'phone' => ($this->prise === null) ? 'ok' : $this->phone,
            'Regestrion_number' => ($this->prise === null) ? 'ok' : $this->Regestrion_number,
            'centerName' => ($this->prise === null) ? 'ok' : $this->centerName,
            'texRecord' => ($this->prise === null) ? 'ok' : $this->texRecord,
           'type' => ($this->prise === null) ? 'ok' : $this->type_serv,
           'price' => ($this->prise === null) ? 'ok' : $this->prise,
     
            // SELECT `id`, `id_User`, `id_sirvice`, `text_`, `created_at`, `updated_at`, `stat`, `phone`, `nots_from_Service`, `pyments_user`, `pymentstate`, `prise`, `deleted` FROM `reports_` WHERE 1
         
        ];
    }
}
