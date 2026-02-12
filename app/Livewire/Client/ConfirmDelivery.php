<?php

namespace App\Livewire\Client;

use App\Models\Order;
use Livewire\Component;

class ConfirmDelivery extends Component
{
    public Order $order;

    public function confirm()
    {
        // Ownership check
        if ($this->order->user_id !== auth()->id()) {
            abort(403);
        }

        // Status check
        if ($this->order->status !== 'shipped') {
            $this->dispatch(
                'notify',
                type: 'error',
                message: 'Order cannot be confirmed.'
            );
            return;
        }

        // Update
        $this->order->update([
            'status' => 'delivered'
        ]);

        $this->order->refresh();

        // Success notification
        $this->dispatch(
            'notify',
            type: 'success',
            message: 'Order confirmed successfully.'
        );
    }


    public function render()
    {
        return view('livewire.client.confirm-delivery');
    }
}
