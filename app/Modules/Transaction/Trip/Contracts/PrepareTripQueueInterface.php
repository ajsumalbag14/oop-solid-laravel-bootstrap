<?php

namespace App\Modules\Transaction\Trip\Contracts;

use Illuminate\Http\Request;

interface PrepareTripQueueInterface
{

	public function paramtersToStore(Request $request);

}