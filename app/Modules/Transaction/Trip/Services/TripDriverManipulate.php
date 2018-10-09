<?php

namespace App\Modules\Transaction\Trip\Services;

use App\Modules\Transaction\Trip\Contracts\TripDriverManipulateInterface;

use App\Modules\Transaction\Trip\Models\Trip;
use App\Modules\UserAccess\User\Models\Driver;
use App\Modules\Transaction\Trip\Models\TripQueue;
use App\Modules\Transaction\Trip\Models\TripQueueDriver;

class TripDriverManipulate implements TripDriverManipulateInterface
{

	protected $driverObject;

	protected $tripObject;

	protected $tripQueueObject;

	protected $tripQueueDriverObject;

	public function __construct()
	{
		$this->tripObject = new Trip;
		$this->driverObject = new Driver;
		$this->tripQueueObject = new TripQueue;
		$this->tripQueueDriverObject = new TripQueueDriver;
	}

	public function setTripQueueDriverStatus($driverId, $tripQueueId, $statusId)
	{
		$this->tripQueueDriverObject->whereTripQueueId($tripQueueId)->whereDriverId($driverId)->update(['status_id' => $statusId]);
	}

	public function deleteQueuedDriver($driverId, $tripQueueId)
	{
		$this->tripQueueDriverObject->whereTripQueueId($tripQueueId)->where('driver_id', '<>', $driverId)->delete();
	}

	public function setAcceptedTripDriver($driverId, $tripQueueId)
	{
		$this->tripQueueDriverObject->whereTripQueueId($tripQueueId)->whereDriverId($driverId)->update(['status_id' => 3]);
	}

	public function setRejectedTripDriver($driverId, $tripQueueId)
	{
		$this->tripQueueDriverObject->whereTripQueueId($tripQueueId)->whereDriverId($driverId)->update(['status_id' => 4]);
	}

	public function setDriverStatus($driverId, $statusId)
	{
		$this->driverObject->whereUserId($driverId)->update(['status_id' => $statusId]);
	}

}