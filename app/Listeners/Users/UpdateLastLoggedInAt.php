<?php

namespace App\Listeners\Users;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateLastLoggedInAt
{
    /**
     * Create the event listener.
     */

    public function __construct()
    {
        //
    }


    /**
     * Handle the event.
     *
     * This function update last login time in user's table.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->last_logged_in_at = Carbon::now();
	    $event->user->save();
    }

}
