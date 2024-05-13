<?php

namespace App\Listeners;

use App\Events\ApproveBorrowRequestPDfBookEvent;
use App\Notifications\ApproveBorrowRequestPdfBookMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ApproveBorrowRequestPdfBookListener
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
    public function handle(ApproveBorrowRequestPDfBookEvent $event): void
    {
        $user = $event->user->first();
        $product = $event->product->first();
        $borrow = $event->borrow;
        $user->notify(new ApproveBorrowRequestPdfBookMessage($product, $borrow));
    }
}
