<?php

/*
|--------------------------------------------------------------------------
|  Module Routes
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'App\Modules\Transaction\Trip\Controllers'], function() {
	// Mobile routes
	Route::group(['namespace' => 'Mobile', 'prefix' => 'api/mobile/transaction/trip'], function() {

		Route::get('simulate-rider-broadcast', 'SimulateDriverBroadcastController@handle');

		// Rider routes
		Route::group(['prefix' => 'rider'], function() {
			Route::post('book', 'RiderTripController@bookTrip');
			Route::post('cancel', 'RiderTripController@cancelTrip');
			Route::get('room', 'RiderTripController@tripRooming');
		});
		// Driver routes
		Route::group(['prefix' => 'driver'], function() {
			Route::get('availability', 'DriverActionController@setAvailable');
			Route::post('accept-trip', 'DriverActionController@acceptTrip');
			Route::post('reject-trip', 'DriverActionController@rejectTrip');
			Route::get('confirm-pick-up', 'DriverActionController@confirmPickUp');
			Route::get('cancel-trip', 'DriverActionController@cancelTrip');
			Route::get('complete-trip', 'DriverActionController@completeTrip');
			Route::put('room', 'DriverActionController@tripRooming');
		});
	});

});
