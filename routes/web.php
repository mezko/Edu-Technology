<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('mylogin',function(){
    return view('mylogin');
});

//gmail_login
Route::get('/gmail_redirect', 'SocialAuthGoogleController@redirect');
Route::get('/gamil_callback', 'SocialAuthGoogleController@callback');
//end gmail login
//******************************************************************************* */
//facebook login
Route::get('/fb_redirect', 'SocialAuthFacebookController@redirect');
Route::get('/fb_callback', 'SocialAuthFacebookController@callback');
//end facebook login
//********************************************************************************************* */
//////admin panel///////
//for admin panel//////
//***************************************************************************//for admin only////////////////
//login
Route::get('admin/login',function(){
    return view('admin.login');
});
Route::post('admin/login','AdminController@login');
/*********************************************************************************** */
////register
Route::get('admin/register',function(){
    return view('admin.register');
});
Route::post('admin/register','AdminController@Register');
/************************************************************************************** */
//admin panel
Route::get('admin/home','AdminController@homepage')->name('admin/home')->middleware('AdminAuth');
/////////////////////////////////////course Teachers/////////////////////////////////////////////////////
Route::get('admin/courses','AdminController@courses_page')->middleware('AdminAuth');
Route::post('admin/courses','AdminController@addcourse')->middleware('AdminAuth');


/////////////////////////////////////units sections//////////////////////////////////////////////////////
//units
Route::get('admin/units','AdminController@unitpage')->middleware('AdminAuth');
//add unit
Route::post('admin/units','AdminController@addunit')->middleware('AdminAuth');
//remove unit
Route::get('admin/remove/unit/{id}','AdminController@RemoveUnit')->middleware('AdminAuth');
//Edit Unit
Route::get('edit/unit/{id}','AdminController@showeditpage')->middleware('AdminAuth');
Route::post('edit/unit/{id}','AdminController@editunit')->middleware('AdminAuth');
/////////////////////////////////////////////////////////////end all Thing in unit /////////////////
/************************************************************************************************** */
/////////////////////////////////////////////////lessons//////////////////////////////////////////////
//show-lessons-page
Route::get('admin/lesson','AdminController@show_lesson_page')->middleware('AdminAuth');
//add-lesson
Route::post('admin/lesson','AdminController@add_lessons')->middleware('AdminAuth');
//remove lesson
Route::get('remove/lesson/{id}','AdminController@remove_lesson')->middleware('AdminAuth');
///////////////edit lesson
//show edit page
Route::get('edit/lesson/{id}','AdminController@edit_lesson_page')->middleware('AdminAuth');
Route::post('edit/lesson/{id}','AdminController@editlesson');
/////////////////////////Teacher///////////////////////////////
///show teacher page 
Route::get('/admin/teacher','AdminController@allteachers')->middleware('AdminAuth');
Route::post('/admin/teacher','AdminController@add_teacher')->middleware('AdminAuth');
//delete teacher
Route::get('/admin/teacher/delete/{id}','AdminController@delete_teacher');
//edit teacher
Route::get('/admin/edit/teacher/{id}','AdminController@show_edit_teacher')->middleware('AdminAuth');
Route::post('/admin/edit/teacher/{id}','AdminController@edit_teacher')->middleware('AdminAuth');
/////////////////////////end Teachers
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************************************************
 ///////////////////////////////////end admin panel /////////////////////////////////////////////////////////
 ///////////////////////////////////start user panel/////////////////////////////////////////////////////////
 ***********************************************************************************************************/
//////show course page 
Route::get('/course/page/{id}','HomeController@show_course_page' );
///////////////////////course video
Route::get('/course/video/{id}','HomeController@course_video' );
Route::post('/course/video/{id}','HomeController@comment_or_question' );
/////////
Route::get('/home', 'HomeController@index')->name('home');

/////////////////search
Route::post('/search', 'HomeController@search');
//////////comment of users 
Route::get('/mycomment/{id}', 'HomeController@show_my_comment');
//////////////questions and answer of users
Route::get('/myquestion/{id}', 'HomeController@show_my_question');


///////////////////////////////////////////////////////end user div///////////////////////////////////////////
///////////////////////start teachers ////////////////////////////////////////////////////////////////
/////////////////////show teacht panel//////////////////////////
Route::get('teacher_panel','AdminController@teacher_page' )->middleware('AdminAuth');
////////////////replycomment
Route::get('reply/{id}','AdminController@replypage' )->middleware('AdminAuth');
Route::post('reply/{id}','AdminController@reply' )->middleware('AdminAuth');
/////////////////answer question
//////////all question
Route::get('questions','AdminController@questions_page' )->middleware('AdminAuth');
Route::get('answer/{id}','AdminController@answerpage' )->middleware('AdminAuth');
Route::post('answer/{id}','AdminController@answerquestion' )->middleware('AdminAuth');
//////////////////////////////test push
Route::get('test', function () {
    return view('push');
    
});




