<?php

namespace App\Modules\Transaction\Trip\Services;

use App\Modules\Transaction\Trip\Contracts\AssignTripQueueDriverInterface;

use App\Modules\UserAccess\User\Models\Driver;
use App\Modules\Transaction\Trip\Models\TripQueue;
use App\Modules\Transaction\Trip\Models\TripQueueDriver;

class AssignTripQueueDriver implements AssignTripQueueDriverInterface
{

	protected $driverObject;

	protected $tripQueueObject;

	protected $tripQueueDriverObject;

	public function __construct()
	{
		$this->driverObject = new Driver;
		$this->tripQueueObject = new TripQueue;
		$this->tripQueueDriverObject = new TripQueueDriver;
	}

	public function getTripQueueDrivers($tripQueueId)
	{
		$tripQueueDriver = $this->tripQueueDriverObject->whereTripQueueId($tripQueueId)->whereStatusId(1)->first();
		if ($tripQueueDriver) {
			$this->assignDriver($tripQueueId, $tripQueueDriver->driver_id);
			$this->queueTripQueueDriver($tripQueueDriver->id);
			$this->setDriverOnQueue($tripQueueDriver->driver_id);
		}
		else {
			// 
		}
	}

	public function assignDriver($tripQueueId, $driverId)
	{
		$this->tripQueueObject->find($tripQueueId)->update(['driver_id' => $driverId]);
	}

	public function queueTripQueueDriver($tripQueueDriverId)
	{
		$this->tripQueueDriverObject->find($tripQueueDriverId)->update(['status_id' => 2]);
	}

	public function setDriverOnQueue($driverId)
	{
		$this->driverObject->whereUserId($driverId)->update(['status_id' => 3]);
	}

	public function setTripQueueForConfirmation($tripQueueId)
	{
		$this->tripQueueObject->find($tripQueueId)->update(['status_id' => 2]);
	}

}