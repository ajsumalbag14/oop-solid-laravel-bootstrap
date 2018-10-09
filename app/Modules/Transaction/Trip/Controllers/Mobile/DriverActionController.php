<?php

namespace App\Modules\Transaction\Trip\Controllers\Mobile;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contracts\FirebaseHandlerInterface;
use App\Contracts\ResponseFormatterInterface;
use App\Modules\Transaction\Trip\Contracts\ChangeTripQueueStatusInterface;
use App\Modules\Transaction\Trip\Contracts\PrepareTripInterface;
use App\Modules\Transaction\Trip\Contracts\TripDriverManipulateInterface;
use App\Modules\Transaction\Trip\Contracts\DriverFcmTokenInterface;
use App\Modules\Transaction\Trip\Contracts\AssignTripQueueDriverInterface;
use App\Modules\Transaction\Trip\Contracts\TripQueueNotificationInterface;
use App\Modules\Transaction\Trip\Contracts\ChangeTripStatusInterface;

use App\Modules\Transaction\Trip\Models\Trip;
use App\Modules\UserAccess\User\Models\Driver;
use App\Modules\Transaction\Trip\Models\TripQueue;
use App\Modules\Transaction\Trip\Models\TripQueueDriver;

class DriverActionController extends Controller
{

	protected $responseFormatter;

	protected $response;

	protected $tripObject;

	protected $tripQueueObject;

	protected $tripQueueDriverObject;

	protected $changeTripQueueStatus;

	protected $changeTripStatus;

	protected $prepareTripParameters;

	protected $tripDriverManipulate;

	protected $driverFcmToken;

	protected $firebaseHandler;

	protected $driverObject;

	protected $assignQueueDriver;

	protected $tripQueueNotif;

	public function __construct(ResponseFormatterInterface $responseFormatter, ChangeTripQueueStatusInterface $changeTripQueueStatus, PrepareTripInterface $prepareTripParameters, TripDriverManipulateInterface $tripDriverManipulate, DriverFcmTokenInterface $driverFcmToken, FirebaseHandlerInterface $firebaseHandler, AssignTripQueueDriverInterface $assignQueueDriver, TripQueueNotificationInterface $tripQueueNotif, ChangeTripStatusInterface $changeTripStatus)
	{
		$this->responseFormatter = $responseFormatter;
		$this->changeTripQueueStatus = $changeTripQueueStatus;
		$this->prepareTripParameters = $prepareTripParameters;
		$this->tripDriverManipulate = $tripDriverManipulate;
		$this->driverFcmToken = $driverFcmToken;
		$this->firebaseHandler = $firebaseHandler;
		$this->assignQueueDriver = $assignQueueDriver;
		$this->tripQueueNotif = $tripQueueNotif;
		$this->changeTripStatus = $changeTripStatus;
		$this->tripObject = new Trip;
		$this->driverObject = new Driver;
		$this->tripQueueObject = new TripQueue;
		$this->tripQueueDriverObject = new TripQueueDriver;
	}

	public function setAvailable(Request $request)
	{
		if ($this->driverObject->whereUserId($request->get('driver_id'))->first()) {
			// Update status
			$this->tripDriverManipulate->setDriverStatus($request->get('driver_id'), $request->get('status_id'));
			// Prepare response
			$this->response = $this->responseFormatter->prepareSuccessResponseBody($this->driverObject->whereUserId($request->get('driver_id'))->first());
		}
		else {
			$this->response = $this->responseFormatter->prepareNotFoundResponseBody();
		}
		return Response::json($this->response, $this->response['code']);
	}

	public function acceptTrip(Request $request)
	{
		// Set status of trip_queue to accepted
		$tripQueueStatus = $this->changeTripQueueStatus->acceptTrip($request->get('trip_id'));
		if ($tripQueueStatus['status'] == 1) {
			$tripQueue = $this->tripQueueObject->find($request->get('trip_id'));
			// From trip_queue to trip
			// Prepare trip parameters
			// $this->prepareTripParameters->setCoordinates(($request->has('current_longitude') ? $request->get('current_longitude') : ''), ($request->has('current_latitude') ? $request->get('current_latitude') : ''));
			// $tripStoreParameters = $this->prepareTripParameters->paramtersToStore($tripQueue);
			$tripStoreParameters = $this->prepareTripParameters->paramtersToStoreWithCoordinates($tripQueue, ($request->has('current_longitude') ? $request->get('current_longitude') : ''), ($request->has('current_latitude') ? $request->get('current_latitude') : ''));
			// Store new trip
			$tripObject = $this->tripObject->create($tripStoreParameters);
			// delete all trip_queue_driver using trip_queue_id
			$this->tripDriverManipulate->deleteQueuedDriver($tripStoreParameters['driver_id'], $request->get('trip_id'));
			$this->tripDriverManipulate->setAcceptedTripDriver($tripStoreParameters['driver_id'], $request->get('trip_id'));
			// Set status of driver accecpted to 4
			$this->tripDriverManipulate->setDriverStatus($tripStoreParameters['driver_id'], 4);
			// Send push notification
			$driverFcmRequest = $this->driverFcmToken->prepareBookRequestBody($tripObject);
			$driverRequestBodyPrepare = $this->firebaseHandler->prepareRequestBody($driverFcmRequest, env('FCM_AUTH_KEY'), $tripObject->rider->fcm_token, 2);
			$driverSubmitFcmResult = $this->firebaseHandler->submitRequest();
			// Prepare response body
			$this->response = $this->responseFormatter->prepareSuccessResponseBody($tripObject);
		}
		else {
			$this->response = $this->responseFormatter->prepareNotFoundResponseBody();
		}
		return Response::json($this->response, $this->response['code']);
	}

	public function rejectTrip(Request $request)
	{
		$this->tripDriverManipulate->setTripQueueDriverStatus($request->get('driver_id'), $request->get('trip_id'), 4);
		// Set status_id of trip_queue to 0
		$tripQueueStatus = $this->changeTripQueueStatus->rejectTrip($request->get('trip_id'));
		// Set trip_queue_driver to 4
		$this->tripDriverManipulate->setRejectedTripDriver($request->get('driver_id'), $request->get('trip_id'));
		// Set driver status_id to 4
		$this->tripDriverManipulate->setDriverStatus($request->get('driver_id'), 2);
		// Set status_id of trip_queue to 1
		$tripQueueStatus = $this->changeTripQueueStatus->pendingTrip($request->get('trip_id'));
		// Assign driver to trip_queue
		$this->assignQueueDriver->getTripQueueDrivers($request->get('trip_id'));
		// Prepare response content
		$tripQueue = $this->tripQueueObject->find($request->get('trip_id'));

		// Prepare response body
		$this->response = $this->responseFormatter->prepareSuccessResponseBody($tripQueue);

		return Response::json($this->response, $this->response['code']);
	}

	public function confirmPickUp(Request $request)
	{
		$confirmResult = $this->changeTripStatus->changeStatus($request->get('trip_id'), 2);
		if ($confirmResult['status'] == 1) {
			$this->response = $this->responseFormatter->prepareSuccessResponseBody($confirmResult['data']);
		}
		else {
			$this->response = $this->responseFormatter->prepareNotFoundResponseBody();
		}
		return Response::json($this->response, $this->response['code']);
	}

	public function cancelTrip(Request $request)
	{
		$confirmResult = $this->changeTripStatus->changeStatus($request->get('trip_id'), 5);
		if ($confirmResult['status'] == 1) {
			// Set status_of trip_queue_driver to REJECTED 
			$this->tripDriverManipulate->setTripQueueDriverStatus($request->get('driver_id'), $request->get('trip_id'), 4);
			// Set status_id of trip_queue to 1
			$tripQueueStatus = $this->changeTripQueueStatus->cancelTrip($request->get('trip_id'));
			// Assign driver to trip_queue
			$this->assignQueueDriver->getTripQueueDrivers($request->get('trip_id'));
			// Set driver status_id to 2
			$this->tripDriverManipulate->setDriverStatus($request->get('driver_id'), 2);
			// Prepare response body
			$this->response = $this->responseFormatter->prepareSuccessResponseBody($confirmResult['data']);
		}
		else {
			$this->response = $this->responseFormatter->prepareNotFoundResponseBody();
		}
		return Response::json($this->response, $this->response['code']);
	}

	public function completeTrip(Request $request)
	{
		$confirmResult = $this->changeTripStatus->changeStatus($request->get('trip_id'), 3);
		if ($confirmResult['status'] == 1) {
			// Set driver status_id to 2
			$this->tripDriverManipulate->setDriverStatus($request->get('driver_id'), 2);
			// Prepare response body
			$this->response = $this->responseFormatter->prepareSuccessResponseBody($confirmResult['data']);
		}
		else {
			$this->response = $this->responseFormatter->prepareNotFoundResponseBody();
		}
		return Response::json($this->response, $this->response['code']);
	}

	public function tripRooming(Request $request)
	{
		if ($this->tripObject->find($request->get('trip_id'))) {
			// Update longitude, latitude
			$this->tripObject->whereId($request->get('trip_id'))->update([
				'current_longitude'		=> $request->get('current_longitude'),
				'current_latitude'		=> $request->get('current_latitude')
			]);
			// Prepare response body
			$this->response = $this->responseFormatter->prepareSuccessResponseBody($this->tripObject->find($request->get('trip_id')));
		}
		else {
			$this->response = $this->responseFormatter->prepareNotFoundResponseBody();
		}
		return Response::json($this->response, $this->response['code']);
	}

}
