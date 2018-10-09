<?php

namespace App\Modules\Transaction\Trip\Controllers\Mobile;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Console\Commands\SendBookingNotificationToDriver;

class SimulateDriverBroadcastController extends Controller
{

	public function handle()
	{
		\Artisan::call('driver:push');
	}

}
