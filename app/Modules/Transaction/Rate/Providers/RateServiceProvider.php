<?php

namespace App\Modules\Transaction\Rate\Providers;

use Illuminate\Support\ServiceProvider;

class RateServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Modules\Transaction\Rate\Contracts\RateRouteDistanceInterface', 'App\Modules\Transaction\Rate\Services\RateRouteDistance');
    }
}
