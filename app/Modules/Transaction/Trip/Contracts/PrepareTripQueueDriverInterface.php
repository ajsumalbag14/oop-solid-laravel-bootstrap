<?php

namespace App\Modules\Transaction\Trip\Contracts;

interface PrepareTripQueueDriverInterface
{
	
	public function parametersToStore($tripQueueId);

}