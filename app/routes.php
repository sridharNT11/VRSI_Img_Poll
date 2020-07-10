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
 echo "test";          
    
});         







//Image Poll Steps
Route::get('poll/{img_poll_id?}','PollController@getPoll'); 
Route::post('poll/{img_poll_id}','PollController@PollSeps'); 

Route::get('/tankyou','PollController@thankyou'); 


Route::get('/msg','PollController@msg'); 


Route::get('/{session_id?}/{key?}','PollController@index'); 


//API
Route::any('/api/user/send_otp','UserController@SendOTP'); 
Route::any('/api/user/verify_otp','UserController@VerifyOTP'); 



Route::get('logout','UserController@Logout'); 










// mobile number enter to login 
Route::get('login/{user_id?}','QuizController@RegisterGet'); 
Route::post('login/{user_id?}','QuizController@RegisterPost'); 
	
	
//});

//Random Quiz step
Route::get('quiz/random/{quiz_id}/{user_id}','QuizController@QuizRandomGet'); 
Route::post('quiz/random/{quiz_id}/{user_id}','QuizController@QuizRandomPost');


Route::get('success','QuizController@success');

//session wise details
Route::any('archive','QuizController@Information');
//session - 1
Route::get('cataract_one','QuizController@CataractOne'); 

Route::any('cataract_one_users','QuizController@CataractOneUser');
//Session - 2 - Cornea
Route::get('cornea','QuizController@Cornea'); 

Route::any('cornea_users','QuizController@CorneaUsers');
//Session - 3 - glaucoma_one
Route::get('glaucoma_one','QuizController@GlaucomaOne'); 

Route::any('glaucoma_one_users','QuizController@GlaucomaOneUsers');
//Session - 4 - Retina
Route::get('retina','QuizController@Retina'); 

Route::any('retina_users','QuizController@RetinaUsers');  
//Session 5  - Cataract_two

Route::get('cataract','QuizController@CataractSession'); 

Route::any('cataract_users','QuizController@CataractSessionUser');  
//Session 6  - Pediatric Ophthalmology  

Route::any('pediatric_ophthalmology','QuizController@PediatricOphthalmology');  

Route::any('pediatric_ophthalmology_user','QuizController@PediatricOphthalmologyUser'); 

//Options for each question
Route::any('pediatric_ophthalmology_qsans','QuizController@PediatricOphthalmologyQsans');  

//Session   - Dusshera Special

Route::get('dusshera_special','QuizController@DussheraSpecial'); 

Route::any('dusshera_special_users','QuizController@DussheraSpecialUsers');    

//Options for each question
Route::any('dussheraspecial_qsans','QuizController@DussheraSpeciaQsans');  

//Session - Diwali Quiz - 8
Route::any('diwali_quiz','QuizController@DiwaliQuiz');  
Route::any('diwali_quiz_user','QuizController@DiwaliQuizUser');
//Options for each question
Route::any('diwali_quiz_qsans','QuizController@DiwaliQuizQsans'); 


//Session -9 - glaucoma_two
Route::get('glaucoma_two','QuizController@GlaucomaTwo'); 

Route::any('glaucoma_two_users','QuizController@GlaucomaTwoUsers');

//Options for each question
Route::any('glaucoma_two_qsans','QuizController@GlaucomaTwoQsans'); 

//Session -9 - glaucoma_two
Route::get('glaucoma_two','QuizController@GlaucomaTwo'); 

Route::any('glaucoma_two_users','QuizController@GlaucomaTwoUsers');

//Closed page for quiz
Route::get('closed_page','QuizController@ClosedPage');

// //Session -9 - glaucoma_two
Route::get('glaucoma_session','QuizController@GlaucomaSession'); 

Route::any('glaucoma_session_users','QuizController@GlaucomaSessionUser');

//Cataract session 10 

Route::get('cataract_three','QuizController@CataracThree'); 

Route::any('cataract_three_users','QuizController@CataractThreeUsers');

//Options for each question
Route::any('cataract_three_quiz_qsans','QuizController@CataractThreeQuizQsans');  

//Session -10 - cataract
Route::get('cataract_three_session','QuizController@CataractThreeSession'); 

Route::any('cataract_three_session_users','QuizController@CataractThreeSessionUser');


//Retina session 11 - 
Route::get('retina_two','QuizController@RetinaTwo'); 

Route::any('retina_two_users','QuizController@RetinaTwoUsers');

//Options for each question
Route::any('retina_two_qsans','QuizController@RetinaTwoQsans');  

//Session -11 - Retina
Route::get('retina_session','QuizController@RetinaSessionTwo'); 

Route::any('retina_session_users','QuizController@RetinaSessionTwoUsers');

//Word Roots session 11 - 
Route::get('word_roots','QuizController@WordRoots'); 

Route::any('word_roots_users','QuizController@WordRootsUsers');

//Options for each question
Route::any('word_roots_qsans','QuizController@WordRootsQsans');  

//Session -11 - Word Roots
Route::get('word_roots_session','QuizController@WordRootsSession'); 

Route::any('word_roots_session_users','QuizController@WordRootsSessionUsers');

//Named sign session 13 - 
Route::get('named_signs','QuizController@NamedSign'); 
Route::get('named_signs_users','QuizController@NamedSignUsers'); 
Route::get('named_signs_users_sp/{session_id?}','QuizController@NamedSignUsersSp'); 

Route::get('named_signs_qsans','QuizController@NamedSignQsans');


//Named sign session 13 - 
Route::get('named_signs_session','QuizController@NamedSignSession'); 
Route::get('named_signs_session_users','QuizController@NamedSignUsersSession'); 

//Scientists in ophthalmology
Route::any('scientists_ophthalmology','QuizController@ScientistsOphthalmology'); 
Route::any('scientists_ophthalmology_users/{session_id?}','QuizController@ScientistsOphthalmologyUser'); 
Route::get('scientists_ophthalmology_qsans','QuizController@ScientistsOphthalmologyQsans');

//Scientists in ophthalmology
Route::get('scientists_ophthalmology_session','QuizController@ScientistsOphthalmologySession'); 
Route::get('scientists_ophthalmology_session_users','QuizController@ScientistsOphthalmologySessionUser'); 


//Ophthalmology Eponyms
Route::any('ophthalmology_eponyms','QuizController@OphthalmologyEponyms'); 
Route::any('ophthalmology_eponyms_users/{session_id?}','QuizController@OphthalmologyEponymsUsers'); 
Route::get('ophthalmology_eponyms_qsans','QuizController@OphthalmologyEponymsQsans');

//Ophthalmology Eponyms - ARCHIVE page
Route::get('ophthalmology_eponyms_session','QuizController@OphthalmologyEponymsSession'); 
Route::get('ophthalmology_eponyms_session_users','QuizController@OphthalmologyEponymsSessionUser'); 

//OCT
Route::any('oct','QuizController@oct'); 
Route::any('oct_users/{session_id?}','QuizController@OCTUsers'); 
Route::get('oct_qsans','QuizController@OCTQsans');

//OCT
Route::get('oct_session','QuizController@OCTSession'); 
Route::get('oct_session_users','QuizController@OCTSessionUsers'); 


//VisualFields
Route::any('visual_fields','QuizController@VisualFields');
Route::any('visual_fields_users/{session_id?}','QuizController@VisualFieldsUsers'); 
Route::get('visual_fields_qsans','QuizController@VisualFieldsQsans');

//VisualFields Archive page
Route::any('visual_fields_session','QuizController@VisualFieldsSession');
Route::any('visual_fields_session_users/{session_id?}','QuizController@VisualFieldsUsersSession');

//Cataract Jan Quiz
Route::any('cataract_ses','QuizController@CataractJan');
Route::any('cataract_ses_users/{session_id?}','QuizController@CataractJanUsers'); 
Route::get('cataract_ses_qsans','QuizController@CataractJanQsans');

//Cataract Jan Archive page
Route::any('cataract_session','QuizController@CataractArchive');
Route::any('cataract_session_users/{session_id?}','QuizController@CataractUsersArchive');


//Retina
Route::any('retina_ses','QuizController@Retinases');
Route::any('retina_ses_users/{session_id?}','QuizController@RetinasesUsers'); 
Route::get('retina_ses_qsans','QuizController@RetinasesQsans');


//Retina archive
Route::any('retina_session_jan20','QuizController@RetinasesArchive');
Route::any('retina_sesssion_users_jan20/{session_id?}','QuizController@RetinasesUsersArchive'); 


//Cornea
Route::any('cornea_ses','QuizController@Corneases');
Route::any('cornea_ses_users/{session_id?}','QuizController@CorneasesUsers');
Route::get('cornea_ses_qsans','QuizController@CorneasesQsans');

//Cornea Archive
Route::any('cornea_ses_archive/{session_id?}','QuizController@CorneasesArchive');
Route::any('cornea_ses_users_archive/{session_id?}','QuizController@CorneasesUsersArchive');

//BACK TO BASICS
Route::any('back_to_basics','QuizController@BacktoBasics');
Route::any('back_to_basics_users/{session_id?}','QuizController@BacktoBasicsUsers');
Route::get('back_to_basics_qsans','QuizController@BacktoBasicsQsans');

//Back to Basics
Route::any('back_to_basics_archive','QuizController@BacktoBasicsArchive');
Route::any('back_to_basics_users_archive/{session_id?}','QuizController@BacktoBasicsUsersArchive');


//Mega Quiz
Route::any('mega_quiz_answers','QuizController@MegaQuiz');
Route::any('mega_quiz_winners','QuizController@MegaQuizWinners');

//OPHTHALMIC SAVOURY
Route::any('ophthalmic_savoury','QuizController@OphthalmicSavoury');
Route::any('ophthalmic_savoury_users/{session_id?}','QuizController@OphthalmicSavouryUsers');

Route::any('ophthalmic_savoury_archive','QuizController@OphthalmicSavouryArchive');
Route::any('archive_ophthalmic_savoury_users/{session_id?}','QuizController@OphthalmicSavouryUsersArchive');




// UVEA & RETINA
Route::any('uvea_retina','QuizController@UveaRetina');
Route::any('uvea_retina_users','QuizController@UveaRetinaUsers');

// UVEA & RETINA ARCHIVE
Route::any('uvea_retina_archive','QuizController@UveaRetinaArchive');
Route::any('uvea_retina_users_archive','QuizController@UveaRetinaUsersArchive');

// PEDIATRIC
Route::any('pediatric','QuizController@Pediatric');
Route::any('pediatric_users','QuizController@PediatricUsers');