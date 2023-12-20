<?php

namespace App\Listeners;

use App\Enums\ProductStatus;
use App\Enums\ShoppingListActive;
use App\Enums\ShoppingListStatus;
use App\Mail\MailNotify;
use App\Mail\PurchaseConfirmation;
use App\Mail\UnavailableProductInSLInformation;
use App\Models\Shopping_list;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUnavailableProductInSLInformationEmail implements ShouldQueue
{

    use Queueable;
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
    public function handle(object $event): void
    {



       /* $user = Shopping_list::where(['shopping_lists' => function ($query) {
            $query->where('status', ShoppingListStatus::NONE)
                ->where('active', ShoppingListActive::TRUE)
                ->with(['shopping_lists_products.product' => function ($query) {
                    $query->where('status', ProductStatus::SOLD_OUT);
                }]);
        }])
            ->get();*/



        $users = $event->users;



        foreach ($users as $user) {
            /*$re = Shopping_list::where('status', ShoppingListStatus::NONE)
                ->where('active', ShoppingListActive::TRUE)->with(['user' => function ($query) use ($user) {
                $query->where('id', $user->id)
                    ->with(['shopping_lists_products.product' => function ($query) {
                        $query->where('status', ProductStatus::SOLD_OUT);
                    }]);
            }]);

            $data = [
            'data' => $re
            ];*/

            $userr = User::where('id', $user->id)->whereHas('shopping_lists', function ($query) {
                $query->where('status', ShoppingListStatus::NONE)
                    ->where('active', ShoppingListActive::TRUE)
                    ->whereHas('shopping_lists_products.product', function ($query) {
                        $query->where('status', ProductStatus::SOLD_OUT);
                    });
            })->with(['shopping_lists' => function ($query) {
                $query->where('status', ShoppingListStatus::NONE)
                    ->where('active', ShoppingListActive::TRUE)
                    ->with(['shopping_lists_products.product' => function ($query) {
                        $query->where('status', ProductStatus::SOLD_OUT);
                    }]);
            }])->first();

            // Przesyłanie e-maila z informacją o niedostępnym produkcie w koszyku
            Mail::to($user->email)->queue(new UnavailableProductInSLInformation($userr));
        }
    }

}
