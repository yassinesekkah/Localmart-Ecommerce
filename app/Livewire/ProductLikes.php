<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Product;
use Livewire\Component;

class ProductLikes extends Component
{
    public Product $product; // Khass t-koun public bach Livewire y-sync-iha
    public $status = '';
    public function toggleLike($productId){

        $user = auth()->user();
        if (!$user) return redirect()->route('/login');

        if ($this->product->isLikeBy($user)) {
            Like::where('user_id', $user->id)->where('product_id' , $productId)->delete();
            $this->status = 'Dis-Like 👎';
        }else{
            Like::create([
                'user_id' => $user->id ,
                'product_id' => $productId
            ]);
            $this->status = 'liked 👍';
        }

        $this->product = $this->product->refresh();
    }
    public function render()
    {

        return view('livewire.product-likes');
    }
}
