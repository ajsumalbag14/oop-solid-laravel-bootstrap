<?php

namespace App\Modules\Transaction\Trip\Services;

use App\Modules\Transaction\Trip\Contracts\PrepareTripQueueDriverInterface;

use App\Modules\UserAccess\User\Models\Driver;

use \Carbon\Carbon;

class PrepareTripQueueDriver implements PrepareTripQueueDriverInterface
{

	protected $driverObject;

	public function __construct()
	{
		$this->driverObject = new Driver;
	}

	public function parametersToStore($tripQueueId)
	{
		$handleStoreParameters = [];
		$availableDrivers = $this->driverObject->whereStatusId(2)->get();
		foreach ($availableDrivers as $availableDriver) {
			$handleStoreParameters[] = [
				'trip_queue_id'		=> $tripQueueId,
				'driver_id'			=> $availableDriver->user_id,
				'status_id'			=> 1,
				'created_at'		=> Carbon::now(),
				'updated_at'		=> Carbon::now()
			];
		}
		return $handleStoreParameters;
	}

}