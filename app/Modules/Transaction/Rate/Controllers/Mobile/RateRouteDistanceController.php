<?php

namespace App\Modules\Transaction\Rate\Controllers\Mobile;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contracts\ResponseFormatterInterface;
use App\Modules\Transaction\Rate\Contracts\RateRouteDistanceInterface;

class RateRouteDistanceController extends Controller
{

	protected $responseFormatter;

	protected $rateRouteDistance;

	protected $response;

	public function __construct(ResponseFormatterInterface $responseFormatter, RateRouteDistanceInterface $rateRouteDistance)
	{
		$this->responseFormatter = $responseFormatter;
		$this->rateRouteDistance = $rateRouteDistance;
	}

	public function computeCurrentRate(Request $request)
	{
		$this->rateRouteDistance->setRouteDistanceParameters($request);
		$estimatedRateValues = $this->rateRouteDistance->compute();
		$this->response = $this->responseFormatter->prepareSuccessResponseBody($estimatedRateValues);
		return Response::json($this->response, $this->response['code']);
	}

}
