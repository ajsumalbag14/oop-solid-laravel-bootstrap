<?php

namespace App\Modules\Transaction\Trip\Services;

use App\Modules\Transaction\Trip\Contracts\RiderFcmTokenInterface;

class RiderFcmToken implements RiderFcmTokenInterface
{

	protected $requestBody;

	public function prepareBookRequestBody($tripObject)
	{
		$this->requestBody = [
			'title'				=> 'Book from Rider',
			'body'				=> [
				'trip_id'	 	=> $tripObject->id,
				'name'			=> $tripObject->rider->userDetail->first_name.' '.$tripObject->rider->userDetail->last_name,
				'rate_amount'	=> 'PHP '. $tripObject->rate_amount,
				'origin'		=> $tripObject->origin_address,
				'destination'	=> $tripObject->destination_address,
				'distance'		=> $tripObject->estimated_distance,
				'time'			=> $tripObject->estimated_time,
				'arrival_time'	=> str_replace(' mins', '', $tripObject->estimated_time),
				'user_image'	=> ('http://13.250.2.172/UBRE-API/public/images/'.$tripObject->rider->userDetail->user_image)
			],
			'content_available' => true
		];
		return $this->requestBody;
	}

}