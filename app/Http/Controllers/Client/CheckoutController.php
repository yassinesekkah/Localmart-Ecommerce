<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\OrderNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function info(Request $request)
    {
        $cart = session()->get('cart', []);
        $checkoutInfo = session()->get('checkout_info');

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

        if (empty($cart) || empty($checkoutInfo)) {
            return redirect()->route('client.cart.index')
                ->with('error', 'Checkout session expired');
        }

        return view('client.cart.confirm', compact('cart', 'checkoutInfo'));
    }

    public function placeOrder(Request $request, OrderNotificationService $notificationService)
    {
        $cart = session('cart');
        $checkoutInfo = session('checkout_info');
        $user = auth()->user();

        if (empty($cart) || empty($checkoutInfo)) {
            return redirect()->route('client.cart.index')
                ->with('error', 'Checkout session expired');
        }

        DB::beginTransaction();

        try {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => $user->id,
                'full_name' => $checkoutInfo['full_name'],
                'phone' => $checkoutInfo['phone'],
                'address' => $checkoutInfo['address'],
                'city' => $checkoutInfo['city'],
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach ($cart as $item) {
                $product = Product::lockForUpdate()->find($item['id']);

                if ($product->quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);

                $product->decrement('quantity', $item['quantity']);
            }

            DB::commit();

            // Clear session after success
            session()->forget(['cart', 'checkout_info']);

            // Send notifications AFTER commit
            $notificationService->sendOrderNotifications($order);

            return redirect()->route('client.checkout.thankyou', $order->id);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route('client.cart.index')
                ->with('error', $e->getMessage());
        }
    }

    public function thankYou(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        
        $firstItem = $order->items()->with('product.category')->first();
        $category = null;

        if ($firstItem && $firstItem->product && $firstItem->product->category) {
            $category = $firstItem->product->category;
        }

        return view('client.cart.thank-you', compact('order', 'category'));
    }
}
