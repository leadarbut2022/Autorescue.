<?php

namespace App\Http\Controllers\user;
// use App\Models\servise_porvider\user_servic ;
use App\Models\userCus\Users as User;
use App\Models\servise_porvider\user_servic ;
use App\Http\Controllers\Controller;
use App\Http\Controllers\cus_sup\resetpassController;
use App\Http\Resources\Ponts_serv;
use App\Http\Resources\reprts;
use App\Models\pymentation;
use App\Models\report;

use App\Http\Resources\mmsg_cus_suport as ResourcesMmsg_cus_suport;
use App\Models\mmsg_cus_suport;

// use App\Models\servise_porvider\user_servic as User;
use App\Http\Resources\servise_profider;

// use App\Models\servise_porvider\user_servic;
use App\Models\type_service_has;
use App\Models\userCus\servesesconttroler as UserCusServesesconttroler;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class servesesconttroler extends Controller
{
    public function servioses(Request $request)
    {
       $Emergency=UserCusServesesconttroler::select('id', 'name' ,'type')->where('type','=','Emergency')->get();
       $Maintenance=UserCusServesesconttroler::select('id', 'name' ,'type')->where('type','=','Maintenance')->get();
       $AnotherService=UserCusServesesconttroler::select('id', 'name' ,'type')->where('type','=','Another Service')->get();
       $location=user_servic::select('centerName', 'location', 'LOT' )->get();
    //    $users = DB::table('sevices')->select('id','name', 'type')->get();
    return response()->json([
        'Emergency' =>    $Emergency   ,
        'Maintenance' =>    $Maintenance  ,
        'AnotherService' =>  $AnotherService    ,
        'location' =>  $location    ,
        
        
        ]
    );
    

   
    }

    public function usergetserv($type)
    {
        $typeServise =$type;
        
        // $AnotherService=user_servic::with('orders')->get();
        $AnotherService=user_servic::where('type_serv' , '=' ,$typeServise)->limit(10)->get();
        
        // $dtat['texRecord']=$AnotherService->texRecord;
        // $dtat['centerName']=$AnotherService->centerName;
        // $dtat['Regestrion_number']=$AnotherService->Regestrion_number;
        // $dtat['phone']=$AnotherService->phone ;
        // $dtat['long']=$AnotherService->location ;
        // $dtat['LOT']=$AnotherService->LOT ;
        // $dtat['type_serv']=$AnotherService->type_serv ;
        //  $dtat['prise']=$AnotherService->prise ;

        return response()->json([

            'data' =>  servise_profider::collection($AnotherService )   ,
          
            
            
            ]
        );

    }
    public function user_nedservice(Request $request)
    {
  
       $iduser =  intval($request->idUser);
    //   return  $iduser;
       $idservics = $request->ID_services_providers;
       $report = $request->report;
     
    //    $iduser_=report::where('id' , '=' ,$iduser)->first();
    //    $d_users = intval($iduser_->id_User);
    $idserv= intval($request->ID_services_providers);
            // $userser = user_servic::select('type_serv')->where('id','=',$idserv)->first();
 $userser=user_servic::where('id','=',$idserv)->first();
       $phone=User::select('phone')->where('id','=',$iduser)->first();
// return  $phone;
            $add=   report::create([
            
                'id_User' => $iduser,
                'id_sirvice' => $idservics,
                'text_' => $report,
                'phone' => $phone->phone,
                'prise' => $request->prise,
                'type_serv' =>$userser->type_serv,
                'phoneserv' =>$userser->phone,
                 
            
            ]);


        if (!$add) {

            $sat='no';
            return response()->json([

                'data' =>     $sat  ,
                
                ]
            );

        }else {
            $sat='yes';
        return response()->json([

            'data' =>     $sat  ,
            
            ]
        );
        
        }


    }

    public function carent_req($id)
    {


     $AnotherService=report::where('id_User', '=' ,$id)->where('stat' , '=' ,1)->where('pymentstate' ,'=' ,0)->where('pyments_user' ,'=' ,0)->get();


        return response()->json([

            'data' =>  reprts::collection( $AnotherService)   ,
          
            
            
            ]
        );

    }
    

    public function service_provider_Phone($id)
    {


     $AnotherService=user_servic::select('phone')->where('id' , '=' ,$id)->get();


        return response()->json([

            'data' =>    $AnotherService   ,
          
            
            
            ]
        );

    }
    

    public function check_get($id)
    {
        // $typeServise =$id;
        
        // $AnotherService=user_servic::with('orders')->get();
        // $AnotherService=type_service_has::where('type' , 'like' ,$typeServise)->with('user')->get();
        $AnotherService=report::where('id_User' , '=' ,$id)->where('stat' , '=' ,1)->where('pymentstate' ,'=' ,1)->where('pyments_user' ,'=' ,0)->get();


        return response()->json([

            'data' =>    reprts::collection(  $AnotherService )  ,
          
            
            
            ]
        );

    }


    public function chek_aot(Request $request)
    {
       $id=$request->id;
       $id_req=$request->id_req;

        $AnotherService=report::where('id_User' , '=' ,$id)->where('stat' , '=' ,1)->where('pymentstate' ,'=' ,1)->where('pyments_user' ,'=' ,0)->sum('prise');
        // return $AnotherService;

        $prise_on_acc =    pymentation::where('id_user', '=', $id)->first();
        $mo =   intval(@$prise_on_acc ->money );
        if ($AnotherService > @$mo) {

         return 'Your current balance is not allowed';
        }elseif ($AnotherService < $mo) {
         $new_mo = $mo - $AnotherService;
         $d_users_req = intval($id_req);

         pymentation::where('id_user','=',$id) ->update([
        'money' => $new_mo
         ]);
         
            report::where('id_User','=',$id) ->where('id','=',$d_users_req)->update([
        'pyments_user' => 1
         ]);


        return "ok";
        }
         return "no";
    
    }

  public function send_mssg(Request $request){

        $id =$request->id;
        $text =$request->text;
    

$add=   mmsg_cus_suport::create([
            
                'id_user' => $id,
                'textuse' => $text,
              
            ]);


        if (!$add) {

            $sat='no';
            return response()->json([

                'stat' =>     $sat  ,
                
                ]
            );

        }else {
            $sat='yes';
        return response()->json([

            'stat' =>     $sat  ,
            
            ]
        );
    }

    }

    public function get_mssg($id){


    $text =mmsg_cus_suport::where('id_user',$id)->get();


    return response()->json([

        'data' =>     ResourcesMmsg_cus_suport::collection($text)  ,
        
        ]
    );


        }

}
