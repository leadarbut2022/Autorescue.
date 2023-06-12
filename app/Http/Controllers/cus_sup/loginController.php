<?php

namespace App\Http\Controllers\cus_sup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\sup\users as User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class loginController extends Controller
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
        if ($user->is_verified == '1') {
            $response['message']   = trans('user.login.not_verified');
            $response['is_verified'] = 0;
            return $this->apiResponse(['data' => $response],200);
        }
        if ($user->status != '1') {

            
            return $this->apiResponse(['message' => trans('user.login.suspended')],444);
        }

        if (Hash::check($request->password, $user->password)) {
        $credentials = request(['phone', 'password']);

        Auth::attempt($credentials);
        // $id = auth('api')->id();
        $id = $user->id;
        $user = User::find(1);
        $expiresAt = Carbon::now()->addDays(30);
        $id_user= $user->id;

        $abilities[] = 'user';
         $token = $user->createToken('token-name' ,$abilities ,$expiresAt,$id_user)->plainTextToken;
        
        
        $data['id'] = $id;
        $data['username'] = $user->name;
        $data ['phone'] = $user->phone;
        $data['token'] = $token;


















   
        return response()->json(['data' => $data, 'message' => trans('user.login.login_success')]);
        }


        return $this->apiResponse(['message' => trans('user.password.noف.identical')], 401);
    }


    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        Auth::guard('web')->logout();
        return $this->apiResponse(['message' => trans('user.login.logout')],200);
    }
}
