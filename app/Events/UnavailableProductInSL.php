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

        /*$re = Shopping_list::where('status', ShoppingListStatus::NONE)
            ->where('active', ShoppingListActive::TRUE)->with(['user' => function ($query){
                $query->where('id', 73);
                     }])

           ->get();

        dd($re);*/

        $this->users = $users;
        //dd($this->users);

    }


}
