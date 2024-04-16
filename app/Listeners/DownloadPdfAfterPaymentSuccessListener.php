<?php

namespace App\Listeners;

use App\Events\DownloadPdfAfterPaymentSuccess;
use App\Notifications\DownloadPdfAfterPaymentSuccessMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DownloadPdfAfterPaymentSuccessListener
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
    public function handle(DownloadPdfAfterPaymentSuccess $event): void
    {
        $user = $event->user->first();
        $product = $event->product;
        $user->notify(new DownloadPdfAfterPaymentSuccessMessage($product));
    }
}
