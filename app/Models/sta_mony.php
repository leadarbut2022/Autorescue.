<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sta_mony extends Model
{
    use HasFactory;
    protected $table = 'stat_pay';
    protected $fillable = [
        'id',
        'VALUE_',
        'num_card',
        'cvc',
        'datecard',
        'stat',
        'id_user',
       
      
        // SELECT `id`, `VALUE_`, `num_card`, `cvc`, `datecard`, `stat`, `created_at`, `updated_at`, `id_user` FROM `` WHERE 1
 
    ];
}
