<?php

namespace App\Listeners;

use App\Events\ApproveBorrowRequest;
use App\Notifications\ApproveBorrowRequestMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ApproveBorrowRequestListener
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
    public function handle(ApproveBorrowRequest $event): void
    {
        $user = $event->user->first();
        $user->notify(new ApproveBorrowRequestMessage());
    }
}
