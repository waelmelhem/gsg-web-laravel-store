<?php

namespace App\Providers;

use App\services\IpStack;
use Illuminate\Support\ServiceProvider;

class IpStackServicProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // (IpStack::get('147.189.184.226'));
        //add configration depending in the IP of user
    }
}
