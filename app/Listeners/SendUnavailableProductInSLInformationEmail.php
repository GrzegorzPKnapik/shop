<?php

namespace App\Listeners;

use App\Mail\MailNotify;
use App\Mail\PurchaseConfirmation;
use App\Mail\UnavailableProductInSLInformation;
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
        $users = $event->user;



        /*$data = [
            'subject' => 'Your cart have unavailable product',
            //'body' => 'Jutro kończy się czas edycji twojego koszyka pamiętaj'
            'body' => 'W twojej liście zakupów znajduje się produkt który jest obecnie niedostęny, wymień go na inny, w przeciwnym razie zostanie on pominięty.'
        ];*/

        foreach ($users as $user)
        {
            Mail::to($user->email)->queue(new UnavailableProductInSLInformation($user));

        }



    }
}
