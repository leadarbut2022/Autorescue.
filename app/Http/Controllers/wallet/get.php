<?php

namespace App\Http\Controllers\wallet;

use App\Http\Controllers\Controller;
use App\Models\pymentation;
use Illuminate\Http\Request;

class get extends Controller
{
    public function getmo($id){
        $iduser= $id;
        $prise_on_acc =pymentation::where('id_user', '=', $iduser)->first();

        return response()->json(['stat' => @$prise_on_acc->money ],200);

       }
}
