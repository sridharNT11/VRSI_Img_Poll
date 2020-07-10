<?php

class QuizController extends BaseController {


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

	public function index()
	{
	    
	    $key = Input::get('key');
	    $session_id = Input::get('s_id');
	     $is_random = Input::get('is_r');
	    if($key=="admin@123")
	    {
	        Session::put('is_test', '1');
	        Session::put('session_id', $session_id);
	    }
	    else
	    {
	        Session::put('is_test', '0');
	        Session::put('session_id', 0);
	    }
	    
	    if($is_random == "r") 
		{
			Session::put('is_random', 1);	
			return View::make('index_random');
		}
		else
		{
		    Session::put('is_random', 0);	
		}
	    
		return View::make('index');
	}
	
	
// 	public function indexTest()
// 	{
// 		return View::make('index');
// 	}

	
	public function SessionBasedGet()
	{
	
		return View::make('sessions');
	}
	public function UserAnswerGet()
	{
		// $records = DB::table('table1')
  //           ->join('table2', 'table1.someID', '=', 'table2.someID')
  //           ->join('table3', 'table3.someID', '=', 'table2.someID')
  //           ->select('select something')
  //           ->get();
        $q1 = DB::table('temp_users')->get();




        

		return View::make('users_answer')->with('q1',$q1);
	}
	
	
	// Session TWO
	public function SessionTwo()
	{
	
		return View::make('session_two');
	}
	
	public function SessionTwoUserAnswerGet()
	{
		// $records = DB::table('table1')
  //           ->join('table2', 'table1.someID', '=', 'table2.someID')
  //           ->join('table3', 'table3.someID', '=', 'table2.someID')
  //           ->select('select something')
  //           ->get();
        $q1 = DB::table('temp_users_session_2')->get();

        	//	var_dump($q1);
           //   exit();
     
	return View::make('users_answer')->with('q1',$q1);
	}
	
	// Session Three
	public function SessionThree()
	{
	
		return View::make('session_three');
	}
	public function SessionThreeUserAnswerGet()
	{
		// $records = DB::table('table1')
  //           ->join('table2', 'table1.someID', '=', 'table2.someID')
  //           ->join('table3', 'table3.someID', '=', 'table2.someID')
  //           ->select('select something')
  //           ->get();
        $q1 = DB::table('temp_users_session_4')->get();

        // 		var_dump($q1);
        // 		exit();
     
	return View::make('users_answer')->with('q1',$q1);
	}
//end Session three




// Session Four
	public function SessionFive()
	{
	
		return View::make('sessionfive');
	}
	public function SessionFiveUserAnswerGet()
	{
        $q1 = DB::table('temp_users_session_5')->get();

        // 		var_dump($q1);
        // 		exit();
     
	return View::make('session_five_users_answer')->with('q1',$q1);
	}
	
	public function RegisterGet($user_id =null)
	{
		try
		{
			$session = Sessions::getCurrentSession();
			if(isset($session))
			{
				$user = null;
				if(isset($user_id))
				{
					$user_id = intval(urldecode(Helper::decrypt($user_id)));
					$user = User::find($user_id);
				}
				return View::make('register')->with('user',$user)->with('session',$session);
			}
			else
			{
			    return $this->ClosedPage();
				// Session::flash('msg', AppMessage::$EndSession);
    //       		return $this->msg();
			}

		} catch (Exception $e) {
            Log::error('QuizController - RegisterGet : '.$e->getMessage());
			Session::flash('msg', AppMessage::$GENERAL_ERROR);
           return $this->msg();
        }	
	}
	public function RegisterPost()
	{
		try
		{
			//validate the info, create rules for the inputs
			$rules = array(
			'mobile'     => 'required|alphaNum|max:10'
			);
			$messages = array(
                'mobile.required'    => 'The mobile may only contain letters and numbers.',
            );
			$validator = Validator::make(Input::all(), $rules,$messages);
			      // if the validator fails, redirect back to the form
			if (!$validator->fails())
			{
				$mobile  = Input::get('mobile');
				$user = User::where('mobile',$mobile)->first();
				if(!isset($user)) {
					$user = new User;
					$user->mobile=$mobile;
					$user->save();
				}

				//return Redirect::to('user_info/'. Helper::encrypt($user->user_id));
				return $this->UserInformationGet(Helper::encrypt($user->user_id));

		    }
		    else
			{
				//$success = Session::get('success');
			 return Redirect::to('login')->withInput()->withErrors($validator->errors());
			}
		} catch (Exception $e) {
            Log::error('QuizController - RegisterPost : '.$e->getMessage());
			Session::flash('msg', AppMessage::$GENERAL_ERROR);
           return $this->msg();
        }
	}
	public function UserInformationGet($user_id)
	{
		try
		{
		  //  $session = Sessions::getCurrentSession();
		    
			$user = null;
			if(isset($user_id))
			{
				$user_id = intval(urldecode(Helper::decrypt($user_id)));
				$user = User::find($user_id);
			}
			if(isset($user))
			{
				return View::make('userinfo')->with("user",$user)->with('session',$session);				
			}
			else
			{
				return Redirect::to('login');
			}
		} catch (Exception $e) {
            Log::error('QuizController - UserInformationGet : '.$e->getMessage());
			Session::flash('msg', AppMessage::$GENERAL_ERROR);
           return $this->msg();
        }	

	}
	public function UserInformationPost($user_id)
	{
		try
		{
			$user = null;
			if(isset($user_id))
			{
				$user_id = intval(urldecode(Helper::decrypt($user_id)));
				$user = User::find($user_id);	
			}
			
			if(!isset($user))
			{
				return Redirect::to('login');
			}

			if(intval(Input::get('is_next'))==0)
			{
				//return Redirect::to('login/'.Helper::encrypt($user_id));
				return $this->RegisterGet(Helper::encrypt($user_id));
			}

			$rules = array(
			'name'         => 'required',
			'mobile'       => 'required|alphaNum|max:10|unique:users,mobile,'.$user->user_id.',user_id',
			'email'        => 'required|email|unique:users,email,'.$user->user_id.',user_id',
			'city'         => 'required',   
			'state' 	   => 'required',
			'dob'          => 'required|date_format:d/m/Y',
			'is_pg_student' 	   => 'required',
			);
			      
			$validator = Validator::make(Input::all(), $rules);
			      
			if ($validator->fails())
			{
				return Redirect::to('user_info/'.Helper::encrypt($user->user_id))->withInput()->withErrors($validator->errors());
			}
			else
			{
				
				$user->name          = Input::get('name');
				$user->mobile        = Input::get('mobile');
				$user->email         = Input::get('email');
				$user->city          = Input::get('city');
				$user->state         = Input::get('state');
				$dob                 = Input::get('dob');
				$user->dob            = Helper::toDBDate($dob);
				$user->is_pg_student         = Input::get('is_pg_student');
				
				$user->save();


				$session = Sessions::getCurrentSession(); 

				if(isset($session))
				{

				 	$quiz = Quiz::where('session_id',$session->session_id)->orderBy('quiz_no')->first();
				 	//this line correct 

					//return Redirect::to('quiz/'.Helper::encrypt($quiz->quiz_id).'/'.Helper::encrypt($user->user_id));
				// 	return $this->QuizGet(Helper::encrypt($quiz->quiz_id),Helper::encrypt($user->user_id));
    				if($session->session_type == CustomClass::$SESSION_RANDOM)
      				{
    					return $this->QuizRandomGet(null,Helper::encrypt($user->user_id));
    				}
    				else
    				{
    					return $this->QuizGet(Helper::encrypt($quiz->quiz_id),Helper::encrypt($user->user_id));
    				}
				}
				else
				{
					return $this->ClosedPage();
				// 	Session::flash('msg', AppMessage::$EndSession);
    //       			return $this->msg();
				}
			}
		} catch (Exception $e) {
            Log::error('QuizController - UserInformationPost : '.$e->getMessage());
			Session::flash('msg', AppMessage::$GENERAL_ERROR);
           return $this->msg();
        }	

  	}
  	public function QuizGet($quiz_id,$user_id)
	{
		try
		{
			if(isset($user_id))
			{
				$user_id = intval(urldecode(Helper::decrypt($user_id)));
			}
			if(isset($quiz_id))
			{
				$quiz_id = intval(urldecode(Helper::decrypt($quiz_id)));
			}

			$session = Sessions::getCurrentSession();
			if(isset($session))
			{
				$quiz=Quiz::find($quiz_id);
				$quiz_count = Quiz::where('session_id',$session->session_id)->count();

				$quiz_options=QuizOptions::where('quiz_id',$quiz->quiz_id)->get();

				$user_answer =  UserAnswers::where('user_id',$user_id)->where('quiz_id',$quiz_id)->first();


	            return View::make('quiz')->with('quiz',$quiz)
	            						->with('session',$session)
	            						->with('quiz_options',$quiz_options)
	                                    ->with('quiz_count',$quiz_count)
	                                    ->with('user_id',$user_id)
	                                    ->with('user_answer',$user_answer);
	        }
	        else
	        {
				return $this->ClosedPage();
				// Session::flash('msg', AppMessage::$EndSession);
    //       			return $this->msg();
	        }
	    } catch (Exception $e) {
            Log::error('QuizController - QuizGet : '.$e->getMessage());
			Session::flash('msg', AppMessage::$GENERAL_ERROR);
           return $this->msg();
        }	
     }
    
	public function QuizPost($quiz_id,$user_id)
	{
		try
		{

			if(isset($user_id))
			{
				$user_id = intval(urldecode(Helper::decrypt($user_id)));
			}
			if(isset($quiz_id))
			{
				$quiz_id = intval(urldecode(Helper::decrypt($quiz_id)));
			}

			$qo_id = Input::get('user_option');
			$session = Sessions::getCurrentSession();
			if(isset($session))
			{
				
				$quiz = Quiz::find($quiz_id);


				if(intval(Input::get('is_next'))==0)
				{
					$quiz_prev = Quiz::where('session_id',$session->session_id)->where('quiz_no','<',$quiz->quiz_no)->orderBy('quiz_no','DESC')->first();


					if(isset($quiz_prev))
					{
						//return Redirect::to('quiz/'.Helper::encrypt($quiz_prev->quiz_id).'/'.Helper::encrypt($user_id));
						return $this->QuizGet(Helper::encrypt($quiz_prev->quiz_id),Helper::encrypt($user_id));
					}
					else
					{
						
						//return Redirect::to('user_info/'.Helper::encrypt($user_id));
						return $this->UserInformationGet(Helper::encrypt($user_id));
					}
				}
				else
				{
					if(intval($qo_id)==0)
					{
						//eturn Redirect::to('quiz/'.Helper::encrypt($quiz_id).'/'.Helper::encrypt($user_id));
						return $this->QuizGet(Helper::encrypt($quiz_id),Helper::encrypt($user_id));
					}

					$user_answer =  UserAnswers::where('user_id',$user_id)->where('quiz_id',$quiz_id)->first();
					if(!isset($user_answer))
					{
						$user_answer = new UserAnswers();
						$user_answer->quiz_id=$quiz_id;
						$user_answer->user_id=$user_id;
						$user_answer->qo_id=$qo_id;
						$user_answer->save();	
					}
					
					$quiz_next = Quiz::where('session_id',$session->session_id)->where('quiz_no','>',$quiz->quiz_no)->orderBy('quiz_no')->first();

					if(isset($quiz_next))
					{
						//return Redirect::to('quiz/'.Helper::encrypt($quiz_next->quiz_id).'/'.Helper::encrypt($user_id));
						return $this->QuizGet(Helper::encrypt($quiz_next->quiz_id),Helper::encrypt($user_id));
					}
					else
					{
						//echo "success";
						//return Redirect::to('success')->with('msg','Thank you! ');
						return $this->success();
					}
				}
			
			}
	        else
	        {
		     	return $this->ClosedPage();
				// Session::flash('msg', AppMessage::$EndSession);
    //       		return $this->msg();
	        };
	    } catch (Exception $e) {
            Log::error('QuizController - QuizPost : '.$e->getMessage());
			Session::flash('msg', AppMessage::$GENERAL_ERROR);
           return $this->msg();
        }	 

	}
    //Random quiz 
	public function QuizRandomGet($quiz_id,$user_id)
	{
		
		try
		{
			if(isset($user_id))
			{

				$user_id = intval(urldecode(Helper::decrypt($user_id)));
			}
			if(isset($quiz_id))
			{
				$quiz_id = intval(urldecode(Helper::decrypt($quiz_id)));
			}

			if(Input::get('is_refresh')=="1"){
					$quiz_id=null;
			}


			$session = Sessions::getCurrentSession();
			
			if(isset($session))
			{
					$in_session_id = $session->session_id;
		    		$in_user_id    = $user_id;
		    		$in_quiz_limit = 30;
		    		$in_quiz_id    = $quiz_id;

				$result   = Quiz::usp_get_random_quiz($in_session_id,$in_user_id,$in_quiz_limit,$in_quiz_id);

				// var_dump($result);
				// exit();

				// //$quiz=Quiz::find($quiz_id);	
				// var_dump($result);
				// exit();

				$quiz = $result["quiz"];



				$quiz_id = $quiz->quiz_id;
				$quiz->quiz_no = $quiz->s_no;

				// $in_user_id = $result["next_quiz_id"];

				// $in_quiz_limit = $result["previous_quiz_id"];
				$quiz_count = $in_quiz_limit;
				//$quiz_count = Quiz::where('session_id',$session->session_id)->count();

				$quiz_options=QuizOptions::where('quiz_id',$quiz->quiz_id)->get();

			$user_answer =  UserAnswers::where('user_id',$user_id)->where('quiz_id',$quiz_id)->first();


	            return View::make('quiz')->with('quiz',$quiz)
	            						->with('session',$session)
	            						->with('quiz_options',$quiz_options)
	                                    ->with('quiz_count',$quiz_count)
	                                    ->with('user_id',$user_id)
	                                    ->with('user_answer',$user_answer);
	        }
	        else
	        {
				return $this->ClosedPage();
				// Session::flash('msg', AppMessage::$EndSession);
    //       			return $this->msg();
	        }
	    } catch (Exception $e) {
            Log::error('QuizController - QuizRandomGet : '.$e->getMessage());
			Session::flash('msg', AppMessage::$GENERAL_ERROR);
           return $this->msg();
        }	
     }
    
	public function QuizRandomPost($quiz_id,$user_id)
	{
		try
		{	
			

			if(isset($user_id))
			{
				$user_id = intval(urldecode(Helper::decrypt($user_id)));
			}
			if(isset($quiz_id))
			{
				$quiz_id = intval(urldecode(Helper::decrypt($quiz_id)));
			}

			$qo_id = Input::get('user_option');
			$session = Sessions::getCurrentSession();
			if(isset($session))
			{
				$in_session_id = $session->session_id;
	    		$in_user_id    = $user_id;
	    		$in_quiz_limit = 30;
	    		$in_quiz_id    = $quiz_id;

					
				//$quiz = Quiz::find($quiz_id);
				//$quiz = $result["quiz"];

				if(intval(Input::get('is_next'))==0)
				{
					$result   = Quiz::usp_get_random_quiz($in_session_id,$in_user_id,$in_quiz_limit,$in_quiz_id);
					$prev_quiz_id = $result["previous_quiz_id"];

					Input::replace(['is_refresh' => '0']);		
					// $result   = Quiz::usp_get_random_quiz($in_session_id,$in_user_id,$in_quiz_limit,$in_quiz_id);
					// $prev_quiz_id = $result["previous_quiz_id"];


					if(isset($prev_quiz_id) &&  intval($prev_quiz_id) >0)
					{
					// 	var_dump($prev_quiz_id);
					// exit();
						//return Redirect::to('quiz/'.Helper::encrypt($quiz_prev->quiz_id).'/'.Helper::encrypt($user_id));
						return $this->QuizRandomGet(Helper::encrypt($prev_quiz_id),Helper::encrypt($user_id));
					}
					else
					{
						
						//return Redirect::to('user_info/'.Helper::encrypt($user_id));
						return $this->UserInformationGet(Helper::encrypt($user_id));
					}
				}
				else
				{
					$result   = Quiz::usp_get_random_quiz($in_session_id,$in_user_id,$in_quiz_limit,$in_quiz_id);

					if(intval($qo_id)==0)
					{
						//eturn Redirect::to('quiz/'.Helper::encrypt($quiz_id).'/'.Helper::encrypt($user_id));
						return $this->QuizGet(Helper::encrypt($quiz_id),Helper::encrypt($user_id));
					}

					

					$user_answer =  UserAnswers::where('user_id',$user_id)->where('quiz_id',$quiz_id)->first();
					if(!isset($user_answer))
					{
						$user_answer = new UserAnswers();
						$user_answer->quiz_id=$quiz_id;
						$user_answer->user_id=$user_id;
						$user_answer->qo_id=$qo_id;
						$user_answer->save();	
					}

					$result   = Quiz::usp_get_random_quiz($in_session_id,$in_user_id,$in_quiz_limit,$in_quiz_id);
					$next_quiz_id = $result["next_quiz_id"];
					if(isset($next_quiz_id) &&  intval($next_quiz_id) >0)
					{
						Input::replace(['is_refresh' => '0']);		
						return $this->QuizRandomGet(Helper::encrypt($next_quiz_id),Helper::encrypt($user_id));
					}					
					else
					{
						//echo "success";
						//return Redirect::to('success')->with('msg','Thank you! ');
						return $this->success();
					}
				}
			
			}
	        else
	        {
		     	return $this->ClosedPage();
				// Session::flash('msg', AppMessage::$EndSession);
    //       		return $this->msg();
	        };
	    } catch (Exception $e) {
            Log::error('QuizController - QuizRandomPost : '.$e->getMessage());
			Session::flash('msg', AppMessage::$GENERAL_ERROR);
           return $this->msg();
        }	 

	}
	public function success()
	{
	    $session = Sessions::getCurrentSession();
		return View::make('success')->with('session',$session);
	}
	public function msg()
	{
		return View::make('msg');
	}

    public function Information()
	{
		return View::make('information') -> with('sessions',$sessions);
	}
	//session 1 - cataract
	public function CataractOne()
	{
		return View::make('cataract_one');
	}
	
	public function CataractOneUser()
	{
		$q1 = DB::table('temp_cataract_one')->get();     

		return View::make('cataract_one_users')->with('q1',$q1);
	}
	//session 2-cornea
	Public function Cornea()
	{
		return View::make('cornea');
	}
	public function CorneaUsers()
	{
		$q1 = DB::table('temp_cornea')->get();  

		return View::make('cornea_users')->with('q1',$q1);
	}
	//session 3-GlaucomaOne
	public function GlaucomaOne()
	{
		return View::make('glaucoma_one');
	}
	public function GlaucomaOneUsers()
	{
		$q1 = DB::table('temp_glaucoma_one')->get();     

		return View::make('glaucoma_one_users')->with('q1',$q1);
	}
	//session 4
	public function Retina()
	{
		return View::make('retina');
	}
	public function RetinaUsers() 
	{
        $q1 = DB::table('temp_retina')->get();  
        // var_dump($q1);
        // exit();  
	return View::make('retina_users')->with('q1',$q1);
	}
	// Cataract - 5
	public function CataractSession()
	{
	
		return View::make('cataract_session');
	}
	
	public function CataractSessionUser()
	{
        $q1 = DB::table('temp_cataract_two')->get();    
	return View::make('cataract_users')->with('q1',$q1);
	}
		//Session   - 6  Pediatric Ophthalmology
	public function PediatricOphthalmology()
	{
	
		return View::make('pediatric_ophthalmology');
	}
	
	public function PediatricOphthalmologyUser() 
	{
        $q1 = DB::table('temp_pediatric_ophthal')->get();  
        // var_dump($q1);
        // exit();  
	return View::make('pediatric_ophthalmology_user')->with('q1',$q1);
	}
	//End session 6
	
	//session 6 Options for each question
	public function PediatricOphthalmologyQsans()
	{
		return View::make('pediatricophthalmology_qsans');
	}
	//Session   - 7  Dusshera Special
	public function DussheraSpecial()
	{
	
		return View::make('dusshera_special');
	}
	
	public function DussheraSpecialUsers()
	{
        $q1 = DB::table('temp_dussera_special')->get();    
	return View::make('dusshera_special_user')->with('q1',$q1);
	}
	//End Session 7
	
	// Options for each question
	
	public function DussheraSpeciaQsans()
	{
		return View::make('dussheraspeciaqsans');
	}

	//End
	// Session 8 - Diwali Quiz
	public function DiwaliQuiz()
	{
		return View::make('diwali_quiz');
	}

	public function DiwaliQuizUser() 
	{
        $q1 = DB::table('temp_diwali_quiz')->get();  
	return View::make('diwali_quiz_user')->with('q1',$q1);
	}

	public function DiwaliQuizQsans()
	{
		return View::make('diwaliquizqsans');
	}
    // End Diwali Session
    //session- 9 - Glaucoma
    public function GlaucomaTwo()
	{
		return View::make('glaucoma_two');
	}
	public function GlaucomaTwoUsers()
	{
        $q1 = DB::table('temp_glaucoma_two')->get();    
	return View::make('glaucoma_two_users')->with('q1',$q1);
	}
		public function GlaucomaTwoQsans()
	{
		return View::make('glaucoma_two_qsans');
	}
	
	public function ClosedPage()
	{
		return View::make('closed');
	}
	//session 9 Gluacoma
	public function GlaucomaSession()
	{
		return View::make('glaucoma_session');
	}
	public function GlaucomaSessionUser() 
	{
		
        $q1 = DB::table('temp_glaucoma_two')->get();  
      
	return View::make('glaucoma_session_user')->with('q1',$q1);
	}
	
	//Cataract Session -10
	public function CataracThree()
	{
		return View::make('cataract_three');
	}
	public function CataractThreeUsers()
	{
		$q1 = DB::table('temp_cataract_three')->get();  
      
	return View::make('cataract_three_users')->with('q1',$q1);
	}
    public function CataractThreeQuizQsans()
    {
    	return View::make('cataract_three_qsans');
    }
    
    // Archive page link
//Cataract Session
	public function CataractThreeSession()
	{
		return View::make('cataract_three_session');
	}
	public function CataractThreeSessionUser()
	{
		$q1 = DB::table('temp_cataract_three')->get();  
      
	return View::make('cataract_three_session_users')->with('q1',$q1);
	}
	
	//Retina Session
	public function RetinaTwo()
	{

		return View::make('retina_two');
	}
	public function RetinaTwoUsers()
	{
		$q1 = DB::table('temp_retina_two')->get();  
      
	return View::make('retina_two_users')->with('q1',$q1);
	}
	public function RetinaTwoQsans()
	{
		return View::make('retina_two_qsans');
	}
    //Retina Session for archive
	public function RetinaSessionTwo()
	{

		return View::make('retina_session_two');
	}
	public function RetinaSessionTwoUsers()
	{
		$q1 = DB::table('temp_retina_two')->get();  
      
	return View::make('retina_session_two_users')->with('q1',$q1);
	}
	
	//Word Roots 
	public function WordRoots()
	{

		return View::make('word_roots');
	}
	public function WordRootsUsers()
	{
		$q1 = DB::table('temp_word_roots')->get();  
      
	return View::make('word_roots_users')->with('q1',$q1);
	}
	public function WordRootsQsans()
	{
		return View::make('word_roots_qsans');
	}

	//Retina Session for archive
	public function WordRootsSession()
	{

		return View::make('word_roots_session');
	}
	public function WordRootsSessionUsers()
	{
		$q1 = DB::table('temp_word_roots')->get();  
      
	return View::make('word_roots_session_users')->with('q1',$q1);
	}
	
	//Named Sign 
	public function NamedSign()
	{

		return View::make('named_sign');
	}
	public function NamedSignUsers()
	{
		$q1 = DB::table('temp_named_signs')->get();  
      
	return View::make('named_signs_users')->with('q1',$q1);
	}
	public function NamedSignQsans()
	{
		return View::make('named_signs_qsans');
	}

	//Named Sign archive
	public function NamedSignSession()
	{

		return View::make('named_sign_session');
	}
	public function NamedSignUsersSession()
	{
		$q1 = DB::table('temp_named_signs')->get();  
      
	return View::make('named_signs_session_users')->with('q1',$q1);
	}
   
    //Scientists in ophthalmology
	public function ScientistsOphthalmology()
	{

		return View::make('scientists_ophthalmology');
	}
   public function ScientistsOphthalmologyUser($session_id = 0)
	{
	    	try
	    	{	

				$session = array();
				$session_id	= 14;

		        $result    = Sessions::usp_session_user_result($session_id);
		       
				$session = $result["session"];
				// var_dump($session);
               //  exit();
				return View::make('scientists_ophthalmology_user')->with('session',$session);
			}
	    	catch(Exception $e)
	    	{
	    		Log::error('QuizController => ScientistsOphthalmologyUser'.$e->getMessage());
	    		echo $e->getMessage();
	    	}
	}
	public function ScientistsOphthalmologyQsans()
	{
		return View::make('scientists_ophthalmology_qsans');
	}
	
	//Scientists in ophthalmology
	public function ScientistsOphthalmologySession()
	{

		return View::make('scientists_ophthalmology_session');
	}
	 public function ScientistsOphthalmologySessionUser($session_id = 0)
	{
	    	try
	    	{	

				$session = array();
				$session_id	= 14;

		        $result    = Sessions::usp_session_user_result($session_id);
		       
				$session = $result["session"];
				// var_dump($session);
               //  exit();
				return View::make('scientists_ophthalmology_session_users')->with('session',$session);
			}
	    	catch(Exception $e)
	    	{
	    		Log::error('QuizController => ScientistsOphthalmologyUser'.$e->getMessage());
	    		echo $e->getMessage();
	    	}
	}
	
	//Ophthalmology Eponyms
		public function OphthalmologyEponyms()
		{

			return View::make('ophthalmology_eponyms');
		}
		public function OphthalmologyEponymsUsers($session_id = 0)
		{
		    	try
		    	{	

				$session = array();
				$session_id	= 15;

		        $result    = Sessions::usp_session_user_result($session_id);
		       
				$session = $result["session"];
				// var_dump($session);
               //  exit();
				return View::make('ophthalmology_eponyms_users')->with('session',$session);
			}
	    	catch(Exception $e)
	    	{
	    		Log::error('QuizController => OphthalmologyEponymsUsers'.$e->getMessage());
	    		echo $e->getMessage();
	    	}
		}
		public function OphthalmologyEponymsQsans()
	{
		return View::make('ophthalmology_eponyms_qsans');
	}
	
		//Ophthalmology Eponyms - ARCHIVE page
	public function OphthalmologyEponymsSession()
	{

		return View::make('ophthalmology_eponyms_session');
	}
	 public function OphthalmologyEponymsSessionUser($session_id = 0)
	{
	    	try
	    	{	

				$session = array();
				$session_id	= 15;

		        $result    = Sessions::usp_session_user_result($session_id);
		       
				$session = $result["session"];
				// var_dump($session);
               //  exit();
				return View::make('ophthalmology_eponyms_session_users')->with('session',$session);
			}
	    	catch(Exception $e)
	    	{
	    		Log::error('QuizController => OphthalmologyEponymsSessionUser'.$e->getMessage());
	    		echo $e->getMessage();
	    	}
	}
	
    	//OCT
    public function oct()
    	{
    
    		return View::make('oct');
    	}
    	
    public function OCTUsers($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 16;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('oct_users')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => OCTUsers'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		
	// oct qsans
	public function OCTQsans()
		{
			return View::make('oct_qsans');
		}   
	//oct - ARCHIVE page
			public function OCTSession()
		{

			return View::make('oct_session');
		}
		 public function OCTSessionUsers($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 16;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	               //  exit();
					return View::make('oct_session_users')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => OCTSessionUsers'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
    //VisualFields
	public function VisualFields()
		{

			return View::make('visual_fields');
		}

		public function VisualFieldsUsers($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 17;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('visual_fields_users')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => VisualFieldsUsers'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		public function VisualFieldsQsans()
		{
			return View::make('visual_fields_qsans');
		}
		//Visual Fields archive page 
		public function VisualFieldsSession()
		{
			return View::make('visual_fields_session');
		}
		public function VisualFieldsUsersSession($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 17;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('visual_fields_session_users')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => VisualFieldsUsersSession'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		
			//Cataract Jan Quiz
		public function CataractJan()
		{

			return View::make('cataract_ses');
		}
		
		public function CataractJanUsers($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 23;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('cataract_ses_users')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => CataractJanUsers'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		public function CataractJanQsans()
		{
			return View::make('cataract_ses_qsans');
		}
		
		//CataractJan Quiz Archive
		public function CataractArchive()
		{

			return View::make('cataract_archive');
		}
		public function CataractUsersArchive($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 23;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('cataract_users_archive')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => CataractUsersArchive'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		
		//Retina Quiz
		public function Retinases()
		{

			return View::make('retina_ses');
		}
		public function RetinasesUsers($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 24;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('retina_ses_users')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => RetinasesUsers'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		public function RetinasesQsans()
		{
			return View::make('retina_ses_qsans');
		}
		
			//Retina Archive
		public function RetinasesArchive()
		{

			return View::make('retina_ses_archive');
		}
		public function RetinasesUsersArchive($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 24;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('retina_ses_users_archive')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => RetinasesUsersArchive'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
    //Cornea Quiz
		public function Corneases()
		{
			return View::make('cornea_ses');
		}
		
		public function CorneasesUsers($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 25;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('cornea_ses_users')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => CorneasesUsers'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		public function CorneasesQsans()
		{
			return View::make('cornea_ses_qsans');
		}
		
		public function CorneasesArchive()
		{
			return View::make('cornea_ses_archive');
		}
		
		public function CorneasesUsersArchive($session_id = 0)
		{
		    	try
		    	{	
					$session = array();
					$session_id	= 25;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('cornea_ses_users_jan_archive')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => CorneasesUsersArchive'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		
		//BacktoBasics Quiz
		public function BacktoBasics()
		{
			return View::make('backtobasics');
		}
		
		public function BacktoBasicsUsers($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 26;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('back_to_basics_users')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => BacktoBasicsUsers'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}

		public function BacktoBasicsQsans()
		{
			return View::make('back_to_basics_qsans');
		}
		
		//BacktoBasics Archive 
		public function BacktoBasicsArchive()
		{
			return View::make('backtobasics_archive');
		}

		public function BacktoBasicsUsersArchive($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 26;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('backtobasics_users_archive')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => BacktoBasicsUsersArchive'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		
		// Nandhini R : 03/02/2020
		 //Mega Quiz
		public function MegaQuiz($session_id=27)
		{

			$sessions  = Sessions::find($session_id); 
			// var_dump($sessions);
			// exit();

			$quiz    = DB::table('quiz')->where('session_id',$session_id)->get();
			// var_dump($quizs);
			// exit();

			$qos_db      = DB::table('quiz')
						->join('quiz_options', 'quiz.quiz_id', '=', 'quiz_options.quiz_id')
						->where('session_id',$session_id)->get();
			// var_dump($qos_db);
			// exit();
				$qos = [];		
		 foreach ($qos_db as $key => $value)
	      {
	      		$qos[$value->quiz_id][] = $value; 

	      }
		// 	      var_dump($qos);
		// exit();
	      $qas_db      = DB::table('quiz')->join('quiz_answers', 'quiz.quiz_id', '=', 'quiz_answers.quiz_id')
									      ->join('quiz_options', 'quiz_answers.qo_id', '=', 'quiz_options.qo_id')
									   ->where('session_id',$session_id)->get();
		// var_dump($qas_db);
		// exit();
			$qas = [];		
		 foreach ($qas_db as $key => $value)
	      {
	      		$qas[$value->quiz_id] = $value; 

	      }
		// var_dump($qas);
		// exit();
	  
			return View::make('megaquiz')->with('sessions',$sessions)->with('quiz',$quiz)
											 ->with('qos',$qos)->with('qas',$qas);
		}
		
		
		//Ophthalmic Savoury
		public function OphthalmicSavoury($session_id=28)
		{

			$sessions  = Sessions::find($session_id); 
			$quiz    = DB::table('quiz')->where('session_id',$session_id)->get();
			
			$quiz_des =[];
			foreach ($quiz as $key => $value)
	      {
	      		$quiz_des[$value->quiz_id] = $value; 

	      }

			$qos_db      = DB::table('quiz')
						->join('quiz_options', 'quiz.quiz_id', '=', 'quiz_options.quiz_id')
						->where('session_id',$session_id)->get();
			$qos = [];		
		 foreach ($qos_db as $key => $value)
	      {
	      		$qos[$value->quiz_id][] = $value; 

	      }
	      $qas_db      = DB::table('quiz')->join('quiz_answers', 'quiz.quiz_id', '=', 'quiz_answers.quiz_id')
									      ->join('quiz_options', 'quiz_answers.qo_id', '=', 'quiz_options.qo_id')
									   ->where('session_id',$session_id)->get();
			$qas = [];		
		 foreach ($qas_db as $key => $value)
	      {
	      		$qas[$value->quiz_id] = $value; 

	      }
				return View::make('ophthalmic_savoury')->with('sessions',$sessions)->with('quiz',$quiz)
											 ->with('qos',$qos)->with('qas',$qas)->with('quiz_des',$quiz_des);
		}
		
		public function OphthalmicSavouryUsers($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 28;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('ophthalmic_savoury_users')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => OphthalmicSavouryUsers'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		
		
		public function MegaQuizWinners()
        	{
                $mega_quiz = DB::table('mega_quiz_winners_list')->get();    
        	return View::make('mega_quiz_winners')->with('mega_quiz',mega_quiz);
        	}
        	
        	
        	
		
// 		public function OphthalmicSavouryQsans()
// 		{
// 			return View::make('ophthalmic_savoury_qsans');
// 		}
		
		
		//Ophthalmic Savoury
		public function OphthalmicSavouryArchive($session_id=28)
		{

			$sessions  = Sessions::find($session_id); 
			$quiz    = DB::table('quiz')->where('session_id',$session_id)->get();
			
			$quiz_des =[];
			foreach ($quiz as $key => $value)
	      {
	      		$quiz_des[$value->quiz_id] = $value; 

	      }

			$qos_db      = DB::table('quiz')
						->join('quiz_options', 'quiz.quiz_id', '=', 'quiz_options.quiz_id')
						->where('session_id',$session_id)->get();
			$qos = [];		
		 foreach ($qos_db as $key => $value)
	      {
	      		$qos[$value->quiz_id][] = $value; 

	      }
	      $qas_db      = DB::table('quiz')->join('quiz_answers', 'quiz.quiz_id', '=', 'quiz_answers.quiz_id')
									      ->join('quiz_options', 'quiz_answers.qo_id', '=', 'quiz_options.qo_id')
									   ->where('session_id',$session_id)->get();
			$qas = [];		
		 foreach ($qas_db as $key => $value)
	      {
	      		$qas[$value->quiz_id] = $value; 

	      }
				return View::make('ophthalmic_savoury_archive')->with('sessions',$sessions)->with('quiz',$quiz)
											 ->with('qos',$qos)->with('qas',$qas)->with('quiz_des',$quiz_des);
		}
		
		public function OphthalmicSavouryUsersArchive($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 28;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('ophthalmic_savoury_users_archive')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => OphthalmicSavouryUsers'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		
			//UVEA & RETINA
		public function UveaRetina($session_id=29)
		{

			$sessions  = Sessions::find($session_id); 
			// var_dump($sessions);
			// exit();

			$quiz    = DB::table('quiz')->where('session_id',$session_id)->get();
		    
		    $quiz_des =[];
			foreach ($quiz as $key => $value)
	      {
	      		$quiz_des[$value->quiz_id] = $value; 

	      }

			$qos_db      = DB::table('quiz')
						->join('quiz_options', 'quiz.quiz_id', '=', 'quiz_options.quiz_id')
						->where('session_id',$session_id)->get();
			// var_dump($qos_db);
			// exit();
				$qos = [];		
		 foreach ($qos_db as $key => $value)
	      {
	      		$qos[$value->quiz_id][] = $value; 

	      }
		// 	      var_dump($qos);
		// exit();
	      $qas_db      = DB::table('quiz')->join('quiz_answers', 'quiz.quiz_id', '=', 'quiz_answers.quiz_id')
									      ->join('quiz_options', 'quiz_answers.qo_id', '=', 'quiz_options.qo_id')
									   ->where('session_id',$session_id)->get();
		// var_dump($qas_db);
		// exit();
			$qas = [];		
		 foreach ($qas_db as $key => $value)
	      {
	      		$qas[$value->quiz_id] = $value; 

	      }
		// var_dump($qas);
		// exit();
	  
			return View::make('uvea_retina')->with('sessions',$sessions)->with('quiz',$quiz)
											 ->with('qos',$qos)->with('qas',$qas)->with('quiz_des',$quiz_des);
		}
		
		
		 public function UveaRetinaUsers($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 29;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('uvea_retina_users')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => UveaRetinaUsers'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		
       //UVEA & RETINA ARCHIVE
		public function UveaRetinaArchive($session_id=29)
		{

			$sessions  = Sessions::find($session_id); 
			// var_dump($sessions);
			// exit();

			$quiz    = DB::table('quiz')->where('session_id',$session_id)->get();
			// var_dump($quizs);
			// exit();

			$quiz_des =[];
			foreach ($quiz as $key => $value)
	      {
	      		$quiz_des[$value->quiz_id] = $value; 

	      }

	      // var_dump($quiz);
	      // exit();

			$qos_db      = DB::table('quiz')
						->join('quiz_options', 'quiz.quiz_id', '=', 'quiz_options.quiz_id')
						->where('session_id',$session_id)->get();
			// var_dump($qos_db);
			// exit();
				$qos = [];		
		 foreach ($qos_db as $key => $value)
	      {
	      		$qos[$value->quiz_id][] = $value; 

	      }
		// 	      var_dump($qos);
		// exit();
	      $qas_db      = DB::table('quiz')->join('quiz_answers', 'quiz.quiz_id', '=', 'quiz_answers.quiz_id')
									      ->join('quiz_options', 'quiz_answers.qo_id', '=', 'quiz_options.qo_id')
									   ->where('session_id',$session_id)->get();
		// var_dump($qas_db);
		// exit();
			$qas = [];		
		 foreach ($qas_db as $key => $value)
	      {
	      		$qas[$value->quiz_id] = $value; 

	      }
		// var_dump($qas);
		// exit();
	  
	return View::make('uvea_retina_archive')->with('sessions',$sessions)->with('quiz',$quiz)
									->with('qos',$qos)->with('qas',$qas)
									->with('quiz_des',$quiz_des);
		}

		public function UveaRetinaUsersArchive($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 29;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('uvea_retina_users_archive')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => UveaRetinaUsersArchive'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
		
	//Pediatric
		public function Pediatric($session_id=30)
		{

			$sessions  = Sessions::find($session_id); 
			// var_dump($sessions);
			// exit();

			$quiz    = DB::table('quiz')->where('session_id',$session_id)->get();
			// var_dump($quizs);
			// exit();

			$quiz_des =[];
			foreach ($quiz as $key => $value)
	      {
	      		$quiz_des[$value->quiz_id] = $value; 

	      }

	      // var_dump($quiz);
	      // exit();

			$qos_db      = DB::table('quiz')
						   ->join('quiz_options', 'quiz.quiz_id', '=', 'quiz_options.quiz_id')
						   ->where('session_id',$session_id)->get();
			// var_dump($qos_db);
			// exit();
				$qos = [];		
		 foreach ($qos_db as $key => $value)
	      {
	      		$qos[$value->quiz_id][] = $value; 

	      }
		// 	      var_dump($qos);
		// exit();
	      $qas_db      = DB::table('quiz')->join('quiz_answers', 'quiz.quiz_id', '=', 'quiz_answers.quiz_id')
									      ->join('quiz_options', 'quiz_answers.qo_id', '=', 'quiz_options.qo_id')
									      ->where('session_id',$session_id)->get();
		// var_dump($qas_db);
		// exit();
			$qas = [];		
		 foreach ($qas_db as $key => $value)
	      {
	      		$qas[$value->quiz_id] = $value; 

	      }
		// var_dump($qas);
		// exit();
	  
	return View::make('pediatric')->with('sessions',$sessions)->with('quiz',$quiz)
									->with('qos',$qos)->with('qas',$qas)
									->with('quiz_des',$quiz_des);
		}
		
		public function PediatricUsers($session_id = 0)
		{
		    	try
		    	{	

					$session = array();
					$session_id	= 30;

			        $result    = Sessions::usp_session_user_result($session_id);
			       
					$session = $result["session"];
					// var_dump($session);
	    //             exit();
					return View::make('pediatric_users')->with('session',$session);
				}
		    	catch(Exception $e)
		    	{
		    		Log::error('QuizController => UveaRetinaUsers'.$e->getMessage());
		    		echo $e->getMessage();
		    	}
		}
}
