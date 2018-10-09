<?php

/*
|--------------------------------------------------------------------------
|  Module Routes
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'App\Modules\UserAccess\User\Controllers'], function() {

	// CMS routes
	Route::group(['prefix' => 'api/user-access'], function() {

		Route::resource('user', 'UserController');
		
	});

});
