<?php

/*
|--------------------------------------------------------------------------
|  Module Routes
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'App\Modules\Transaction\Rate\Controllers'], function() {

	Route::group(['prefix' => 'api/mobile/transaction/rate', 'namespace' => 'Mobile'], function() {
		Route::post('compute-route-distance-rate', 'RateRouteDistanceController@computeCurrentRate');
	});

	Route::group(['prefix' => 'api/transaction'], function() {
		Route::resource('rate', 'RateController');
	});

});
