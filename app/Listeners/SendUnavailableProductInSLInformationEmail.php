<?php

namespace App\Listeners;

use App\Enums\ProductStatus;
use App\Enums\ShoppingListActive;
use App\Enums\ShoppingListStatus;
use App\Events\UnavailableProductInSL;
use App\Mail\MailNotify;
use App\Mail\PurchaseConfirmation;
use App\Mail\UnavailableProductInSLInformation;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
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
        $collectWithRelations = collect($this->usersWithUnavailableProduct());

        foreach ($collectWithRelations as $user) {
            Mail::to($user->email)->queue(new UnavailableProductInSLInformation($user));
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function usersWithUnavailableProduct(): Collection
    {
        $slUsersWithUnavailableProduct = User::with(['shopping_lists' => function ($query) {
            $query->where('status', ShoppingListStatus::NONE)
                ->where('active', ShoppingListActive::TRUE)
                ->whereHas('shopping_lists_products.product', function ($query) {
                    $query->where('status', '!=', ProductStatus::ENABLE);
                });
        }])->get();
        return $slUsersWithUnavailableProduct;
    }

}
