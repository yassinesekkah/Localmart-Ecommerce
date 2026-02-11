<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Mail\OrderStatusUpdatedMail;
use Illuminate\Support\Facades\Mail;



class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }


    public function shipForm(Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'order cannot be shipped');
        }
        $order->load('items.product');
        
        return view('admin.orders.ship', compact('order'));
    }


    public function ship(Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'order cannot be shipped');
        }
        $order->update(['status' => 'shipped']);

        Mail::to($order->user->email)
            ->send(new OrderStatusUpdatedMail($order));

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order shipped successfully');
    }


    public function deliver(Order $order)
    {
        if ($order->status !== 'shipped') {
            return back()->with('error', 'order cannot be delivered');
        }
        $order->update(['status' => 'delivered']);
        Mail::to($order->user->email)
            ->send(new OrderStatusUpdatedMail($order));


        return back()->with('success', 'order delivered');
    }


    public function cancel(Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'order cannot be canceled');
        }
        $order->update(['status' => 'canceled']);

        Mail::to($order->user->email)
            ->send(new OrderStatusUpdatedMail($order));


        return back()->with('success', 'order canceled');
    }
}
