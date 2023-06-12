<?php

namespace App\Http\Controllers\user;
// use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
// use  App\Models\User;
use App\Models\userCus\Users as User;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;


use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class regester extends Controller
{
    
    public function register(Request $request)
    {
        
        $validator =  Validator::make($request->all(), [
            // 'name' => 'required|string|min:3|max:255',
            'phone' => 'required|regex:/[0-9]{9}/|unique:users,phone|size:11|starts_with:01',
            // 'password' => 'required|alphaNum|min:8|max:36',
        ]);
 
 
        if ($validator->fails()) {
            return response()->json(["message" => "phone number is already taken "], 422);
         }
        $rand = User::randToken();
        // prepare inputs


        $data = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'remember_token' => Hash::make($rand),
            'password' => Hash::make($request->get('password')),
        ]);


        if (!$data->save()) {
            return response()->json(['message' => trans('response.failed')],444);

        }
        $user = User::where('id',$data->id)->first();

        $response['phone'] = $request->phone;
        $response['id'] = $data->id;

        
        $user = User::where('phone',request()->phone)->first();
     
        $user->save();
        return response()->json(['data' => $user],200);

    }


    public function failedValidation(Validator $validator)

    {

        // throw new HttpResponseException(response()->json([

        //     'success'   => false,

        //     'message'   => 'Validation errors',

        //     'data'      => $validator->errors()

        // ]));

    }
}




