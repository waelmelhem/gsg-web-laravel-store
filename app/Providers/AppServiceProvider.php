<?php

namespace App\Providers;

use Illuminate\Support\Str;
use PayPalHttp\Environment;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;
use App\Repositories\cart\CartRepository;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use App\Repositories\cart\DatabaseRepository;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('cart.cookie_id', function () {
            $cookie_id = Cookie::get('cart_id');
            if (!$cookie_id) {
                $cookie_id = Str::uuid();
                Cookie::queue('cart_id', $cookie_id, 24 * 30 * 60);
            }
            return $cookie_id;
        });
        $this->app->bind(CartRepository::class, function ($app) {
            return new DatabaseRepository($app->make('cart.cookie_id'));
        });
        $this->app->singleton("paypal.client", function ($app) {

            $clientId = config("services.paypal.client_id");
            $clientSecret = config("services.paypal.client_secret");
            if(config("services.paypal.env")=="sandbox"){
                $environment = new SandboxEnvironment($clientId, $clientSecret);
            }
            else{
                $environment=new Environment($clientId, $clientSecret);
            }
            
            $client = new PayPalHttpClient($environment);
            return $client;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        // App::setLocale(request('lang',"ar"));
    }
}
