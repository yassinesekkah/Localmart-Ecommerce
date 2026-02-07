<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function info(Request $request)
    {   
        $cart = session()->get('cart', []);
       
        ///check ila cart khawia
        if(empty($cart)){
            return back()->with('error', 'Your cart is empty');
        }

        return view('client.cart.info', compact('cart'));
    }

    public function store(Request $request)
    {
        
        return back()->with('success', 'test');
    }
}
