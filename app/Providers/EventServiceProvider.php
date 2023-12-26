<?php

namespace App\Providers;

use App\Events\PurchaseSuccesful;
use App\Events\ShoppingListActivated;
use App\Events\UnavailableProductInSL;
use App\Listeners\SendActivatedConfirmationEmail;
use App\Listeners\SendPurchaseConfirmationEmail;
use App\Listeners\SendUnavailableProductInSLInformationEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PurchaseSuccesful::class => [
            SendPurchaseConfirmationEmail::class,
        ],
        ShoppingListActivated::class => [
            SendActivatedConfirmationEmail::class,
        ],
        UnavailableProductInSL::class => [
            SendUnavailableProductInSLInformationEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
