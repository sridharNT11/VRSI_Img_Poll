<?php

class PollController extends BaseController {


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

	public function index($session_id= null,$session_key=null)
	{
	    
	    if(isset($session_key))
	    {
	        Session::put('session_key', $session_key);
	        Session::put('session_id', $session_id);
	    }
	    else
	    {
	        Session::forget('session_key');
	        Session::forget('session_id');
	    }
	    
		return View::make('index');
	}

	public function getPoll($image_poll_id=null)
	{


		$session = Sessions::getSession();
		if(isset($session))
		{

			if($image_poll_id==null)
			{
				$image_poll=ImagePoll::orderBy('order_no')->where('session_id',$session->session_id)->first();					
				$image_poll_id= $image_poll->image_poll_id;
			}
			else{

				$image_poll 	=  ImagePoll::find($image_poll_id);
				if(isset($image_poll))
				{
					$pre_order_no =  $pre_image_poll->order_no;
				}
				else
				{
					Session::flash('msg', AppMessage::$InvalidLink);
					return Redirect::to('msg');
				}

			}

			$img_count = ImagePoll::where('session_id',$session->session_id)->count();

		
			
			if(Auth::check())
			{
				$user_rate = ImagePollUser::where('user_id',Auth::User()->user_id)->where('image_poll_id',$image_poll_id)
				->first();	
			}

			return View::make('poll')->with('image_poll',$image_poll)
            						->with('session',$session)
                                    ->with('img_count',$img_count)
                                    ->with('user_rate',$user_rate);
        }
        else
        {
			// return $this->ClosedPage();
			Session::flash('msg', AppMessage::$EndSession);
			return Redirect::to('msg');
//       			return $this->msg();
        }
	}

	public function PollSeps($image_poll_id)
	{
		try
		{
			$session = Sessions::getSession();
			if(isset($session))
			{
				$image_poll = null;
				$user_rate = null;
				$pre_order_no 	=  0;

				$next = intval(Input::get('is_next'));
				$is_vote = intval(Input::get('is_vote'));
				$selected_rating = intval(Input::get('selected_rating'));

				if($is_vote>0)
				{
					if($selected_rating>0)
					{
						$vote			    = ImagePollUser::where('user_id',Auth::User()->user_id)->where('image_poll_id',$image_poll_id)->first();

						if(!isset($vote))
						{
							$vote 				= new ImagePollUser();
							$vote->user_id 		= Auth::User()->user_id;
							$vote->rate 		= $selected_rating;
							$vote->session_id   = $session->session_id;
							$vote->image_poll_id   = $image_poll_id;
							$vote->save();
						}
					}
				}


				$pre_image_poll 	=  ImagePoll::find($image_poll_id);
				if(isset($pre_image_poll))
				{
					$pre_order_no =  $pre_image_poll->order_no;
				}
				else
				{
					Session::flash('msg', AppMessage::$InvalidLink);
					return Redirect::to('msg');
				}

				if($next > 0)
				{

					$image_poll=ImagePoll::orderBy('order_no')->where('session_id',$session->session_id)->where('order_no','>',$pre_order_no)
							->first();

				}
				else
				{
					$image_poll=ImagePoll::orderBy('order_no')->where('session_id',$session->session_id)->where('order_no','<',$pre_order_no)
							->first();		
					
				}	
				
				if(isset($image_poll))
				{
					return Redirect::to('poll/'.$image_poll->image_poll_id);	
				}
				else
				{
					if($next > 0)
					{
						if(Auth::check())
						{
							Session::flash('msg', "THANK YOU FOR BEING A PART OF THE VRSI IMAGE COMPETITION");
							return Redirect::to('/tankyou');		
						}
						else
						{
							return Redirect::to('/');
						}	
					}
					else
					{
						return Redirect::to('/');	
					}

					
				}
				
	        }
	        else
	        {
				// return $this->ClosedPage();
				Session::flash('msg', AppMessage::$EndSession);
				return Redirect::to('msg');
    //       			return $this->msg();
	        }
	    } catch (Exception $e) {
            Log::error('PollController - PollSeps : '.$e->getMessage());
			Session::flash('msg', AppMessage::$GENERAL_ERROR);
           	return Redirect::to('msg');
        }	
     }


	// public function PollSeps($image_poll_id=null)
	// {
	// 	try
	// 	{
	// 		$session = Sessions::getSession();
	// 		if(isset($session))
	// 		{
	// 			$image_poll = null;
	// 			$user_rate = null;
	// 			$pre_order_no 	=  0;
	// 			$next = intval(Input::get('is_next'));


	// 			if($image_poll_id==null)
	// 			{
	// 				$image_poll=ImagePoll::orderBy('order_no')->orderBy('image_poll_id')->first();					
	// 				$image_poll_id= $image_poll->image_poll_id;
	// 			}
	// 			else
	// 			{
					
	// 				$pre_image_poll 	=  ImagePoll::find($image_poll_id);
	// 				if(isset($pre_image_poll))
	// 				{
	// 					$pre_order_no =  $pre_image_poll->order_no;
	// 				}

					
	// 				if(isset($pre_order_no) && $pre_order_no > 0)
	// 				{
	// 					if($next >0)
	// 					{
	// 						$image_poll=ImagePoll::orderBy('order_no')->orderBy('image_poll_id')->where('order_no','>',$pre_order_no)
	// 						->first();							
	// 					}
	// 					else
	// 					{
	// 						$image_poll=ImagePoll::orderBy('order_no')->orderBy('image_poll_id')->where('order_no','<',$pre_order_no)
	// 						->first();								
	// 					}
	// 				}
	// 				else
	// 				{
	// 					if($next >0)
	// 					{
	// 						$image_poll=ImagePoll::orderBy('order_no')->orderBy('image_poll_id')
	// 						->where('image_poll_id','>',$image_poll_id)->first();		
	// 					}
	// 					else
	// 					{
	// 						$image_poll=ImagePoll::orderBy('order_no')->orderBy('image_poll_id')
	// 						->where('image_poll_id','<',$image_poll_id)->first();		
	// 					}
	// 				}
					
	// 			}
				
	// 			$img_count = ImagePoll::where('session_id',$session->session_id)->count();

	// 			// $quiz_options=QuizOptions::where('quiz_id',$quiz->quiz_id)->get();
	// 			if(Auth::check())
	// 			{
	// 				$user_rate = ImagePollUser::where('user_id',Auth::User()->user_id)->where('image_poll_id',$image_poll_id)
	// 				->first();	
	// 			}

				

	//             return View::make('poll')->with('image_poll',$image_poll)
	//             						->with('session',$session)
	//                                     ->with('img_count',$img_count)
	//                                     ->with('user_rate',$user_rate);
	//         }
	//         else
	//         {
	// 			// return $this->ClosedPage();
	// 			Session::flash('msg', AppMessage::$EndSession);
	// 			return Redirect::to('msg');
 //    //       			return $this->msg();
	//         }
	//     } catch (Exception $e) {
 //            Log::error('PollController - PollSeps : '.$e->getMessage());
	// 		Session::flash('msg', AppMessage::$GENERAL_ERROR);
 //           	return Redirect::to('msg');
 //        }	
 //     }



    public function thankyou()
	{
		if(Session::has('msg'))
		{
			return View::make('thankyou');
		}
		else
		{
			return Redirect::to('/');
		}
		
	}

	public function msg()
	{
		if(Session::has('msg'))
		{
			return View::make('msg');
		}
		else
		{
			return Redirect::to('/');	
		}
	}
    
	
}
