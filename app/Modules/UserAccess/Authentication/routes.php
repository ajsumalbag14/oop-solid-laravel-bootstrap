<?php

/*
|--------------------------------------------------------------------------
|  Module Routes
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'App\Modules\UserAccess\Authentication\Controllers'], function() {

	// MOBILE
	Route::group(['prefix' => 'api/mobile/user-access/auth', 'namespace' => 'Mobile'], function() {
		Route::post('login', 'LoginController@handle');
	});
	// CMS
	Route::group(['prefix' => 'api/user-access/auth'], function() {
		Route::post('login', 'LoginController@handle');
	});

});
