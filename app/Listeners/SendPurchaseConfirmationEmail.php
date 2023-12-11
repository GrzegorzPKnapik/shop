<?php

namespace App\Listeners;

use App\Mail\MailNotify;
use App\Mail\PurchaseConfirmation;
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
        $order = $event->order;

        //Mail::to('grzegorz.p.knapik@gmail.com')->send(new PurchaseConfirmation($order));
        Mail::to('grzegorz.p.knapik@gmail.com')->queue(new PurchaseConfirmation($order));
    }
}
