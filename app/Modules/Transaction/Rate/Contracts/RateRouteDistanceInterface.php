<?php

namespace App\Modules\Transaction\Rate\Contracts;

use Illuminate\Http\Request;

interface RateRouteDistanceInterface
{

	public function setRouteDistanceParameters(Request $request);

	public function compute();

}