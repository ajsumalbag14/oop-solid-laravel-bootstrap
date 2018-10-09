<?php

namespace App\Modules\Transaction\Rate\Services;

use Illuminate\Http\Request;

use App\Contracts\GoogleMapAPIDistanceMatrixInterface;
use App\Modules\Transaction\Rate\Contracts\RateRouteDistanceInterface;

use App\Modules\Transaction\Rate\Models\Rate;
use App\Modules\UserAccess\User\Models\User;

class RateRouteDistance implements RateRouteDistanceInterface
{

	protected $ratePerKiloMeter = 30;

	protected $ratePerMinute = 2;

	protected $rateObject;

	protected $userObject;

	protected $userId;

	protected $googleMapDistanceMatrix;

	public function __construct(GoogleMapAPIDistanceMatrixInterface $googleMapDistanceMatrix)
	{
		$this->googleMapDistanceMatrix = $googleMapDistanceMatrix;
		$this->rateObject = new Rate;
		$this->userObject = new User;
	}

	public function setRouteDistanceParameters(Request $request)
	{
		$this->googleMapDistanceMatrix->setUnit('metric');
		$this->googleMapDistanceMatrix->setOrigin($request->get('origin_longitude'), $request->get('origin_latitude'));
		$this->googleMapDistanceMatrix->setDestination($request->get('destination_longitude'), $request->get('destination_latitude'));
		$this->googleMapDistanceMatrix->setAPIKey('AIzaSyAJPMZyJAjA84ubABHYgo2TrJBq1s9RYVg');
		$this->googleMapDistanceMatrix->prepareURLRequest();
		$this->userId = $request->get('user_id');
	}

	// (DISTANCE_KM * RATE_PER_KM) + (MINUTES * RATE_PER_MIN)
	public function compute()
	{
		$userData = $this->userObject->find($this->userId);
		if ($userData) {
			$rateData = $this->rateObject->whereTravelNetworkCompanyId($userData->travel_network_company_id)->first();
			if ($rateData) {
				$this->ratePerKiloMeter = $rateData->rate_per_km;
				$this->ratePerMinute = $rateData->rate_per_minute;
			}
		}

		$googleMapData = $this->googleMapDistanceMatrix->handle();
		$rateAmount = ($this->ratePerKiloMeter * ($googleMapData['routes'][0]['legs'][0]['distance']['value'] / 1000)) + ($this->ratePerMinute * ($googleMapData['routes'][0]['legs'][0]['duration_in_traffic']['value'] / 60));
		// $responseData = [
		// 	'origin_address'		=> $googleMapData['origin_addresses'][0],
		// 	'destination_addresses'	=> $googleMapData['destination_addresses'][0],
		// 	'distance'				=> $googleMapData['rows'][0]['elements'][0]['distance']['text'],
		// 	'minutes'				=> $googleMapData['rows'][0]['elements'][0]['duration']['text'],
		// 	'rate'					=> $rateAmount
		// ];
		$responseData = [
			'origin_address'		=> $googleMapData['routes'][0]['legs'][0]['start_address'],
			'destination_addresses'	=> $googleMapData['routes'][0]['legs'][0]['end_address'],
			'estimated_distance'	=> $googleMapData['routes'][0]['legs'][0]['distance']['text'],
			'estimated_time'		=> $googleMapData['routes'][0]['legs'][0]['duration_in_traffic']['text'],
			'rate_amount'			=> 'PHP '.round ($rateAmount),
			'overview_polyline'		=> $googleMapData['routes'][0]['overview_polyline']['points']
		];
		// echo $googleMapData['destination_addresses'][0];exit;
		return $responseData;
	}

}