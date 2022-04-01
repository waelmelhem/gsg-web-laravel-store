<?php

namespace App\Listeners;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatUserLastLoginAt
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
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        try{
            $user=$event->user;
        $user->forceFill([
            'last_login_at'=>Carbon::now(),
        ])->save();
        }
        catch(Throwable $e)
        {
            
        }
    }
}
