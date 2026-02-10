<?php

namespace App\Services;

use App\Mail\OrderPlacedMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class OrderNotificationService
{
    public function sendOrderNotifications(Order $order)
    {
        $this->notifySeller($order);
        $this->notifyAdmin($order);
        $this->notifyCustomer($order);
    }

    private function getSellerFromOrder(Order $order)
    {
        if ($order->items && $order->items->count() > 0) {
            $firstItem = $order->items->first();
            return $firstItem->product->seller ?? null;
        }

        return User::whereHas('roles', fn($q) => $q->where('name','seller'))->first();
    }

    private function notifySeller(Order $order)
    {
        $seller = $this->getSellerFromOrder($order);
        if ($seller && $seller->email) {
            Mail::to($seller->email)->send(new OrderPlacedMail($order, $seller));
        }
    }

    private function notifyAdmin(Order $order)
    {
        $admin = User::whereHas('roles', fn($q) => $q->where('name','admin'))->first();
        if ($admin && $admin->email) {
            Mail::to($admin->email)->send(new OrderPlacedMail($order, $admin));
        }
    }

    private function notifyCustomer(Order $order)
    {
        if ($order->user && $order->user->email) {
            Mail::to($order->user->email)->send(new OrderPlacedMail($order, $order->user));
        }
    }
}
