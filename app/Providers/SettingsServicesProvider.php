<?php

namespace App\Providers;

use App\Models\setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SettingsServicesProvider extends ServiceProvider
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
        // Cache::forget(setting::CACHE_KEY);
        // Config::set("app.name","new one ");
        // Config::set("app.currency","ILS");
        // Config::set("app.locale","ar");
        $settings=Cache::get(setting::CACHE_KEY);
        if(!$settings){
            $settings=Setting::pluck("value",'name');
            Cache::put(setting::CACHE_KEY,$settings);
        }

        foreach($settings as $key=>$value)
        {
            Config::set($key,$value);
            // dd(config::get('app.locale'));
        }
        event('setting.updated');
    }
}
