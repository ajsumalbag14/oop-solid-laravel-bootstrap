<?php

namespace App\Modules\Transaction\Trip\Contracts;

interface TripDriverManipulateInterface
{

	public function deleteQueuedDriver($driverId, $tripQueueId);

	public function setAcceptedTripDriver($driverId, $tripQueueId);

	public function setRejectedTripDriver($driverId, $tripQueueId);

	public function setDriverStatus($driverId, $statusId);

}