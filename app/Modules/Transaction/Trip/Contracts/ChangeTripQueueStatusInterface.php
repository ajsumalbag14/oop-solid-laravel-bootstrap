<?php

namespace App\Modules\Transaction\Trip\Contracts;

interface ChangeTripQueueStatusInterface
{

	public function acceptTrip($tripQueueId);

	public function rejectTrip($tripQueueId);

}