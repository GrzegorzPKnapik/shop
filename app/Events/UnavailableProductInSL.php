<?php

namespace App\Events;

use App\Enums\ProductStatus;
use App\Enums\ShoppingListActive;
use App\Enums\ShoppingListStatus;
use App\Models\Order;
use App\Models\Shopping_list;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class UnavailableProductInSL
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $users;

    /**
     * Create a new event instance.
     */
    public function __construct(Collection $users)
    {
        $this->users = $users;
    }


}
