<?php

namespace App\Modules\Transaction\Trip\Contracts;

interface RiderFcmTokenInterface
{

	public function prepareBookRequestBody($tripObject);

}