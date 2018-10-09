<?php

namespace App\Modules\Transaction\Trip\Contracts;

interface PrepareTripInterface
{

	public function paramtersToStore($tripQueueObject);

}