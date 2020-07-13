<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/tests', function()
{
 		$data =  DB::select('select * from image_poll i
						left join image_poll_users u on u.image_poll_id = i.image_poll_id and u.user_id = 781
						where i.session_id =1 
						order by u.user_id and i.order_no limit 1');	
 		var_dump($data);
    
});         


Route::get('logout','UserController@Logout'); 





//Image Poll Steps
Route::get('poll/{img_poll_id?}','PollController@getPoll'); 
Route::post('poll/{img_poll_id}','PollController@PollSeps'); 

Route::get('/tankyou','PollController@thankyou'); 


Route::get('/msg','PollController@msg'); 





//API
Route::any('/api/user/send_otp','UserController@SendOTP'); 
Route::any('/api/user/verify_otp','UserController@VerifyOTP'); 



//Defualt url
Route::get('/{session_id?}/{key?}','PollController@index'); 


