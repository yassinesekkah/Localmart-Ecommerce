<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $seller;

    public function __construct($order, $seller = null)
    {
        $this->order = $order;
        $this->seller = $seller;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle commande reçue - LocalMart',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_placed',
            with: [
                'order' => $this->order,
                'seller' => $this->seller,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
