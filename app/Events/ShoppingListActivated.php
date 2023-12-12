<?php

namespace App\Events;

use App\Models\Order;
use App\Models\Shopping_list;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShoppingListActivated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $shopping_list;

    /**
     * Create a new event instance.
     */
    public function __construct(Shopping_list $shopping_list)
    {
        $this->shopping_list = $shopping_list;
    }


}
