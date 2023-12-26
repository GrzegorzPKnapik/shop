<?php

namespace App\Listeners;

use App\Mail\MailNotify;
use App\Mail\PurchaseConfirmation;
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

        foreach ($users as $user)
        {
            foreach ($user->shopping_lists as $shopping_list)
            {


            }
        }



        //Mail::to($order->shopping_list->user->email)->queue(new PurchaseConfirmation($order));
        Mail::to('grzegorz.p.knapik@gmail.com')->queue(new PurchaseConfirmation($order));
    }
}
