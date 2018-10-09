<?php

namespace App\Modules\Transaction\Trip\Services;

use App\Modules\Transaction\Trip\Contracts\ChangeTripStatusInterface;

use App\Modules\Transaction\Trip\Models\Trip;

class ChangeTripStatus implements ChangeTripStatusInterface
{

	protected $tripObject;

	public function __construct()
	{
		$this->tripObject = new Trip;
	}

	public function changeStatus($tripId, $statusId)
	{
		if ($this->tripObject->find($tripId)) {
			// Update status to IN TRANSITE
			$this->tripObject->find($tripId)->update(['status_id' => $statusId]);
			// Prepare response body
			$result = [
				'status'	=> 1,
				'data'		=> $this->tripObject->find($tripId)
			];
		}
		else {
			$result = [
				'status'	=> 0,
				'message'	=> 'Not found'
			];
		}
		return $result;
	}

}