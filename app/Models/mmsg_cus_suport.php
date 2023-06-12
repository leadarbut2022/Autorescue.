<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mmsg_cus_suport extends Model
{
    use HasFactory;
    protected $table='supmsg';
    protected $fillable = [
        'id',
        'id_user',
        'idsup',
        'textuse',
        'textcus',
    ];

}
