<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Product;
use Livewire\Component;

class ProductLikes extends Component
{
    public Product $product;
    public function toggleLike(){
        $user = auth()->user();

        if ($this->product->isLikeBy($user)) {
            Like::where('user_id', $user->id)->where('product_id' , $this->product->id)->delete();
        }else{
            Like::create([
                'user_id' => $user->id ,
                'product_id' => $this->product->id
            ]);
        }

        $this->product = $this->product->refresh();
    }
    public function render()
    {
        return view('livewire.product-likes');
    }
}
