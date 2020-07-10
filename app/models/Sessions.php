<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Sessions extends Eloquent {

    

    protected $table = 'image_poll_sessions';
    protected $primaryKey='session_id';

    
    public Static function getSession()
    {
        try
        {      
            $session_key = Session::get('session_key',null);
            $session_id = Session::get('session_id',null);
             
            // $is_random = Session::get('is_random',null);
            if(isset($session_key) && intval($session_id)>0)
            {   
                $session = Sessions::where('session_key',$session_key)->where('session_id',$session_id)->frist();
            }
            else
            {
                //$session = Sessions::where('session_active',1)->first();

                $session = Sessions::where('session_start','<=', date('Y-m-d H:i:s'))->where('session_end','>=', date('Y-m-d H:i:s'))->where('session_active','=',1)->first();
            }
               

           return $session;

        } catch (Exception $e)
        {
            Log::error('Models: Session  -> getSession '.$e->getMessage());
            return null;
        }
    }
  
}