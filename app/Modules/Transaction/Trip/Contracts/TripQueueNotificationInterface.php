<?php

namespace App\Modules\Transaction\Trip\Contracts;

interface TripQueueNotificationInterface
{

	public function getListAndSend();

}