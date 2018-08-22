<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/{provider}', 'SocialiteController@redirectToProvider');
Route::get('/login/{provider}/callback', 'SocialiteController@handleProviderCallback');

Route::group(['middleware' => ['auth', 'admin']], function () {

	Route::get('/locations', 'LocationController@index');
	Route::post('/locations', 'LocationController@store');
	Route::delete('/locations/{location}', 'LocationController@destroy');
	Route::get('/locations/{location}', 'LocationController@edit');
	Route::put('/locations/{location}', 'LocationController@update');

	Route::get('/items', 'ItemController@index');
	Route::post('/items', 'ItemController@store');
	Route::delete('/items/{item}', 'ItemController@destroy');
	Route::get('/items/{item}', 'ItemController@edit');
	Route::put('/items/{item}', 'ItemController@update');
    
    Route::get('/items/{item}/prices', 'PriceController@download');

});

Route::group(['middleware' => ['auth']], function () {

	Route::post('/prices', 'PriceController@store');
	Route::delete('/prices/{price}', 'PriceController@destroy');

	Route::get('/monitor', 'MonitorController@index')->name('monitor');

    
});
