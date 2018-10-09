<?php

namespace App\Modules\Transaction\Trip\Providers;

use Illuminate\Support\ServiceProvider;

class TripServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('App\Modules\Transaction\Trip\Contracts\RiderFcmTokenInterface', 'App\Modules\Transaction\Trip\Services\RiderFcmToken');
        $this->app->bind('App\Modules\Transaction\Trip\Contracts\DriverFcmTokenInterface', 'App\Modules\Transaction\Trip\Services\DriverFcmToken');
        $this->app->bind('App\Modules\Transaction\Trip\Contracts\PrepareTripQueueInterface', 'App\Modules\Transaction\Trip\Services\PrepareTripQueue');
        $this->app->bind('App\Modules\Transaction\Trip\Contracts\PrepareTripInterface', 'App\Modules\Transaction\Trip\Services\PrepareTrip');
        $this->app->bind('App\Modules\Transaction\Trip\Contracts\PrepareTripQueueDriverInterface', 'App\Modules\Transaction\Trip\Services\PrepareTripQueueDriver');
        $this->app->bind('App\Modules\Transaction\Trip\Contracts\AssignTripQueueDriverInterface', 'App\Modules\Transaction\Trip\Services\AssignTripQueueDriver');
        $this->app->bind('App\Modules\Transaction\Trip\Contracts\TripQueueNotificationInterface', 'App\Modules\Transaction\Trip\Services\TripQueueNotification');
        $this->app->bind('App\Modules\Transaction\Trip\Contracts\ChangeTripQueueStatusInterface', 'App\Modules\Transaction\Trip\Services\ChangeTripQueueStatus');
        $this->app->bind('App\Modules\Transaction\Trip\Contracts\TripDriverManipulateInterface', 'App\Modules\Transaction\Trip\Services\TripDriverManipulate');
        $this->app->bind('App\Modules\Transaction\Trip\Contracts\ChangeTripStatusInterface', 'App\Modules\Transaction\Trip\Services\ChangeTripStatus');
                
    }
}
