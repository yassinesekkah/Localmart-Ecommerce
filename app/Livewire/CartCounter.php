<?php

namespace App\Livewire;

use Livewire\Component;

class CartCounter extends Component
{

 public $cartCount = 0;
 public function mount(){
    $cart = session()->get('cart' , []);
    $this->cartCount = count($cart);
 }


    public function render()
    {
        return view('livewire.cart-counter');
    }
}
