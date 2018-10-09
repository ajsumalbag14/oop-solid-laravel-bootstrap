<?php

namespace App\Modules\UserAccess\User\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\UserAccess\User\Models\User;

use App\Modules\UserAccess\User\Observers\UserObserver;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
