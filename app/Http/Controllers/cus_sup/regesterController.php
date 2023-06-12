<?php

namespace App\Http\Controllers\cus_sup;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\customer_supportuserSup;
use Illuminate\Http\Request;
use App\Models\sup\users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class regesterController extends Controller
{
    public function register(Request $request)
    {
        
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'phone' => 'required|regex:/[0-9]{9}/|unique:customerSuport,phone|size:11|starts_with:01',
            'password' => 'required|min:8|max:36',
        ]);
 
 
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
         }
        // $rand =::randToken();
        // prepare inputs


        $data = users::create([
            'name' => $request->name,
            'phone' => $request->phone,
            // 'remember_token' => Hash::make($rand),
            'password' => Hash::make($request->get('password')),
        ]);


        if (!$data->save()) {
            return response()->json(['message' => trans('response.failed')],444);

        }
        $user = users::where('id',$data->id)->first();

        $response['phone'] = $request->phone;
        $response['id'] = $data->id;

        
        $user = users::where('phone',request()->phone)->first();
     
        $user->save();
        return response()->json(['data' => $response,'message' => trans('user.verification.success')],200);

    }
}
