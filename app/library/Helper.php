<?php

class Helper
{
    //http://www.ericdiviney.com/blog/how-to-register-helper-classes-in-laravel-4
    //http://stackoverflow.com/questions/14275154/convert-gmt-time-to-ist
    static function toIndianDate($string)  // truncates the string
    {
        if($string != null)
        {
            $datetime = new DateTime($string);
            $datetime->setTimezone(new DateTimeZone('Asia/Calcutta'));
            return $datetime->format('Y-m-d');
        }
        else
            return $string;
    }
  
  static function toIndianDateTime($string)  // truncates the string
    {
        if($string != null)
        {
            $datetime = new DateTime($string);
            $datetime->setTimezone(new DateTimeZone('Asia/Calcutta'));
            return $datetime->format('Y-m-d H:i:s');
        }
        else
            return $string;
    }

   static function toLocalDate($string,$timezone)  // truncates the string
    {
        if($string != null)
        {
            $datetime = new DateTime($string);
            $datetime->setTimezone(new DateTimeZone($timezone));
            return $datetime->format('Y-m-d');
        }
        else
            return $string;
    }

    static function toLocalDateTime($string,$timezone)  // truncates the string
    {
        if($string != null)
        {
            $datetime = new DateTime($string);
            $datetime->setTimezone(new DateTimeZone( trim($timezone) ));
            return $datetime->format('Y-m-d H:i:s');
        }
        else
            return $string;
    }

    static function currentIndianDate()
    {

            $datetime = new DateTime();
            $datetime->setTimezone(new DateTimeZone('Asia/Calcutta'));
            return $datetime->format('Y-m-d');

    }

    static function currentIndianTime()
    {

            $datetime = new DateTime();
            $datetime->setTimezone(new DateTimeZone('Asia/Calcutta'));
            return $datetime->format('Y-m-d H:i:s');

    }

    static function currentServerDateTime()
    {

            return date('Y-m-d H:i:s');

    }

    //Author  : karthik k
    //Date    : 2014-05-23
    //Description : To convert searilized datetime object to PHP Datetime object
    //http://stackoverflow.com/questions/16749778/php-date-format-date1365004652303-0500
    static function SearilizedDateToPHPDate($date)
    {
        try
        {
            preg_match('/[0-9]+/', $date, $matches);
            return date('Y-m-d H:i:s', $matches[0]/1000);
        }
        catch (Exception $e)
        {
            return null;
        }

    }

   //Author : karthik k
   //Date   : 2014-05-28
   //Description : To check given string is not null and also not empty
   //http://stackoverflow.com/questions/381265/better-way-to-check-variable-for-null-or-empty-string
   static function isNullOrEmpty($str)
   {
    return (!isset($str) || trim($str)==='');
   }

   //Author : karthik
   //To format DB Datetime
   static function fromDBToDDMMYYYY($string)
   {
        if($string != null && trim($string)!='')
        {
            $datetime = new DateTime($string);
            //return $datetime->format('j-F-Y');
            return $datetime->format('d/m/Y');
        }
        else
        {
            return $string;
        }

   }

  //Author : karthik
  //Example : 20-may-2015
   static function fromDBToddMMyy($string)
   {
        if($string != null && trim($string)!='')
        {
            $datetime = new DateTime($string);
            return $datetime->format('d-M-y');
        }
        else
        {
            return $string;
        }

   }
   //Author : revathi
  //Example : may-20-2015
   static function fromDBToMMddyy($string)
   {
        if($string != null && trim($string)!='')
        {
            $datetime = new DateTime($string);
            return $datetime->format('M-d-Y');
        }
        else
        {
            return $string;
        }

   }

  //Author : karthik
  //To convert datetime object to datetime string format
  static function fromDBDate($string)
   {
        $result = null;
        if($string != null && trim($string)!='')
        {
            $datetime = new DateTime($string);
            $result = $datetime->format('d/m/Y');
        }

        return $result;
   }


   //Author : karthik
   //To convert datetime string to datetime object
   //http://www.paulund.co.uk/datetime-php
   static function toDBDate($string)
   {

        $result = null;
        try
        {
          if($string != null && trim($string)!='')
            {
                $array  =   explode('/',$string);
                if(is_array($array) && count($array)>0)
                {
                  $dt = new DateTime($array[2].'-'.$array[1].'-'.$array[0]);
                  $result = $dt->format('Y-m-d H:i:s');
                }

            }
        }catch (Exception $e)
        {
          $result = null;
        }
        return $result;
   }

   //Author : karthik
   //Date   : 2014-06-16
   //To check the given string is valid datetime
   //http://stackoverflow.com/questions/5536029/php-datetime-accepting-invalid-date
   static function isValidDate($date, $format = 'd/m/Y')
   {
        if($date != null && trim($date)!='')
        {
           $dt = DateTime::createFromFormat($format, $date);
            return $dt && $dt->format($format) == $date;
        }
        else
        {
            return false;
        }
    }

    //Author : karthik k
    //Date   : 2014 - 07 - 01
    //To truncate given string
    static function trimAndTruncate($text, $length =  null)
    {
        $text = trim($text);
        $text = $length > 0 ? substr($text, 0, $length) : $text ;
        return  strlen($text) > 0 ?  $text :  null ;

    }

   //cryptography
   //Encryption
   // to append string with trailing characters as for PKCS7 padding scheme
   //http://stackoverflow.com/questions/4329260/cross-platform-php-to-c-sharp-
    static function encrypt($text)
    {
       /*$key = Config::get('app.crypt_key');
       $iv  = Config::get('app.crypt_iv');

      $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
      $padding = $block - (strlen($text) % $block);
      $text .= str_repeat(chr($padding), $padding);

      $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_CBC, $iv);
      return base64_encode($crypttext);*/
      return Crypt::encrypt($text);
    }

    //Decryption
    //http://stackoverflow.com/questions/3431950/rijndael-256-encrypt-decrypt-between-c-sharp-and-php
    //http://stackoverflow.com/questions/18908613/mcrypt-and-base64-with-php-and-c-sharp
    //http://stackoverflow.com/questions/21414479/converting-laravels-aes-256-encryptor-to-c-sharp
    static function decrypt($text)
    {
      return Crypt::decrypt($text);

/*      $key = Config::get('app.crypt_key');
      $iv  = Config::get('app.crypt_iv');
      $iv_utf = mb_convert_encoding($iv, 'UTF-8');
      return mcrypt_decrypt("rijndael-256", $key, base64_decode($text), "cbc", $iv_utf);*/
    }

    //Hashing
    //http://stackoverflow.com/questions/12804231/c-sharp-equivalent-to-hash-hmac-in-php
    static function hash($text, $key)
    {
      return strtoupper(hash_hmac("sha256", $text, $key));

    }


    //Author : Sridhar

    static function toDate($string)
    {
        if($string != null)
        {
            $datetime = new DateTime($string);
            return $datetime->format('Y-m-d');
        }
        else
            return $string;
    }


    //To convert dd/mm/yyyy hh:mm:ss format to yyyy-mm-dd hh:mm:ss
    //input :  dd/mm/yyyy hh:mm:ss 26/09/2014 12:50:50
    //output :  yyyy-mm-dd hh:mm:ss 2014-09-26 12:50:50
    static function DMYTtoYMDT($string)
    {
        if($string != null)
        {
          return date_format(date_create_from_format("d/m/Y H:i:s", $string),"Y-m-d H:i:s");
        }
        else
            return $string;
    }

    //To convert mm/dd/yyyy hh:mm:ss format to yyyy-mm-dd hh:mm:ss
    //input :  mm/dd/yyyy hh:mm:ss 09/26/2014 12:50:50
    //output :  yyyy-mm-dd hh:mm:ss 2014-09-26 12:50:50
    static function MDYTtoYMDT($string)
    {
        if($string != null)
        {
          return date_format(date_create_from_format("m/d/Y H:i:s", $string),"Y-m-d H:i:s");
        }
        else
            return $string;
    }
    //To convert dd/mm/yyyy hh:mm:ss format to yyyy-mm-dd hh:mm:ss
    //input :  dd/mm/yyyy hh:mm:ss 26/09/2014 12:50:50
    //output :  yyyy-mm-dd hh:mm:ss 2014-09-26 12:50:50
    static function DMYtoYMD($string)
    {
        if($string != null)
        {
          return date_format(date_create_from_format("d-m-Y", $string),"Y-m-d");
        }
        else
            return $string;
    }

    // To calculate age by comparing given time with system current datetime
    //input :  dd/mm/yyyy 22/09/1989
    //output : 25
    static function calcutateAge($dob)
    {

            $dob = date("Y-m-d",strtotime($dob));

            $dobObject = new DateTime($dob);
            $nowObject = new DateTime();

            $diff = $dobObject->diff($nowObject);

            return $diff->y;
    }

    //To change db connection for user
    static function ChangeDB($userId)
    {
        $user =  Cache::get('user_' . $userId);
        if($user != null)
        {
            Config::set('database.connections.mysql_user.host',$user->pt_db_hostname);
            Config::set('database.connections.mysql_user.username',$user->pt_db_username);
            Config::set('database.connections.mysql_user.password',$user->pt_db_password);
            Config::set('database.connections.mysql_user.database',$user->pt_db_name);
            DB::setDefaultConnection('mysql_user');
        }

    }

    // search array with key value
    //http://stackoverflow.com/questions/1019076/how-to-search-by-key-value-in-a-multidimensional-array-in-php
    //To find out particular item(array) inside array by passing key and its value
    static  function search($array, $key, $value)
    {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, Helper::search($subarray, $key, $value));
            }
        }

        return $results;
    }

    static function currentIndianDateDMY()
    {

            $datetime = new DateTime();
            $datetime->setTimezone(new DateTimeZone('Asia/Calcutta'));
            return $datetime->format('d/m/Y');

    }

    static function setzero($value)
    {
          if( strlen($value) == 1)
          {
            return "00".$value;
          }
          if( strlen($value) == 2)
          {
            return "0".$value;
          }

            return $value; 

    }
    //Forum - Notification to android users
    //Author - Karthik Karuna
    //Created On - 2016 09 08
    static function sendNotificationToAndroid($deviceIds, $message)
    {

      try
      {
          //$path_to_firebase_cm = 'https://gcm-http.googleapis.com/gcm/send';
          $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
          
           
          $fields   =   array(
                              'registration_ids' => $deviceIds,
                              'notification'     => array('title' => 'AIOS', 'body' => $message,'icon'=>'notify_icon','sound'=> 'default','color'=>'#032A68')
                             );
   
   
          $headers  =   array(
                              'Authorization:key=AIzaSyBMwq8PwpBue9Jdv-Q8fK2J-_646GTSU9I',
                              'Content-Type:application/json'
                              );      
          $ch = curl_init();
   
          curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm); 
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      
          $result = curl_exec($ch);
         
          curl_close($ch);
	  return $result;
      }
      catch (Exception $e)
      {
          Log::error("Helper=>sendNotificationToAndroid".$e->getMessage());
      }

      
    }
    //Forum - Notification to android users
    //Author - Karthik Karuna
    //Created On - 2016 09 08
    static function sendNotificationToIOS($deviceIds, $message)
    {
      try
      {
        if(isset($deviceIds) && count($deviceIds) > 0 )
        {
          foreach ($deviceIds as $key => $deviceID)
          {
            PushNotification::app('appIOSprod')
                            ->to($deviceID)
                            ->send($message);                          
          }            
        }
      }
      catch (Exception $e)
      {
          Log::error("Helper=>sendNotificationToIOS".$e->getMessage());
      }
    }
      //Forum - Notification tp mobile devices
    //Author - Karthik Karuna    
    //Created On - 2017 01 18
    //Update by - sridhar
    //updated On - 2017 12 28
    //Parameters
    /*
      $obj2 = new stdClass();
      $obj2->user_id   = 4250;
      $obj2->message   = "welcome";    
      $usersMessages = [$obj2];

      $title = "welcome";
    */
    static function sendNotifications($usersMessages, $title)
    {
      try
      {     
        
        $userIDS = [];
        $ums = [];
        if(isset($usersMessages) && count($usersMessages) > 0)
        {
            foreach ($usersMessages as $key => $um)
            {
                array_push($userIDS, $um->user_id);
                $ums[$um->user_id] =$um;
            }
        }
        $userIDS = array_unique($userIDS);

        $userdevices = DB::table("user_devices as ud")->whereIn('ud.user_id', $userIDS)->whereNull("ud.deleted_at")->get();

        $iosDevicesMessages = [];
        $androidDevicesMessages = [];
        foreach ($userdevices as $key1 => $ud)
        {    
           if(isset($ums[$ud->user_id]))
           {
            $um =$ums[$ud->user_id];
            //foreach ($usersMessages as $key2 => $um)
            //{   
                /* update by sridhar on 28.Dec.2017 */
                // if($ud->user_id == $um->user_id && isset($ud->device_id) && strcasecmp($ud->platform, 'IOS') == 0 )
                // {
                //     $obj = new stdClass();
                //     $obj->user_id   = $ud->user_id;
                //     $obj->device_id = $ud->device_id;
                //     $obj->message   = Helper::trimAndTruncate($um->message,250);
                //     array_push($iosDevicesMessages, $obj);
                // }
                // else if($ud->user_id == $um->user_id && isset($ud->device_id) && strcasecmp($ud->platform, 'ANDROID') == 0 )
                // {
                if($ud->user_id == $um->user_id)
                {
                    $obj = new stdClass();
                    $obj->user_id   = $ud->user_id;
                    $obj->device_id = $ud->device_id;
                    $obj->message   = Helper::trimAndTruncate($um->message,250);
                    array_push($androidDevicesMessages, $obj);
                }
                //}
            //}
            }
        }
        
        //Android Notifications
        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
        if(isset($androidDevicesMessages) && count($androidDevicesMessages) > 0)
        {

            foreach ($androidDevicesMessages as $key => $adm)
            {

                $fields   =   array(
                                  'registration_ids' => [$adm->device_id],
                                  'notification'     => array('title' => $title, 'body' => $adm->message,'icon'=>'notify_icon','sound'=> 'default','color'=>'#032A68'),
                                  'data' => array('message' => 'good message')
                                 );


                $headers  =   array(
                                  'Authorization:key=AIzaSyBMwq8PwpBue9Jdv-Q8fK2J-_646GTSU9I',
                                  'Content-Type:application/json'
                                  );      
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm); 
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

                $result = curl_exec($ch);
                

                curl_close($ch);    
            }
        }

	
        //IOS Notifications
        if(isset($iosDevicesMessages) && count($iosDevicesMessages) > 0)
        {

            foreach ($iosDevicesMessages as $key => $idm)
            {
                PushNotification::app('appIOSprod')
                                ->to($idm->device_id)
                                ->send($idm->message);
            }
        }

      }
      catch (Exception $e)
      {
          Log::error("Helper=>sendNotifications".$e->getMessage());
      }
    }


    static function setIntOrNUll($value)
    {
          if(is_numeric($value))
          {
            return $value;
          }          
          else            
            return null; 
    }
 
    static function time_formatValidation($time)
    {
      return  preg_match('#^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#', $time);
         
    }

   //  static function GenerateAndSendOTP($mobile,$msg,$otp)
   // {
      
   //     if(isset($mobile))
   //    {
   //      $sender = 'AIOSRG';
   //      $Authkey = '93919A5FWuR1MX9n560b8975';
   //      //$mobile =  "91".$mnumber;
   //      //$route = 4;
   //      $country = 0;
   //      $msg = urlencode($msg);

   //      $postData = array(
   //          'authkey' => $Authkey,
   //          'mobile' => $mobile,
   //          'message' => $msg,
   //          'sender' => $sender,
   //          'otp' =>$otp,
   //      );

   //      $url="https://control.msg91.com/api/sendotp.php";

   //      $ch = curl_init();
   //      curl_setopt_array($ch, array(
   //          CURLOPT_URL => $url,
   //          CURLOPT_RETURNTRANSFER => true,
   //          CURLOPT_POST => true,
   //          CURLOPT_POSTFIELDS =>  $postData
   //          //,CURLOPT_FOLLOWLOCATION => true
   //      ));
        
        
   //      //Ignore SSL certificate verification
   //      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   //      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        
   //      //get response
   //      $output = curl_exec($ch);

   //      curl_close($ch);

   //    }
   //  }    

     static function GenerateAndSendOTP($mobile,$msg,$otp)
    {
      
       if(isset($mobile))
      {
        $sender   = CustomClass::$Sender;
        $Authkey =  CustomClass::$Authkey;
        //$mobile =  "91".$mobile;
        $route = 4;
        $country = 91;
        $msg = urlencode($msg);

        $postData = array(
          'authkey' => $Authkey,
          'mobiles' => $mobile,
          'message' => $msg,
          'sender' => $sender,
          'route' => $route,
          'country' => $country
      );

      $url="http://api.msg91.com/api/sendhttp.php";


        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS =>  $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));
        
        
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        
        //get response
        $output = curl_exec($ch);

        curl_close($ch);

      }
    }    

     static function betweenDates($start_date,$end_date)
    {
                $day = 86400;  
                $format='Y/m/d';
                $days = array(''=>'--Select--');  
                $sTime = strtotime($start_date); // Start as time  
                $eTime = strtotime($end_date); // End as time  
                $numDays = round(($eTime - $sTime) / $day) + 1;  
                for ($d = 0; $d < $numDays; $d++) {  
                  $dt_value= date($format, ($sTime + ($d * $day)));
                  $dt_text= date('d/m/Y', ($sTime + ($d * $day)));
                  $days[$dt_text] = $dt_text;
    
                  }     // exit();
      return $days;

    }

  

   //Author : Karthik Karuna
  //Purpose : To generate random password contains 4 characters
  //http://stackoverflow.com/questions/6101956/generating-a-random-password-in-php
  static function randomPassword() 
  {
    $alphabet = '1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 4; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }





//Author : sridhar
   //To convert datetime string to datetime object
   //http://www.paulund.co.uk/datetime-php
   static function toDBDatetime($string)
   {

        $result = null;
        try
        {
          if($string != null && trim($string)!='')
            {
                $arr =   explode(' ',$string);                                

                $arr_dt  =   explode('/',$arr[0]);                                

                if(is_array($arr_dt) && count($arr_dt)>0)
                {
                  $dt = new DateTime($arr_dt[2].'-'.$arr_dt[1].'-'.$arr_dt[0]. ' ' .  $arr[1]);
                  $result = $dt->format('Y-m-d H:i:s');
                }
            }
        }catch (Exception $e)
        {
          $result = null;
        }
        return $result;
   }


   //Author : sridhar
   //To convert datetime string to datetime object
   //http://www.paulund.co.uk/datetime-php
   static function fromDBDateTime($string)
   {
        $result = null;
        if($string != null && trim($string)!='')
        {
            $datetime = new DateTime($string);
            $result = $datetime->format('d/m/Y h:i A');
        }

        return $result;
   }

   /*Varshini - 09.01.2018*/
   /*To spilt the numeric value from alphanumeric value*/
    static function tospiltNumericvalue($string)
    {
        if(empty($string))
       {
         return 9999999999;
       }
        $str = $string;
        $arr = array();
        $sub = '';
        for ($i = 0; $i < strlen($str); $i++) 
        { 
            if (is_numeric($str[$i])) 
            {
                $sub .= $str[$i];
                continue;
            } 
            else 
            {
                if ($sub) 
                {
                    array_push($arr, $sub);
                    $sub = '';
                }
            }
        }

        if ($sub) 
        {
            array_push($arr, $sub); 
        }

        return $arr[0];
    }

 /*
    sridhar on 17 Jan 2018 2.57 PM
   */
   static function smsBulk($arrObjects, $campaign = null)
    {

      $operationStatus = false;
      if(CustomClass::$isEnableSMS)
      {
      
        $sender   = CustomClass::$sender;
        $Authkey  =  CustomClass::$Authkey;
        $url      = 'http://api.msg91.com/api/postsms.php';
        $country  = '91' ;

        if(is_null($campaign))
          $campaign = 'BULK SMS';


        //Formatting input to post to msg91 site
        $dataPrefix = '';
        $dataSuffix = '';
        $xml =  [] ;
        
        if(isset($arrObjects) && count($arrObjects) > 0)
        {
          $dataPrefix = '<MESSAGE>
                            <AUTHKEY>'.$Authkey.'</AUTHKEY>
                            <ROUTE>template</ROUTE>
                            <CAMPAIGN>'.$campaign.'</CAMPAIGN>
                            <COUNTRY>'.$country.'</COUNTRY>
                            <SENDER>'.$sender.'</SENDER>';

                            
          array_push($xml, $dataPrefix);
          
          foreach ($arrObjects as $key => $obj)
          {
            if(CustomClass::$isEnableTestSMS)
            {
              $str = '';
              $str .='<SMS TEXT="'.$obj->msg.'">';
              foreach (CustomClass::$isTestSMSMobiles as $key => $value) {
                $str .='<ADDRESS TO="'.  $value.'"></ADDRESS>';  
              }
              $str .='</SMS>';
              array_push($xml,$str);              
            }
            else
            {
              if($obj->mobileno !=null && !empty($obj->mobileno))
              {
                array_push($xml,'<SMS TEXT="'.$obj->msg.'">
                                <ADDRESS TO="'.  $obj->mobileno.'"></ADDRESS>
                              </SMS>'
                      );  
              }
              
            }
            
          }
            
          $dataSuffix = '</MESSAGE>';
          array_push($xml, $dataSuffix);                       
        }

        $data = implode('', $xml);
        
        try
        {
          if(isset($data) && strlen($data) > 0)
          {
            $param = 'data=' .urlencode($data);
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_POST, 1);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $param);
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt( $ch, CURLOPT_HEADER, 0);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec( $ch );
            Log::info($response);
            curl_close($ch);  

            if(strlen($response) == 24)// return 24 characters of alphanumeric string in case of success return
              $operationStatus = true ;
          }
        }
        catch (Exception $e)
        {
          Log::error("Helper=>smsBulk".$e->getMessage());
          $operationStatus = false;
        }
      }

      return $operationStatus;
    }



   /*
    sridhar on 18 Jan 2018 3.28 PM
    Msg91 v2 bulk sms 
    https://docs.msg91.com/collection/msg91-api-integration/5/send-sms-v2/TZ2IXQHS 
   */
   static function smsBulk_v2($arrObjects, $campaign = null)
    {

      $operationStatus = false;
      if(CustomClass::$isEnableSMS)
      {
      
        $sender   = CustomClass::$sender;
        $Authkey  =  CustomClass::$Authkey;
        $url      = 'http://api.msg91.com/api/v2/sendsms';
        $country  = '91' ;
        $route = 4;

        if(is_null($campaign))
          $campaign = 'BULK SMS';

        if(CustomClass::$isEnableTestSMS)
        {
          foreach ($arrObjects as $key => $value) {
            $arrObjects[$key]->to = CustomClass::$isTestSMSMobiles;
          }
        }

        $obj = new stdClass();  
        $obj->sender = $sender;
        $obj->route = $route;
        $obj->country = $country;
        $obj->campaign = $campaign;
        $obj->sms = $arrObjects;

        $data = json_encode($obj);        
        try
        {
          if(isset($data) && strlen($data) > 0)
          {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $data,
              CURLOPT_SSL_VERIFYHOST => 0,
              CURLOPT_SSL_VERIFYPEER => 0,
              CURLOPT_HTTPHEADER => array(
                "authkey: ". $Authkey,
                "content-type: application/json"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            if ($err) {
              Log::info("cURL Error #:" . $err);
              $operationStatus =false;
            } else {
              Log::info($response);
              $response = json_decode($response);
              if($response->type == "success")// return 24 characters of alphanumeric string in case of success return
                $operationStatus = true ;              
            }
          }
        }
        catch (Exception $e)
        {
          Log::error("Helper=>smsBulk v2".$e->getMessage());
          $operationStatus = false;
        }
      }

      return $operationStatus;
    }


  /*
    sridhar on 10 Feb 2018 2:31 PM
    
    https://stackoverflow.com/questions/44078090/how-do-i-create-merge-tags-in-a-php-mysql-app
  */
  static function merge_tag($str_val,$tag_values)
  {
    $search = array();
    $replace = array();
    foreach ($tag_values AS $index => $value)
    {
        $search[] = "*|" . $index . "|*"; // Wrapping the text in "*|...|*}"
        $replace[] = $value;
    }

    // Do the replacement
    return str_replace($search, $replace, $str_val);
  }

  

   

  }
   
   
  // }
?>

