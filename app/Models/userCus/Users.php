<?php

namespace App\Models\userCus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class users extends Authenticatable
{

    
    use HasFactory ,HasApiTokens ,Notifiable;
    protected $table='users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'remember_token',
    ];

    public static function randToken () {
        return rand(10000,99999);
    }






    

    public function city () {
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function userNotifications () {
        return $this->hasMany(Notification::class,'user_id','id');
    }

    public function orders () {
        return $this->hasMany(Order::class,'user_id','id')->orderBy('id', 'desc');
    }





    protected $hidden = [
        'password', 'remember_token','updated_at','reset_password_code',
        'code_expiration'
    ];

   

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

}
