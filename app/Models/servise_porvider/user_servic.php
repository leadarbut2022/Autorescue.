<?php

namespace App\Models\servise_porvider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class user_servic extends Authenticatable
{
    use HasFactory,HasApiTokens ,Notifiable;
    protected $table='sevicePorvider';
    protected $fillable = [
        'texRecord',
        'centerName',
       'Regestrion_number',
        'phone',
        'password',
        'location',
        'image',
        'reset_password_code',
        'code_expiration',
        'fcm_token',
        'status',
        'is_verified',
        'remember_token',
        'LOT',
        'type_serv',
        'prise',
        
    ];

    public static function randToken () {
        return rand(10000,99999);
    }

}
