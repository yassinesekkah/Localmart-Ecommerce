<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $qty = $request->input('quantity', 1);
        $qty = (int) $qty;
        if ($qty < 1) $qty = 1;

        //check stock 
        if ($product->quantity <= 0) {
            return back()->with('error', 'Product is out of stock');
        }
        ///njibo lcart mn session
        $cart = session()->get('cart', []);

        //ila l product deja kayen felcart
        if (isset($cart[$product->id])) {
            $newQty = $cart[$product->id]['quantity'] + $qty;
            ///check wach l quantity lifel cart depasat l quantity dyal lproduct
            if ($cart[$product->id]['quantity'] >= $product->quantity) {
                return back()->with('error', 'No more stock available');
            }

            ///nzido l quantity dyal l product fel cart
            $cart[$product->id]['quantity'] = $newQty;
        } else {
            if ($qty > $product->quantity) {
            $qty = $product->quantity;
        }
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $qty,
                'image' => $product->image,
                'stock' => $product->quantity
            ];
        }

        //save cart f session
        session()->put('cart', $cart);

        //redirect back
        return back()->with('success', 'Product added to cart');
    }

    public function index()
    {
        ////kanjibo l cart mn session
        $cart = session()->get('cart', []);
        ////kanjam3o fih montant dyal checkout
        $total = 0;
        ///kandoro 3la ga3 l product wenhasbo l price dyalhoum bach ykon total shih 
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('Client.cart.index', compact('cart', 'total'));
    }

    public function remove($productId)
    {
        ////kanjibo l cart mn session
        $cart = session()->get('cart', []);

        ///isset kat9aleb bel productId wast l cart ila l9ato donc return true -> unset katmas7o mn array 
        ///bach tefham mezyan kifach product kaytsayvaw f cart rje3 l method add lfo9
        if (isset($cart[$productId])) {
            unset($cart[$productId]);

            ///n3awdo nsayviw cart f session
            session()->put('cart', $cart);

            return back()->with('success', 'Product removed from cart');
        }

        return back()->with('error', 'Product not found in cart');
    }

    public function increase($productId)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            return back()->with('error', 'Product not found in cart');
        }

        ///check stock
        if ($cart[$productId]['quantity'] >= $cart[$productId]['stock']) {
            return back()->with('error', 'No more stock available');
        }

        $cart[$productId]['quantity']++;

        session()->put('cart', $cart);

        return back()->with('success', 'Quantity updated');
    }

    public function decrease($productId)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            return back()->with('error', 'Product not found in cart');
        }

        ///manhabtoch l quantity 3la 1
        if ($cart[$productId]['quantity'] <= 1) {
            return back()->with('error', 'Quantity cannot be less than 1');
        }

        $cart[$productId]['quantity']--;

        session()->put('cart', $cart);

        return back()->with('success', 'Quantity updated');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Cart cleared successfully');
    }
}
