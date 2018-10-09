<?php

namespace App\Modules\Transaction\Trip\Controllers\Mobile;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contracts\FirebaseHandlerInterface;
use App\Contracts\ResponseFormatterInterface;
use App\Modules\Transaction\Trip\Contracts\PrepareTripQueueInterface;
use App\Modules\Transaction\Trip\Contracts\RiderFcmTokenInterface;
use App\Modules\Transaction\Trip\Contracts\PrepareTripQueueDriverInterface;
use App\Modules\Transaction\Trip\Contracts\AssignTripQueueDriverInterface;
use App\Modules\Transaction\Trip\Contracts\ChangeTripStatusInterface;

use App\Modules\Transaction\Trip\Models\Trip;
use App\Modules\Transaction\Trip\Models\TripQueue;
use App\Modules\Transaction\Trip\Models\TripQueueDriver;

class RiderTripController extends Controller
{

	protected $responseFormatter;

	protected $response;

	protected $prepareTripQueue;

	protected $tripObject;

	protected $tripQueueObject;

	protected $tripQueueDriverObject;

	protected $riderFcm;

	protected $firebaseHandler;

	protected $prepareTripQueueDriver;

	protected $assignTripQueueDriver;

	public function __construct(ResponseFormatterInterface $responseFormatter, PrepareTripQueueInterface $prepareTripQueue, RiderFcmTokenInterface $riderFcm, FirebaseHandlerInterface $firebaseHandler, PrepareTripQueueDriverInterface $prepareTripQueueDriver, AssignTripQueueDriverInterface $assignTripQueueDriver, ChangeTripStatusInterface $changeTripStatus)
	{
		$this->responseFormatter = $responseFormatter;
		$this->prepareTripQueue = $prepareTripQueue;
		$this->riderFcm = $riderFcm;
		$this->firebaseHandler = $firebaseHandler;
		$this->prepareTripQueueDriver = $prepareTripQueueDriver;
		$this->assignTripQueueDriver = $assignTripQueueDriver;
		$this->changeTripStatus = $changeTripStatus;
		$this->tripObject = new Trip;
		$this->tripQueueObject = new TripQueue;
		$this->tripQueueDriverObject = new TripQueueDriver;
	}

	public function bookTrip(Request $request)
	{
		// Prepare and store trip queue in database
		$tripQueueStoreParamaters = $this->prepareTripQueue->paramtersToStore($request);
		$tripQueueStored = $this->tripQueueObject->create($tripQueueStoreParamaters);
		if ($tripQueueStored) {
			// Insert into trip_queue_driver
			$tripQueueDriverParamaters = $this->prepareTripQueueDriver->parametersToStore($tripQueueStored->id);
			$this->tripQueueDriverObject->insert($tripQueueDriverParamaters);
			// Assign trip queue driver
			$this->assignTripQueueDriver->getTripQueueDrivers($tripQueueStored->id);
			// Prepare response content
			$responseContent = $tripQueueStored->toArray();
			$responseContent['available_drivers'] = count($tripQueueDriverParamaters);
			// Prepare response body
			$this->response = $this->responseFormatter->prepareSuccessResponseBody($responseContent);
		}
		else {
			$this->response = $this->responseFormatter->prepareErrorResponseBody();
		}
		return Response::json($this->response, $this->response['code']);
	}

	public function cancelTrip(Request $request)
	{
		$confirmResult = $this->changeTripStatus->changeStatus($request->get('trip_id'), 5);
	}

	public function tripRooming(Request $request)
	{
		$currentTrip = $this->tripObject->find($request->get('trip_id'));
		if ($currentTrip) {
			// Prepare response body
			$this->response = $this->responseFormatter->prepareSuccessResponseBody($currentTrip);
		}
		else {
			$this->response = $this->responseFormatter->prepareNotFoundResponseBody();
		}
		return Response::json($this->response, $this->response['code']);
	}

}
