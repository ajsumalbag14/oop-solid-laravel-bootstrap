<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Modules\UserAccess\User\Events\UserCreated' => [
            'App\Modules\UserAccess\User\Listeners\CreateUserDetail',
        ],
        'App\Modules\UserAccess\User\Events\FoundUserDriver' => [
            'App\Modules\UserAccess\User\Listeners\CreateUserDriver',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
