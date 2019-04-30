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
Route::get('/home', 'HomeController@index')->name('home');
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