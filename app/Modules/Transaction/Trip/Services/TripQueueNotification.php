<?php

namespace App\Modules\Transaction\Trip\Services;

use App\Contracts\FirebaseHandlerInterface;
use App\Modules\Transaction\Trip\Contracts\TripQueueNotificationInterface;
use App\Modules\Transaction\Trip\Contracts\AssignTripQueueDriverInterface;
use App\Modules\Transaction\Trip\Contracts\RiderFcmTokenInterface;

use App\Modules\Transaction\Trip\Models\TripQueue;

class TripQueueNotification implements TripQueueNotificationInterface
{

	protected $tripQueueObject;

	protected $riderFcmToken;

	protected $firebaseHandler;

	protected $assignTripQueue;

	public function __construct(RiderFcmTokenInterface $riderFcmToken, FirebaseHandlerInterface $firebaseHandler, AssignTripQueueDriverInterface $assignTripQueue)
	{
		$this->tripQueueObject = new TripQueue;
		$this->riderFcmToken = $riderFcmToken;
		$this->firebaseHandler = $firebaseHandler;
		$this->assignTripQueue = $assignTripQueue;
	}

	public function getListAndSend()
	{
		$tripQueueList = $this->tripQueueObject->whereStatusId(1)->where('driver_id', '>', 0)->get();
		foreach ($tripQueueList as $tripQueue) {
			// Prepare FCM request body
			$riderRequestFcm = $this->riderFcmToken->prepareBookRequestBody($tripQueue);
			// Prepare FCM parameters
			$riderRequestFcmPrepare = $this->firebaseHandler->prepareRequestBody($riderRequestFcm, env('FCM_AUTH_KEY'), $tripQueue->driver->fcm_token, 1);
			// Submit request to FCM
			$riderSubmitFcmResult = $this->firebaseHandler->submitRequest();
			// Set status of queue trip for confirmation
			$this->assignTripQueue->setTripQueueForConfirmation($tripQueue->id);
print_r($riderSubmitFcmResult);exit;
			// return $riderSubmitFcmResult;
		}
	}

}