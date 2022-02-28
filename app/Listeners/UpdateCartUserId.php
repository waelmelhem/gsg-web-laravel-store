<?php

namespace App\Listeners;

use App\Models\cart;
use App\Repositories\cart\CartRepository;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class UpdateCartUserId
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $id=$event->user->id;
        $cart=App::make(CartRepository::class);
        if(method_exists($cart,'setUserId')){
            $cart->setUserId($id);
        }
    }
}
