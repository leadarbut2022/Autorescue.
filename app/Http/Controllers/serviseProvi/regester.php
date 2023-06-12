<?php

namespace App\Http\Controllers\serviseProvi;
use App\Models\servise_porvider\user_servic as User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\type_service_has;
use Illuminate\Support\Facades\Validator;
use json_decode;

use Illuminate\Http\Request;

class regester extends Controller
{
    public function register(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            // 'texRecord' => 'required|string|min:3|max:255',
            // 'centerName' => 'required|string|min:3|max:255',
            // // 'location' => 'required|string|min:3',
            // 'Regestrion_number' => 'required|string|min:3|max:255',
            'phone' => 'required|unique:sevicePorvider,phone|size:11|starts_with:01',
            // 'password' => 'required|min:8|max:36',
            // 'list_Of_type_and_prise' => 'required',

            
        ]);
 
 
        if ($validator->fails()) {
            return response()->json(["message" => "phone number is already taken "], 422);
         }
 
        $rand = User::randToken();
        // prepare inputs




        $data = User::create([
            'texRecord' => $request->texRecord,
            'centerName' => $request->centerName,
            'phone' => $request->phone,
            'location' => $request->Lon,
            'LOT' => $request->lat,
            'remember_token' => Hash::make($rand),
            'Regestrion_number' => $request->Regestrion_number,
            'password' => Hash::make($request->get('password')),
            'type_serv' => $request->type_serv,
            'prise' => $request->prise,


            
        ]);
//        if (!$data) {
//            return $this->json(['message' => trans('response.failed')],444);
//        }
        if (!$data->save()) {
            return response()->json(['message' => trans('response.failed')],444);

        }


        // $id_user=User::where('type' , '=' ,'phone')->get();

        // $id =$id_user->id ;

        // $serv =(array)json_decode($request->list_Of_type_and_prise, true);


        // if ( is_array($serv)) {


        //     // $clinic_type_ = $request->teem_name;
        //     $clinic_type_ = $serv;

        //     foreach ($clinic_type_ as $key => $value) {

        //         type_service_has::create([

        //             'type' => $key,
        //             'pise' => $value,
        //             'iduser_prfoder' => $id,
                 
        //         ]);



        //     }

        // }
        $user = User::where('id',$data->id)->first();
 
 

        $responsee['texRecord'] = $request->texRecord;
          $responsee['centerName'] = $request->centerName;
            $responsee['lon'] = $request->location;
              $responsee['phone'] = $request->phone;
                $responsee['LOT'] = $request->LOT;
        $responsee['id'] = $data->id;

        // $response['code'] = $rand;
        $user = User::where('phone',request()->phone)->first();
        // $user->is_verified = $rand;
        $user->save();
        return response()->json(['data' => $responsee ,'message' => trans('ok')],200);
//        return response()->json(['data' => $response, 'message' => trans('user.register.success'), 'status' => trans('1')],200);

//       return response()->json(['message' => trans('user.register.success')], 200);

//        return response()->json(['message' => trans('user.register.success') ,'code'=> $rand],200);
//        return response()->json(['message' => trans('user.register.success')],200);
//        return response()->json(['status' => trans('user.register.success')],200);
    }


    public function addtype_prise(Request $request)
    {

        $id =$request->id ;

        $serveses =$request->serveses;
         $prise =$request->prise;
         
 

$combinedArray = array_combine($serveses, $prise);

foreach ($combinedArray as $name => $age) {
       

    
  
    
    
    $add= type_service_has::create([

                    'type' => $name,
                    'pise' => $age,
                    'iduser_prfoder' => $id,
                 
                ]);
    }
    
    
    if(!add){
        return "no";
    }
    
            return "yes";

    
    }

}
