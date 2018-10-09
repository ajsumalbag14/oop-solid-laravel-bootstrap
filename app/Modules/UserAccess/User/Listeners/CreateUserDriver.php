<?php

namespace App\Modules\UserAccess\User\Listeners;

use App\Modules\UserAccess\User\Events\FoundUserDriver;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateUserDriver
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FoundUserDriver  $event
     * @return void
     */
    public function handle(FoundUserDriver $event)
    {
        //
    }
}
