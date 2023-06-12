<?php

use App\Http\Controllers\cus_sup\loginController;
use App\Http\Controllers\cus_sup\regesterController;
use App\Http\Controllers\serviseProvi\getreports;

use App\Http\Controllers\user;
use App\Http\Controllers\user\login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\regester;



use App\Http\Controllers\serviseProvi\login as sevLogin;
use App\Http\Controllers\serviseProvi\regester as sevRegester;
use App\Http\Controllers\user\servesesconttroler;
use App\Http\Controllers\wallet\get;
use App\Http\Controllers\wallet\post;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('app/v1/')->group(function () {
    
    
Route::post('login',[login::class ,'login']);
Route::post('register',[regester::class ,'register']);


// 'middleware' => 'auth:sanctum']
Route::group(['prefix' => 'user', ], function () {
    Route::prefix('user')->group(function () {
      
        Route::post('logout',[login::class ,'logout']);
        Route::post('verify','user\VerifyController@verify');
        Route::post('resend_verification_code','user\VerifyController@resend');
    
        Route::prefix('password')->group(function () {
            Route::post('forget','user\ResetPasswordController@sendCode');
            Route::post('check','user\ResetPasswordController@check');
            Route::post('reset','user\ResetPasswordController@resetPassword');
        });

        Route::get('Home',[servesesconttroler::class ,'servioses']);
        Route::get('usergetserv/{id}',[servesesconttroler::class ,'usergetserv']);
        Route::post('sendReport',[servesesconttroler::class ,'user_nedservice']);
        
        
        
                Route::get('carent_req/{id}',[servesesconttroler::class ,'carent_req']);
        Route::get('service_provider_Phone/{id}',[servesesconttroler::class ,'service_provider_Phone']);
        Route::get('check_get/{id}',[servesesconttroler::class ,'check_get']);
        Route::post('chek_at',[servesesconttroler::class ,'chek_aot']);
                Route::post('send_mssg',[servesesconttroler::class ,'send_mssg']);
        Route::get('get_mssg/{id}',[servesesconttroler::class ,'get_mssg']);
        


Route::post('Add_money',[post::class,'Add_money']);
Route::get('getmo/{id}',[get::class,'getmo']);
        
    
    });
});





// Route::middleware('auth:api')->get('/userApth', function (Request $request) {
//     return $request->user();
// });


  
    
    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });



Route::prefix('service_provider')->group(function () {
    Route::post('register',[sevRegester::class ,'register']);
    Route::post('login',[sevLogin::class ,'login']);


    Route::post('addtype_prise',[sevRegester::class ,'addtype_prise']);


    


    Route::get('get_all_req/{id}',[getreports::class ,'get_all_req']);
    Route::get('acccept_req/{id}',[getreports::class ,'acccept_req']);
    Route::get('delete_req/{id}',[getreports::class ,'delete_req']);

    Route::get('req_inuse/{id}',[getreports::class ,'require_inuse']);
    Route::get('complete_req/{id}/{text}',[getreports::class ,'complete_req']);



    


    Route::get('get_all_req/{id}',[getreports::class ,'get_all_req']);
    Route::get('acccept_req/{id}',[getreports::class ,'acccept_req']);
    Route::get('delete_req/{id}',[getreports::class ,'delete_req']);
    
       Route::get('req_inuse/{id}',[getreports::class ,'require_inuse']);
    Route::get('complete_req/{id}/{text}',[getreports::class ,'complete_req']);
    

    Route::post('verify','user\VerifyController@verify');
    Route::post('resend_verification_code','user\VerifyController@resend');

    Route::prefix('password')->group(function () {
        Route::post('forget','user\ResetPasswordController@sendCode');
        Route::post('check','user\ResetPasswordController@check');
        Route::post('reset','user\ResetPasswordController@resetPassword');
    });

});






Route::prefix('customer_support')->group(function () {
    Route::post('register',[regesterController::class ,'register']);
    Route::post('login',[loginController::class ,'login']);
    Route::post('verify','user\VerifyController@verify');
    Route::post('resend_verification_code','user\VerifyController@resend');

    Route::prefix('password')->group(function () {
        Route::post('forget','user\ResetPasswordController@sendCode');
        Route::post('check','user\ResetPasswordController@check');
        Route::post('reset','user\ResetPasswordController@resetPassword');
    });

});


});