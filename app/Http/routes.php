<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});


// route to show the home page
Route::get('/', array('uses' => 'HomeController@showHome'));
// route to show the dash
Route::get('/dashboard', array('uses' => 'HomeController@showDashboard'));
// route to show the final page
Route::get('/esito', array('uses' => 'HomeController@showEsito'));
// route to show the login form
Route::get('login', array('uses' => 'SociController@showLogin'));
// route to process the form
Route::post('login', array('uses' => 'SociController@doLogin'));
// route to get soci candidati
Route::get('soci/candidati','SociController@getSociCandidati');
//route to save votes
Route::post('soci/voto', array('uses' => 'VotiController@store'));
//route resource for Soci
Route::resource('soci', 'SociController');
//route resource for Sedi
Route::resource('sedi', 'SediController');
//route resource for CDC
Route::resource('cdc', 'CDCController');