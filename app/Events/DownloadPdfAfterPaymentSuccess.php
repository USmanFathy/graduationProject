<?php

namespace App\Events;

use App\Models\Product;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DownloadPdfAfterPaymentSuccess
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public Product $product;
    /**
     * Create a new event instance.
     */
    public function __construct($user ,$product)
    {
        $this->user = $user;
        $this->product = $product;
    }

}
