<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApproveBorrowRequestPDfBookEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $product;
    public $borrow;
    /**
     * Create a new event instance.
     */
    public function __construct($user , $product, $borrow)
    {
        $this->user = $user;
        $this->product = $product;
        $this->borrow = $borrow;
    }

}
