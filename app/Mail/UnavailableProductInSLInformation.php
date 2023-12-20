<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class UnavailableProductInSLInformation extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $shopping_list;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $shopping_list)
    {
        $this->data = $data;
        $this->shopping_list = $shopping_list;
        dd($shopping_list);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('groceryshop@gmail.com', 'Grocery Shop'),
            subject: 'You have shopping lists with unavailable products in!'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.shoppingList.unavailableProduct-confirmation',
            with: [
                'user' => $this->data,
                'shopping_lists' => $this->shopping_list
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
