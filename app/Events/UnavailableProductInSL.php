<?php

namespace App\Events;

use App\Models\Order;
use App\Models\Shopping_list;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UnavailableProductInSL
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $users;

    /**
     * Create a new event instance.
     */
    public function __construct(Collection $users)
    {
        Debugbar::info($users);
        $this->users = $users;


    }


}
