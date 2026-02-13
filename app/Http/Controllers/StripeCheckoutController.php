<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Product;
use App\Models\Payment;

class StripeCheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('client.cart.index')
                ->with('error', 'Your cart is empty');
        }

        return view('stripe.checkout');
    }
    
    //test
    public function testCart()
{
    session()->put('cart', [
        ['id' => 1, 'name' => 'Test Product', 'price' => 100, 'quantity' => 2],
        ['id' => 2, 'name' => 'Another Product', 'price' => 50, 'quantity' => 1],
    ]);

    return redirect()->route('stripe.checkout');
}

    public function checkout(Request $request){
        Stripe::setApiKey(config('services.stripe.secret'));

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('client.cart.index')
                ->with('error', 'Your cart is empty');
        }

        $line_items = [];

        foreach ($cart as $item) {

            $product = Product::find($item['id']);

            if (!$product) continue;

            $line_items[] = [
                'price_data' => [
                    'currency' => 'usd', 
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => $item['quantity'],
            ];

           
        }
        

      
         $session = Session::create([
         'payment_method_types' => ['card'],
         'line_items' => $line_items,
        'mode' => 'payment',
         'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
         'cancel_url' => route('stripe.cancel'),
        ]);

         $payment = Payment::create([
           'stripe_session_id' => $session->id,
           'amount' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
           'currency' => 'usd',
           'status' => 'pending',
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {


        return redirect()->route('client.checkout.placeOrder');
        

    }

    public function cancel()
    {
        return "Payment canceled ";
    }

    
    //webhook
    public function webhook(Request $request){
    $payload = $request->getContent();
    $signature = $request->header('Stripe-Signature');

    $endpoint_secret = config('services.stripe.webhook_secret');

    try {
        $event = \Stripe\Webhook::constructEvent(
            $payload,
            $signature,
            $endpoint_secret
        );
    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid signature'], 400);
    }

    if ($event->type === 'checkout.session.completed') {

        $session = $event->data->object;

        $payment = Payment::where('stripe_session_id', $session->id)->first();

        if ($payment) {
            $payment->update([
                'status' => 'paid',
                'stripe_payment_intent' => $session->payment_intent,
            ]);
        }
    }

    return response()->json(['status' => 'success']);
}

}

