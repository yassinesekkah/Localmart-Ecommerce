<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $recipient;

    public function __construct(Order $order, $recipient = null)
    {
        $this->order = $order;
        $this->recipient = $recipient;
    }

    public function build()
    {
        return $this->subject('Nouvelle commande')
                    ->view('emails.order_placed');
    }
}
