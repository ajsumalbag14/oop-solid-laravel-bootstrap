<?php

namespace App\Modules\UserAccess\Authentication\Services;

use App\Modules\UserAccess\Authentication\Contracts\AuthFormatInterface;

class AuthMobileFormat implements AuthFormatInterface
{

	public function prepare($objectData)
	{
		$responseFormat = [
			'id'						=> $objectData->id,
			'travel_network_company_id'	=> $objectData->travel_network_company_id,
			'user_type_id'				=> $objectData->user_type_id,
			'email'						=> $objectData->email,
			'fcm_token'					=> $objectData->fcm_token,
			'first_name'				=> $objectData->userDetail->first_name,
			'last_name'					=> $objectData->userDetail->last_name,
			'contact_number'			=> $objectData->userDetail->contact_number,
			'user_image'				=> asset('images/'.$objectData->userDetail->user_image),
			'is_active'					=> $objectData->is_active,
			'points'					=> '5000'
		];
		if ($objectData->user_type_id == 2) {
			$responseFormat['plate_number'] = $objectData->driver->plate_number;
			$responseFormat['car_make'] = $objectData->driver->car_make;
			$responseFormat['car_model'] = $objectData->driver->car_model;
			$responseFormat['status_id'] = $objectData->driver->status_id;
		}
		return $responseFormat;
	}

}