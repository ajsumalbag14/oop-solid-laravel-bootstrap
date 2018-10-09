<?php

namespace App\Modules\Transaction\Trip\Contracts;

interface AssignTripQueueDriverInterface
{

	public function getTripQueueDrivers($tripQueueId);

	public function assignDriver($tripQueueId, $driverId);

	public function queueTripQueueDriver($tripQueueDriverId);

	public function setDriverOnQueue($driverId);

	public function setTripQueueForConfirmation($triQueueId);

}