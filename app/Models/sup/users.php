<?php

namespace App\Models\sup;

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
        // 'email',
        'password',
        'phone',
        'remember_token',
    ];

}
