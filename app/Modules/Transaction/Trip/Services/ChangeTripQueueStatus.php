<?php

namespace App\Modules\Transaction\Trip\Services;

use App\Modules\Transaction\Trip\Contracts\ChangeTripQueueStatusInterface;

use App\Modules\Transaction\Trip\Models\TripQueue;

class ChangeTripQueueStatus implements ChangeTripQueueStatusInterface
{

	protected $tripQueueObject;

	public function __construct()
	{
		$this->tripQueueObject = new TripQueue;
	}

	public function pendingTrip($tripQueueId)
	{
		if ($this->tripQueueObject->find($tripQueueId)) {
			// Update
			$this->tripQueueObject->find($tripQueueId)->update(['status_id' => 1]);
			// Prepare result
			$result = [
				'status'	=> 1,
				'data'		=> $this->tripQueueObject->find($tripQueueId)
			];
		}
		else {
			$result = [
				'status'	=> 2,
				'message'	=> 'Not found'
			];
		}
		return $result;
	}

	public function acceptTrip($tripQueueId)
	{
		if ($this->tripQueueObject->find($tripQueueId)) {
			// Update
			$this->tripQueueObject->find($tripQueueId)->update(['status_id' => 3]);
			// Prepare result
			$result = [
				'status'	=> 1,
				'data'		=> $this->tripQueueObject->find($tripQueueId)
			];
		}
		else {
			$result = [
				'status'	=> 2,
				'message'	=> 'Not found'
			];
		}
		return $result;
	}

	public function rejectTrip($tripQueueId)
	{
		if ($this->tripQueueObject->find($tripQueueId)) {
			// Update
			$this->tripQueueObject->find($tripQueueId)->update(['status_id' => 0]);
			// Prepare result
			$result = [
				'status'	=> 1,
				'data'		=> $this->tripQueueObject->find($tripQueueId)
			];
		}
		else {
			$result = [
				'status'	=> 2,
				'message'	=> 'Not found'
			];
		}
		return $result;
	}

	public function cancelTrip($tripQueueId)
	{
		if ($this->tripQueueObject->find($tripQueueId)) {
			// Update
			$this->tripQueueObject->find($tripQueueId)->update(['status_id' => 4]);
			// Prepare result
			$result = [
				'status'	=> 1,
				'data'		=> $this->tripQueueObject->find($tripQueueId)
			];
		}
		else {
			$result = [
				'status'	=> 2,
				'message'	=> 'Not found'
			];
		}
		return $result;
	}

}