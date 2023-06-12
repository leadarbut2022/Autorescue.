<?php

namespace App\Http\Controllers\serviseProvi;

use App\Http\Controllers\Controller;
use App\Http\Resources\reprts;
use App\Models\report;
use App\Models\userCus\Users as User;

use Illuminate\Http\Request;

class getreports extends Controller
{
    public function get_all_req($id){

        $AnotherService=report::where('id_sirvice','=',$id)->where('stat' ,'=',0)->where('pymentstate','=',0)->where('deleted','=',0)->get();

        return response()->json([

            'data' =>    reprts::collection( $AnotherService)   ,
          
            
            
            ]
        );
    }


    public function acccept_req($id){

       $acc=report::where('id' , '=' ,$id)->where('deleted','=',0)->update([

            'stat' => "1"
        ]);

        if (!$acc) {

            return response()->json([
                "dat" => "try again later ",
            ]);
        }

        $iduser=report::where('id' , '=' ,$id)->first();

        $phone=User::where('id' , '=' ,$iduser->id_User)->first();





        return response()->json([

            'data' =>    $phone->phone   ,
          
            
            
            ]
        );
    }



    public function delete_req($id){

        $AnotherService=report::where('id' , '=' ,$id)->update([

            'deleted' => "1"
        ]);

            if( !$AnotherService){  

                return response()->json([
                "data" => "try again later ",
                ]
            );

            }
        return response()->json([

            'data' =>    "request has been deleted"   ,
          
            
            
            ]
        );
    }





    public function require_inuse($id){

        $AnotherService=report::where('id_sirvice' , '=' ,$id)->where('stat' , '=',1)->where('pymentstate' ,'=' ,0)->get();
    
        return response()->json([

            'data' =>   reprts::collection( $AnotherService ) ,
          
            
            
            ]
        );
    }
 

    public function complete_req($id ,$text){
        

        // $AnotherService=report::where('id' , '=' ,$id)->where('stat' , '=' ,1)->where('pymentstate' ,'=' ,0)->get();
    
        $AnotherService=report::where('id' , '=' ,$id)->where('stat' , '=' ,1)->where('pymentstate' ,'=' ,0)->update([

            'pymentstate' => 1,
            'nots_from_Service' => $text,
        ]);
      
        if (!$AnotherService) {
            
            return response()->json([

                'data' =>   "lets try again"   ,
            
                
                
                ]
            );
        }
            

        return response()->json([

            'data' =>   "ok"   ,
          
            
            
            ]
        );
    }



}
