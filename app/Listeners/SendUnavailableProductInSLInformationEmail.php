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



        /*$user = Shopping_list::where(['shopping_lists' => function ($query) {
            $query->where('status', ShoppingListStatus::NONE)
                ->where('active', ShoppingListActive::TRUE)
                ->with(['shopping_lists_products.product' => function ($query) {
                    $query->where('status', ProductStatus::SOLD_OUT);
                }]);
        }])
            ->get();*/

        $users = $event->users;

        foreach ($users as $user) {
            $user;
            // Przeglądanie relacji dla każdego użytkownika
            $user->load(['shopping_lists.shopping_lists_products.product']);


            // Przesyłanie e-maila z informacją o niedostępnym produkcie w koszyku
            Mail::to($user->email)->queue(new UnavailableProductInSLInformation($user->shopping_lists));
        }
    }

}
