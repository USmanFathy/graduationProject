<?php

namespace App\Listeners;

use App\Events\PaymentSuccess;
use App\Notifications\PaymentSuccessMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentSuccessListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentSuccess $event): void
    {
        $user = $event->user;
        $user->notify(new PaymentSuccessMessage());
    }
}
