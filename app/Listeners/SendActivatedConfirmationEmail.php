<?php

namespace App\Listeners;

use App\Mail\MailNotify;
use App\Mail\PurchaseConfirmation;
use App\Mail\ShoppingListActivatedConfirmation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendActivatedConfirmationEmail implements ShouldQueue
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
        $shopping_list = $event->shopping_list;

        /*$data = [
            'subject' => 'Your cart have unavailable product',
            //'body' => 'Jutro kończy się czas edycji twojego koszyka pamiętaj'
            'body' => 'W twojej liście zakupów znajduje się produkt który jest obecnie niedostęny, wymień go na inny, w przeciwnym razie zostanie on pominięty.'
        ];*/
        Mail::to($shopping_list->user->email)->queue(new ShoppingListActivatedConfirmation($shopping_list));
    }
}
