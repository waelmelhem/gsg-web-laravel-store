<?php

namespace App\Providers;

use App\Events\OrderCreated;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\UpdateCartUserId;
use App\Listeners\DeleteCard_logOut;
use App\Listeners\ClearSettingChache;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\UpdatUserLastLoginAt;
use App\Notifications\orderNotification;
use App\Listeners\SendOrderCreatedNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class=> [
            UpdateCartUserId::class,
            UpdatUserLastLoginAt::class,
        ],
        Logout::class=>[
            DeleteCard_logOut::class,
        ],
        OrderCreated::class=>[
            SendOrderCreatedNotification::class
        ],
        'setting.updated'=>[
            ClearSettingChache::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
