<?php

namespace App\Http\Controllers\serviseProvi;
use App\Models\servise_porvider\user_servic as User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class login extends ResponseController
{
    public function login(Request $request)
    {

        // $this->validate(request(),[
        //     'phone'    => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/',
        //     'password' => 'required|string|min:8|max:191',
        // ]);

        $user = User::where('phone',request()->phone)->first();
        if (!$user) {
            return $this->apiResponse(['message' => trans('user.login.unauthorized')], 401);
        }
//         if ($user->is_verified == '1') {
//             $response['message']   = trans('user.login.not_verified');
//             $response['is_verified'] = 0;
//             return $this->apiResponse(['data' => $response],200);
//         }
//         if ($user->status != '1') {
// //            $message['message'] = trans('login.login.suspended');
//             return $this->apiResponse(['message' => trans('user.login.suspended')],444);
//         }
//         $credentials = request(['phone', 'password']);

        // if (! $token = auth('api')->attempt($credentials)) {
        //     return $this->apiResponse(['message' => trans('user.login.unauthorized')], 401);
        // }
        // $id = auth('api')->id();

        if (Hash::check($request->password, $user->password)) {
        $id = $user->id;
        $expiresAt = Carbon::now()->addDays(30);
         $id_user= $user->id;
        // $abilities[] = 'user';
        $token = $user->createToken('token-serviseProvi' ,['serviseProvi'] ,$expiresAt,$id_user)->plainTextToken;

      $response['texRecord'] = $user->texRecord;
          $response['centerName'] = $user->centerName;
            $response['lon'] = $user->location;
              $response['phone'] = $user->phone;
                $response['LOT'] = $user->LOT;
        $response['id'] = $user->id;
        // $data['city_id'] = request()->city;
        // $data['token'] = $token;


        return response()->json(['data' => $response ,'message' => "ok"],200);
        }
        
        return response()->json(['message' => trans('user.password.not.identical')], 401);
    }

    public function logout(Request $request)
    {
        $user = $request->token;
        $fr= PersonalAccessToken::where('token',$request->token)->delete();
 
         if ( $fr) {
             return $this->apiResponse(['message' => trans('user.login.logout')],200);
         }
    }
}
