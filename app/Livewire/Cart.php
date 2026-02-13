<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Cart extends Component
{
    public $cart = [] ;
    public $total = 0;
    public $productId;

        public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function add()
    {
        $product = Product::find($this->productId);
   

        if ($product->quantity<= 0) {
            return back()->with('error', 'Product is out of stock');
        }
        ///njibo lcart mn session
        $cart = session()->get('cart', []);

        //ila l product deja kayen felcart
        if (isset($cart[$product->id])) {

            ///check wach l quantity lifel cart depasat l quantity dyal lproduct
            if ($cart[$product->id]['quantity'] >= $product->quantity) {
                return back()->with('error', 'No more stock available');
            }

            ///nzido l quantity dyal l product fel cart
            $cart[$product->id]['quantity']++;
        } else {
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
            session()->flash('success', 'Product added to cart');

    }

    public function render()
    {
        return view('livewire.cart');
    }



}
