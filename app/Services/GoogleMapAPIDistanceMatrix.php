<?php

namespace App\Services;

use App\Contracts\GoogleMapAPIDistanceMatrixInterface;

use Curl;

class GoogleMapAPIDistanceMatrix implements GoogleMapAPIDistanceMatrixInterface
{

	protected $unit;

	protected $originLong;

	protected $originLat;

	protected $destLong;

	protected $destLat;

	protected $apiKey;

	// protected $urlRequest = 'https://maps.googleapis.com/maps/api/distancematrix/json?';
	protected $urlRequest = 'https://maps.googleapis.com/maps/api/directions/json?mode=driving&departure_time=now';

	public function setUnit($unitValue)
	{
		$this->unit = $unitValue;
	}

	public function setOrigin($originLong, $originLat)
	{
		$this->originLong = $originLong;
		$this->originLat = $originLat;
	}

	public function setDestination($destLong, $destLat)
	{
		$this->destLong = $destLong;
		$this->destLat = $destLat;
	}

	public function setAPIKey($apiKey)
	{
		$this->apiKey = $apiKey;
	}

	public function prepareURLRequest()
	{
		// $this->urlRequest .= 'units='.$this->unit;
		$this->urlRequest .= '&origin='.urlencode($this->originLat.', '.$this->originLong);
		$this->urlRequest .= '&destination='.urlencode($this->destLat.', '.$this->destLong);
		$this->urlRequest .= '&key='.$this->apiKey;
	}

	public function handle()
	{
		$response = Curl::to(urlencode($this->urlRequest))
					->asJson(true)
					->withOption('RETURNTRANSFER','1')
					->withOption('SSL_VERIFYPEER', 'false')
					->withOption('URL', $this->urlRequest)
					->withOption('SSL_VERIFYHOST', 'false')
					->get();
						
		return $response;
	}

}