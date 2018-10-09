<?php

namespace App\Modules\Transaction\Trip\Contracts;

interface ChangeTripStatusInterface
{

	public function changeStatus($tripId, $statusId);

}