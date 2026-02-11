<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.orders.index', compact('orders'));
    }


    public function ship(Order $order)
    {

        if ($order->status !== 'pending') {
            return back()->with('error', 'order cannot be shipped');
        }
        $order->update(['status' => 'shipped']);

        return back()->with('success', 'order shipped');
    }


    public function deliver(Order $order)
    {
        if ($order->status !== 'shipped') {
            return back()->with('error', 'order cannot be delivered');
        }
        $order->update(['status' => 'delivered']);

        return back()->with('success', 'order delivered');
    }


    public function cancel(Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'order cannot be canceled');
        }
        $order->update(['status' => 'canceled']);

        return back()->with('success', 'order canceled');
    }
}
