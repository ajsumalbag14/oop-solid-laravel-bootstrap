<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\ResourceInterface', 'App\Services\Resource');
        $this->app->bind('App\Contracts\ModelMapperInterface', 'App\Services\ModelMapper');
        $this->app->bind('App\Contracts\FirebaseHandlerInterface', 'App\Services\FirebaseHandler');
        $this->app->bind('App\Contracts\ResponseFormatterInterface', 'App\Services\ResponseFormatter');
        $this->app->bind('App\Contracts\PrepareModelFieldValueInterface', 'App\Services\PrepareModelFieldValue');
        $this->app->bind('App\Contracts\GoogleMapAPIDistanceMatrixInterface', 'App\Services\GoogleMapAPIDistanceMatrix');
    }
}
