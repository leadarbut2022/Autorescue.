<?php

namespace App\Models;

use App\Models\servise_porvider\user_servic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_service_has extends Model
{

    protected $table='profider_has_sevise_';
    protected $fillable = [
        'id',
        'type',
        'pise',
        'iduser_prfoder',
    ];


 
    public function user () {
        return $this->hasOne(user_servic::class,'id','iduser_prfoder');
    }
}
