<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
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
    public function handle(OrderCreated $event): void
    {
//        dd($event);
       $admins = Admin::all();
//       dd($user);
        foreach ($admins as $admin) {
            $admin->notify(new OrderCreatedNotification($event->order));
        }
//       Notification::send($users ,new OrderCreatedNotification($event->order));
    }
}
