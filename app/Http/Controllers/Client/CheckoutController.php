<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function info(Request $request)
    {
        $cart = session()->get('cart', []);
        $checkoutInfo = session()->get('checkout_info');

        ///check ila cart khawia
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty');
        }

        return view('client.cart.info', compact('cart', 'checkoutInfo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|min:3',
            'phone' => 'required|string|min:8',
            'address' => 'required|min:5',
            'city' => 'required|min:2',
        ]);

        session()->put('checkout_info', $validated);

        return redirect()->route('client.checkout.confirm');
    }

    public function confirm()
    {
        $cart = session('cart', []);
        $checkoutInfo = session('checkout_info');
        
        if(!$cart || !$checkoutInfo){

            return redirect()->route('client.cart.index')->with('error', 'Checkout session expired');
        }

        return view('client.cart.confirm', compact('cart', 'checkoutInfo'));
    }

    public function placeOrder()
    {
        return back()->with('success', 'test');
    }
}
