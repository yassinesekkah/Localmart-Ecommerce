<?php

namespace App\Livewire;

use App\Models\Favorite;
use App\Models\Product;
use Livewire\Component;

class ProductFavorites extends Component
{

public ?Product $product = null;

    protected $listeners = ['load-product-favorites' => 'loadProduct'];
    public function loadProduct($id)
    {
        $this->product = Product::with('favorites')->find($id);
    }

  public function toggleFavorite()
  {
    if (!$this->product) return;
    $user = auth()->user();

    if ($this->product->isFavoriteBy($user)) {
      Favorite::where('user_id', $user->id)->where('product_id', $this->product->id)->delete();
    } else {
      Favorite::create([
        'user_id' => $user->id,
        'product_id' => $this->product->id,
      ]);
    }

    $this->product->refresh();
  }

  public function render()
  {
    return view('livewire.product-favorites');
  }
}
