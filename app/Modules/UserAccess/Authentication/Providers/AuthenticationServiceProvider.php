<?php

namespace App\Modules\UserAccess\Authentication\Providers;

use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider
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

        $this->app->bind('App\Modules\UserAccess\Authentication\Contracts\AuthenticateCredentialsInterface', 'App\Modules\UserAccess\Authentication\Services\AuthenticateCredentials');
        $this->app->bind('App\Modules\UserAccess\Authentication\Contracts\FcmTokenInterface', 'App\Modules\UserAccess\Authentication\Services\FcmToken');

        // $this->app->when(\App\Modules\UserAccess\Authentication\Controllers\Mobile\LoginController::class)
        //         ->needs(\App\Modules\UserAccess\Authentication\Contracts\AuthFormatInterface::class)
        //         ->give(\App\Modules\UserAccess\Authentication\Services\AuthMobileFormat::class);

        $this->app->bind('App\Modules\UserAccess\Authentication\Contracts\AuthFormatInterface', 'App\Modules\UserAccess\Authentication\Services\AuthMobileFormat');
                
    }
}
