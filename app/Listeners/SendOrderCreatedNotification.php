<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\orderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCreatedNotification
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
    public function handle($event)
    {
        $order =$event->order;
        $user=User::find(1);
        $user->notify(new orderNotification($order));
        
    }
}
