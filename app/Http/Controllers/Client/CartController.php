<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        //check stock 
        if($product->quantity <= 0){
            return back()->with('error', 'Product is out of stock');
        }
        ///njibo lcart mn session
        $cart = session()->get('cart', []);

        //ila l product deja kayen felcart
        if(isset($cart[$product->id])){
            
            ///check wach l quantity lifel cart depasat l quantity dyal lproduct
            if($cart[$product->id]['quantity'] >= $product->quantity){
                return back()->with('error', 'No more stock available');
            }

            ///nzido l quantity dyal l product fel cart
            $cart[$product->id]['quantity']++;
        }

        else{
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
                'stock' => $product->quantity
            ];
        }

        //save cart f session
        session()->put('cart', $cart);

        //redirect back
        return back()->with('success', 'Product added to cart');
    }
}
