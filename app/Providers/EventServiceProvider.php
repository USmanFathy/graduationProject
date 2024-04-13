<?php

namespace App\Providers;

use App\Events\ApproveBorrowRequest;
use App\Events\DownloadPdfAfterPaymentSuccess;
use App\Events\OrderCreated;
use App\Events\PaymentSuccess;
use App\Events\RejectBorrowRequest;
use App\Listeners\ApproveBorrowRequestListener;
use App\Listeners\DeductProductQuatity;
use App\Listeners\DownloadPdfAfterPaymentSuccessListener;
use App\Listeners\EmptyCart;
use App\Listeners\PaymentSuccessListener;
use App\Listeners\RejectBorrowRequestListener;
use App\Listeners\SendOrderCreatedNotification;
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
        OrderCreated::class =>[
            SendOrderCreatedNotification::class,
            DeductProductQuatity::class,
            EmptyCart::class,
        ],
        ApproveBorrowRequest::class=>[
            ApproveBorrowRequestListener::class
        ],
        RejectBorrowRequest::class=>[
            RejectBorrowRequestListener::class
        ],
        DownloadPdfAfterPaymentSuccess::class=>[
            DownloadPdfAfterPaymentSuccessListener::class
        ],
        PaymentSuccess::class=>[
            PaymentSuccessListener::class
        ]
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
