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

    public function clientIndex()
    {
        $orders = auth()->user()->orders()->with(['items.product'])->latest()->get();
        
        return view('client.orders.index', compact('orders'));
    }

    public function clientShow(Order $order)
    {
        if($order->user_id !== auth()->id()){
            abort(403);
        }

        $order->load('items.product');

        return view('client.orders.show', compact('order'));
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

    public function confirmDelivery(Order $order)
    {   
        if($order->user_id !== auth()->id()){
            abort(403);
        }

        if($order->status !== 'shipped'){
            return back()->with('error', 'You cannot confirm this order.');
        }

        $order->update(['status' => 'delivered']);
        
        return back()->with('success', 'order confirmed successfully');

    }
}
