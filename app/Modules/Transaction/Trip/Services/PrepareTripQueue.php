<?php

namespace App\Modules\Transaction\Trip\Services;

use Illuminate\Http\Request;

use App\Modules\Transaction\Trip\Contracts\PrepareTripQueueInterface;

class PrepareTripQueue implements PrepareTripQueueInterface
{

	public function paramtersToStore(Request $request)
	{
		$rateAmount = str_replace('PHP ', '', $request->get('rate'));
		$handleStoreParameters = [
			'passenger_id'		 => $request->get('passenger_id'),
			'driver_id'			 => 0,
			'rate_amount'		 => floatval($rateAmount),
			'origin_address'	 => $request->get('origin_address'),
			'origin_longitude'	 => $request->has('origin_longitude') ? $request->get('origin_longitude') : '',
			'origin_latitude'	 => $request->has('origin_latitude') ? $request->get('origin_latitude') : '',
			'destination_address'   => $request->get('destination_address'),
			'destination_longitude' => $request->has('destination_longitude') ? $request->get('destination_longitude') : '',
			'destination_latitude'  => $request->has('destination_latitude') ? $request->get('destination_latitude') : '',
			'estimated_distance' => $request->get('estimated_distance'),
			'estimated_time'	 => $request->get('estimated_time'),
			'status_id'			 => 1
		];
		return $handleStoreParameters;
	}

}