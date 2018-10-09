<?php

namespace App\Contracts;

interface GoogleMapAPIDistanceMatrixInterface
{

	public function setUnit($unitValue);

	public function setOrigin($originLong, $originLat);

	public function setDestination($destLong, $destLat);

	public function setAPIKey($apiKey);

	public function prepareURLRequest();

	public function handle();

}