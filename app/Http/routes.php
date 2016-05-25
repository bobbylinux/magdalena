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

Route::get('/voti', 'VotiController@index');

//route to get ship

Route::group(['middleware' => 'admin'], function () {
    Route::get('voti/votanti/{id}', array('uses' => 'VotiController@votanti'));
    Route::get('voti/votanti/sede/{id}', array('uses' => 'VotiController@votantiSede'));
    Route::get('voti/votanti/cdc/{id}', array('uses' => 'VotiController@votantiCDC'));
    Route::get('voti/classifica/{id}', array('uses' => 'VotiController@classifica'));
});

Route::get('soci/search','SociController@searchSocio');
Route::get('cdc/search','CDCController@searchCDC');
Route::get('voti/votanti_cdc/search','VotiController@searchVotantiCDC');
// route to get soci candidati
Route::get('soci/candidati','SociController@getSociCandidati');
//route to save votes
Route::post('soci/voto', array('uses' => 'VotiController@store'));
//route to get max min votes
Route::get('soci/voto/valida', array('uses' => 'VotiController@valida'));
//route resource for Soci
Route::resource('soci', 'SociController');
//route resource for Sedi
Route::resource('sedi', 'SediController');
//route resource for CDC
Route::resource('cdc', 'CDCController');
//route resource for Date Riferimento Votazioni
Route::resource('dateriferimento', 'DateRiferimentoController');