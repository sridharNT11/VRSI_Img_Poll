<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

		public function SendOTP(){          
           try
            {
            $msg   = "";
            $status= "";
            
         	$mobile = Input::get("mobile");
         	$user = User::where("mobile", "=", $mobile)->first();

            if(isset($user) && intval($user->user_id) > 0)
            {
                $otp = Helper::randomPassword();// Helper::GenerateAndSendOTP($mobile);
                $smsContent  =  $otp.' is the OTP for your VRSI Poll Login';
                $requestID   = Helper::GenerateAndSendOTP($mobile, $smsContent,$otp);
                $user->otp = $otp;
                // $otp = Helper::GenerateAndSendOTP($mobile);
                // $user->otp = $otp;
                $datetime = new Datetime;
                $user->otp_expired_at =$datetime->modify("+10 minutes"); 
                $operationStatus = $user->save();
                $msg  ="An SMS with OTP has been sent to your mobile. It might take upto a minute to reach you.";
                $status="success";

            }
            else
            {
                $msg = "Mobile number does not exist.";
                $status="error";
            }    
             
         }catch (Exception $e) {
            Log::error('UserController - SendOTP : '.$e->getMessage());                   
            echo $e->getMessage();
         }

         return Response::json(array('msg'=>$msg,'status'=>$status)); 

            
    }
   public function VerifyOTP(){

      try
        {  
            $data = "";
            $status="";
            $msg="";        
            
        	$mobile = Input::get("mobile");
            $otp    = Input::get("otp");


              $user = User::where("mobile", "=", $mobile)->first();
              $datetime =  date("Y-m-d H:i:s");
                    

              if(isset($user) && intval($user->user_id) > 0)
              {
                if($user->otp == $otp)
                {
                    if($datetime <= $user->otp_expired_at)
                    {   
                    	Auth::login($user);
                        $status= "success";
                        $msg   = "";
                        
                    }
                    else
                    {
                        $msg   ="OTP has expired.Please generate a new one.";
                        $status="error";
                        $data  ="";
                    }
                }
                else
                {
                     $msg   = "Invalid OTP";
                     $status="error";
                     $data  ="";


                }

              }
              else
              {
                    $msg = "Mobile number does not exist.";
                    $status="error";
                    $data ="";

              }

         }
         catch (Exception $e) {
            Log::error('UserController - VerifyOTP : '.$e->getMessage());                   
            echo $e->getMessage();
         }

         return Response::json(array('msg'=>$msg,'status'=>$status)); 
     }

     public function Logout()
     {
     	
     	Auth::logout();
        return Redirect::to('/');
     }

}
