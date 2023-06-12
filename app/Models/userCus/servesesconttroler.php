<?php

namespace App\Models\userCus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servesesconttroler extends Model
{
    use HasFactory;
    protected $table='sevices';
    protected $fillable = [
        'name',
        'type',
        'id',
        // 'phone',
        // 'remember_token',
        // SELECT `id`, `name`, `type`, `prisefrom`, `priseto`, `remember_token`, `created_at`, `updated_at` FROM `` WHERE 1
    ];
}
