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


    public function Login()
    {

        try {

            if(Auth::Check())
            {
              return Redirect::to('/');
            }
            else
            {
                return View::make('login');
            }
             
         } catch (Exception $e) {
             Log::error('UserController - getProfile : '.$e->getMessage());
         }
        
    }

    public function SendOTP()
    {
        $msg   = "";
        $status= "";
        $user_id = 0;
        try {
            $email  = Input::get("email");
            $mobile = Input::get("mobile");

            $user = null;
            if(isset($email) || isset($mobile))
            {
                if(isset($email) && !empty($email))
                {
                    $email_user = User::where('email',$email)->first();
                }
                if(isset($mobile) && !empty($mobile))
                {
                    $mobile_user = User::where('mobile',$mobile)->first();
                }
                
                if(isset($email_user) && isset($mobile_user))
                {
                    if($email_user->user_id == $mobile_user->user_id)
                    {
                        $user = $email_user;
                    } 
                    else
                    {
                        $msg = "Email Id and Mobile Number are diffrent accounts";
                        $status="error";
                    }
                }
                else if(isset($email_user))
                {
                    $user = $email_user;
                }
                else if(isset($mobile_user))
                {
                    $user = $mobile_user;
                }

                if(!isset($user))
                {
                    // echo "user not in";
                    // exit();
                    $user = new user();
                    $user->mobile = $mobile;
                    $user->email = $email;
                    $user->save();
                }

                if(isset($user) && intval($user->user_id) > 0)
                {

                    $user_id = $user->user_id;
                    if(isset($user->otp))
                    {
                        $otp = $user->otp;
                    }
                    else
                    {
                        $otp = Helper::randomPassword();// Helper::GenerateAndSendOTP($mobile);    
                    }
                    $datetime = new Datetime;
                    $otp_expired_at = $datetime->modify("+10 minutes"); 
                    $otp_expired_at_text = $otp_expired_at->format('d/m/Y h:i A');
                    $content  =  $otp." is the OTP for your VRSI Poll Login. This OTP is valid until $otp_expired_at_text";


                    //SMS
                    if(isset($user->mobile) && !empty($user->mobile))
                    {
                        $requestID   = Helper::GenerateAndSendOTP($user->mobile, $content,$otp);
                    }

                    //Mail
                    if(isset($user->email) && !empty($user->email))
                    {
                        try {
                            $mandrill =  new Mandrill(CustomClass::$Mandrill_Key);
                            $html = View::make('emails/otp')->with('u',$user)->with('OTPContent',$content)->render();
                            $subject = 'OTP from VRSI Poll Login, valid until '.$otp_expired_at_text;
                            $message = array(
                                        'html' => $html,
                                        'text' => '',
                                        'subject' => $subject,
                                        'from_email' => 'support@VRSI.in',
                                        'from_name' => 'VRSI Poll',
                                        'to' => array(
                                            array(
                                                'email' => $user->email,
                                                'name' => '',
                                                'type' => 'to'
                                            )
                                        ),
                                        // 'headers' => array('Reply-To' => 'sridharan.r@numerotec.com'),
                                        // 'bcc_address' => 'sridharan.r@numerotec.com',
                                     
                                    );
                            $async = true;
                            $ip_pool = '';
                            $send_at = '';
                            $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);  

                            // $mailContent = array( "u" => $user, "OTPContent" => $content);
                            // Mail::send('emails.otp', $mailContent, function($message) use ($email,$otp_expired_at_text) {
                            //         $message->to($user->email)->subject();
                            //     });
                        } catch (Exception $e) {
                            Log::error('UserController - SendOTP - Mail : '.$e->getMessage());                   
                        }    
                    }

                    $user->otp = $otp;
                    $user->otp_expired_at = $otp_expired_at;
                    $operationStatus = $user->save();


                    if((isset($user->mobile) && !empty($user->mobile)) && (isset($user->email) && !empty($user->email)))
                    {
                        $msg  ="An OTP has been sent to your mobile and email. It might take upto a minute to reach you. The OTP is valid for 10 mins.";
                    }
                    elseif(isset($user->email) && !empty($user->email))
                    {
                        $msg  ="An OTP has been sent to your email. It might take upto a minute to reach you. The OTP is valid for 10 mins.";
                    }
                    elseif(isset($user->mobile) && !empty($user->mobile))
                    {
                        $msg  ="An OTP has been sent to your mobile. It might take upto a minute to reach you. The OTP is valid for 10 mins.";    
                    }
                    
                    $status="success";
                }

            }
            else
            {
                $msg = "Please Enter Email Id Or Mobile Number";
                $status="error";
            }

            
        } catch (Exception $e) {
            Log::error('UserController - SendOTP : '.$e->getMessage());                   
            echo $e->getMessage();
        }
        return Response::json(array('msg'=>$msg,'status'=>$status,'user_id' => $user_id)); 
    }


		// public function SendOTP(){          
  //          try
  //           {
  //           $msg   = "";
  //           $status= "";
            
  //        	$mobile = Input::get("mobile");
  //        	$user = User::where("mobile", "=", $mobile)->first();

  //           if(isset($user) && intval($user->user_id) > 0)
  //           {
  //               $otp = Helper::randomPassword();// Helper::GenerateAndSendOTP($mobile);
  //               $smsContent  =  $otp.' is the OTP for your VRSI Poll Login';
  //               $requestID   = Helper::GenerateAndSendOTP($mobile, $smsContent,$otp);
  //               $user->otp = $otp;
  //               // $otp = Helper::GenerateAndSendOTP($mobile);
  //               // $user->otp = $otp;
  //               $datetime = new Datetime;
  //               $user->otp_expired_at =$datetime->modify("+10 minutes"); 
  //               $operationStatus = $user->save();
  //               $msg  ="An SMS with OTP has been sent to your mobile. It might take upto a minute to reach you. The OTP is valid for 10 mins.";
  //               $status="success";

  //           }
  //           else
  //           {
  //               $msg = "Mobile number does not exist.";
  //               $status="error";
  //           }    
             
  //        }catch (Exception $e) {
  //           Log::error('UserController - SendOTP : '.$e->getMessage());                   
  //           echo $e->getMessage();
  //        }

  //        return Response::json(array('msg'=>$msg,'status'=>$status)); 

            
  //   }
   public function VerifyOTP(){

      try
        {  
            $data = "";
            $status="";
            $msg="";        
            
        	$user_id = Input::get("user_id");
            $otp    = Input::get("otp");


              $user = User::find($user_id);
              $datetime =  date("Y-m-d H:i:s");
                    

              if(isset($user) && intval($user->user_id) > 0)
              {
                if($user->otp == $otp)
                {
                    if($datetime <= $user->otp_expired_at)
                    {   
                        
                        $session = Sessions::getSession();
            			if(isset($session))
            			{
            			    $userlog = new UserLog();
                            $userlog->user_id = $user_id;
                            $userlog->session_id = $session->session_id;
                            $userlog->save();
            			}
                        
                        
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



    public function getProfile()
     {
        try {

            if(Auth::Check())
            {
                $user =User::find(Auth::User()->user_id);
                return View::make('profile')->with('user',$user);
            }
            else
            {
                return Redirect::to('/');
            }
             
         } catch (Exception $e) {
             Log::error('UserController - getProfile : '.$e->getMessage());
         }
     } 


    public function postProfile()
    {
        try {

            if(Auth::Check())
            {
                $user =User::find(Auth::User()->user_id);

                $rules = array(
                'prefix'         => 'required',
                'full_name'         => 'required',
                // 'mobile'       => 'required|alphaNum|max:15',
                'mobile'       => 'required|alphaNum|max:15|unique:image_poll_users,mobile,'.$user->user_id.',user_id,profile_updated_at,NOT_NULL',
                'email'        => 'required|email|unique:image_poll_users,email,'.$user->user_id.',user_id,profile_updated_at,NOT_NULL',
                'city'         => 'required',   
                'state'        => 'required',
                'affiliation'  => 'required',
    //          'dob'          => 'required|date_format:d/m/Y',
    //          'is_pg_student'        => 'required',
                );
                      
                $validator = Validator::make(Input::all(), $rules);
                      
                if ($validator->fails())
                {
                    // var_dump($validator->errors());
                    // exit();
                    // return Redirect::to('profile/'.Helper::encrypt($user->user_id))->withInput()->withErrors($validator->errors());
                    return Redirect::to("profile")->withInput()->withErrors($validator->errors());
                }
                else
                {
                    $user->prefix = Input::get('prefix');
                    $user->full_name = Input::get('full_name');
                    $user->email = Input::get('email');
                    $user->mobile = Input::get('mobile');
                    $user->city = Input::get('city');
                    $user->state = Input::get('state');
                    $user->affiliation = Input::get('affiliation');
                    $user->profile_updated_at = date('Y-m-d H:i:s');
                    $user->save();


                    //delete incompleted duplicate email and mobile
                    User::where('email',$user->email)->whereNull('profile_updated_at')->delete();
                    User::where('mobile',$user->mobile)->whereNull('profile_updated_at')->delete();
                    
                    return Redirect::to('/');
                }
            }
            else
            {
                $msg = "Your session has expired. Please log-in again.<a href=". url('/login') ." >Click here to go to Login</a>";
                return Redirect::to('/')->wiht('msgError'.$msg);
            }
             
         } catch (Exception $e) {
             Log::error('UserController - getProfile : '.$e->getMessage());
         }
    } 

     public function Logout()
     {
     	
     	Auth::logout();
        return Redirect::to('/login');
     }

}
