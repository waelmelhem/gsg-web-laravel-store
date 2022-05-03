<?php

namespace App\Listeners;

use App\Models\setting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class ClearSettingChache
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
    public function handle()
    {
        // dd("hha");
        Cache::forget(setting::CACHE_KEY);
    }
}
