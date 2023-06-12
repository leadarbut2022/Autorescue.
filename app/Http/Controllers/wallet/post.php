<?php

namespace App\Http\Controllers\wallet;

use App\Http\Controllers\Controller;
use App\Models\pymentation;
use App\Models\sta_mony;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class post extends Controller
{
    public function Add_money(Request $request){


        $Num= $request->num;
        $date= $request->date;
        $cvc= $request->cvc;
        $cunt= $request->cunt;
        $id= $request->id;
        $now = Carbon::now();
        $stat =1;
        $add_1= sta_mony::create(
            [
                 'id_user' => $id,
                 'stat' => $stat,          
                 'datecard' => $date,          
                 'cvc' => $cvc,          
                 'num_card' => $Num,          
                 'VALUE_' => $cunt,          
        ]);

        if ($add_1) {
     

        $add= pymentation::where('id_user','=',$id )->first();

        if ($add) {


            $add= pymentation::where('id_user','=',$id )->first();
            $cunt_end = intval($add->money)+ intval($cunt);
        pymentation::where('id_user','=',$id )->update(
            [
                
                 'money' => $cunt_end,
                 'last_charg' => $now,          
        ]);
        $msg=1;
        return response()->json(['stat' => 'ok'],200);

        }else {
            pymentation::create(
                [
                     'id_user' => $id,
                     'money' => $cunt,
                     'last_charg' => $now,          
            ]);
                 $msg=1;
            return response()->json(['stat' => 'ok'],200);
        }
    }


            $msg=0;
            return response()->json(['stat' => 'no'],404);
                
        
    
       }


     
}
