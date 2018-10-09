<?php

namespace App\Modules\Transaction\Trip\Services;

use Illuminate\Http\Request;

use App\Modules\Transaction\Trip\Contracts\PrepareTripInterface;

class PrepareTrip implements PrepareTripInterface
{

	protected $currentLongitude;

	protected $currentLatitude;

	public function paramtersToStoreWithCoordinates($tripQueueObject, $currentLongitude, $currentLatitude)
	{
		$handleStoreParameters = [
			'passenger_id'		 => $tripQueueObject->passenger_id,
			'driver_id'			 => $tripQueueObject->driver_id,
			'rate_amount'		 => $tripQueueObject->rate_amount,
			'origin_address'	 => $tripQueueObject->origin_address,
			'origin_longitude'	 => $tripQueueObject->origin_longitude,
			'origin_latitude'	 => $tripQueueObject->origin_latitude,
			'destination_address' => $tripQueueObject->destination_address,

			'destination_longitude'	 => $tripQueueObject->destination_longitude,
			'destination_latitude'	 => $tripQueueObject->destination_latitude,

			'current_longitude'	 => $currentLongitude,
			'current_latitude'   => $currentLatitude,

			'estimated_distance' => $tripQueueObject->estimated_distance,
			'estimated_time'	 => $tripQueueObject->estimated_time,
			'status_id'			 => 1
		];
		return $handleStoreParameters;
	}

	public function paramtersToStore($tripQueueObject)
	{
		$handleStoreParameters = [
			'passenger_id'		 => $tripQueueObject->passenger_id,
			'driver_id'			 => $tripQueueObject->driver_id,
			'rate_amount'		 => $tripQueueObject->rate_amount,
			'origin_address'	 => $tripQueueObject->origin_address,
			'origin_longitude'	 => $tripQueueObject->origin_longitude,
			'origin_latitude'	 => $tripQueueObject->origin_latitude,
			'destination_address' => $tripQueueObject->destination_address,

			'destination_longitude'	 => $tripQueueObject->destination_longitude,
			'destination_latitude'	 => $tripQueueObject->destination_latitude,

			'current_longitude'	 => $this->currentLongitude,
			'current_latitude'   => $this->currentLatitude,

			'estimated_distance' => $tripQueueObject->estimated_distance,
			'estimated_time'	 => $tripQueueObject->estimated_time,
			'status_id'			 => 1
		];
		return $handleStoreParameters;
	}
	
}