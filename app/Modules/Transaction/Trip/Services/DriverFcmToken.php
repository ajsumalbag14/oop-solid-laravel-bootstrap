<?php

namespace App\Modules\Transaction\Trip\Services;

use App\Modules\Transaction\Trip\Contracts\DriverFcmTokenInterface;

class DriverFcmToken implements DriverFcmTokenInterface
{

	protected $requestBody;

	public function prepareBookRequestBody($tripObject)
	{
		$this->requestBody = [
			'title'				=> 'Book from Rider',
			'body'				=> [
				'trip_id' 		=> $tripObject->id,
				'driver_id'		=> $tripObject->driver_id,
				'rate_amount'	=> 'PHP '.$tripObject->rate_amount,
				'name'			=> $tripObject->driver->userDetail->first_name.' '.$tripObject->driver->userDetail->last_name,
				'car_details'	=> $tripObject->driver->driver->car_make.' '.$tripObject->driver->driver->car_model,
				'plate_number'	=> $tripObject->driver->driver->plate_number,
				'time'			=> $tripObject->estimated_time,
				'arrival_time'	=> str_replace(' mins', '', $tripObject->estimated_time),
				// 'user_image'	=> asset('images/'.$tripObject->driver->userDetail->user_image)
				'user_image'	=> 'http://13.250.2.172/UBRE-API/public/images/'.$tripObject->driver->userDetail->user_image
			],
			'content_available' => true
		];
		return $this->requestBody;
	}

}