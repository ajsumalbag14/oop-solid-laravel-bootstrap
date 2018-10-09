<?php

namespace App\Modules\Transaction\Trip\Contracts;

interface DriverFcmTokenInterface
{
	
	public function prepareBookRequestBody($tripObject);

}