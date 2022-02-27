<?php

namespace App\Providers;

use App\Repositories\cart\CartRepository;
use App\Repositories\cart\DatabaseRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

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
            $cookie_id=Cookie::get('cart_id');
            if(!$cookie_id){
                $cookie_id=Str::uuid();
                Cookie::queue('cart_id',$cookie_id,24*30*60);
            }
            return $cookie_id;
        });
        $this->app->bind(CartRepository::class,function($app){
            return new DatabaseRepository($app->make('cart.cookie_id'));
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
    }
}
