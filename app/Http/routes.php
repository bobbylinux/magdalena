<?php


// route to show the home page
Route::get('/', array('uses' => 'HomeController@showHome'));
// route to show the dash
Route::get('/dashboard', array('uses' => 'HomeController@showDashboard'));
// route to show the final page
Route::get('/esito', array('uses' => 'HomeController@showEsito'));

//login routes
Route::post('/login', array('uses' => 'Auth\AuthController@postLogin'));
Route::get('/login', 'Auth\AuthController@getLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

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