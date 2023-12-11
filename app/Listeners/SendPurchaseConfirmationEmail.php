<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPurchaseConfirmationEmail
{
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
        //$purchase = $event->purchase;
        //Mail::to($user->email)->send(new \App\Mail\MailNotify($event->purchase));

        $purchase =

        Mail::to('grzegorz.p.knapik@gmail.com')->send(new MailNotify($event->purchase));
    }
}
