<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $recipient;

    public function __construct(Order $order, $recipient)
    {
        $this->order = $order;
        $this->recipient = $recipient;
    }

    public function build()
    {
        return $this->subject('Nouvelle commande #' . $this->order->id)
                    ->view('emails.orders.new');
    }
}
