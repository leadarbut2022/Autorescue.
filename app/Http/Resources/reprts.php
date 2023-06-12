<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class reprts extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
              'id' => $this->id,
            'id_User' => $this->id_User,
            'id_sirvice_prov' => $this->id_sirvice,
            'text_' => $this->text_,
            'phone' => $this->phone,
            'nots_from_Service' => $this->nots_from_Service,
            'prise' => $this->prise,
             'type_serv' => $this->type_serv,
              'phoneserv' => $this->phoneserv,
     
            // SELECT `id`, `id_User`, `id_sirvice`, `text_`, `created_at`, `updated_at`, `stat`, `phone`, `nots_from_Service`, `pyments_user`, `pymentstate`, `prise`, `deleted` FROM `reports_` WHERE 1
         
        ];
    }
}
