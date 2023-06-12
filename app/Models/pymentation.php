<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pymentation extends Model
{
    use HasFactory;

    protected $table = 'pyament';
    protected $fillable = [
        'id_user',
        'money',
        'last_charg',
    
    ];
}
