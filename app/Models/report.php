<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    use HasFactory;

    protected $table='reports_';
    protected $fillable = [
        'id',
        'id_User',
        'id_sirvice',
        'text_',
        'stat',
        'phone',
        'prise',
        'nots_from_Service',
        'pyments_user',
                'pymentstate',
'type_serv',
'phoneserv'

        // ALTER TABLE reports_ ADD pyments_user text
    ];

}
