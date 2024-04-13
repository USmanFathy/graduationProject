<?php

namespace App\Listeners;

use App\Events\RejectBorrowRequest;
use App\Notifications\RejectBorrowRequestMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RejectBorrowRequestListener
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
    public function handle(RejectBorrowRequest $event): void
    {
        $user = $event->user;
        $user->notify(new RejectBorrowRequestMessage());
    }
}
