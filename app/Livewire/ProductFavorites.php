<?php

namespace App\Livewire;

use App\Models\Favorite;
use App\Models\Product;
use Livewire\Component;

class ProductFavorites extends Component
{
  public $product;
  public $userRating = 0;

  protected $listeners = ['load-product-favorites' => 'loadProduct'];
  public function mount($product)
  {

    $this->product = is_numeric($product) ? Product::find($product) : $product;
    $this->updateUserRating();
  }

  public function loadProduct($id)
  {
    $this->product = Product::find($id);
    $this->updateUserRating();
  }

  private function updateUserRating()
  {
    if (auth()->check() && $this->product) {
      $favorite = Favorite::where('user_id', auth()->id())
        ->where('product_id', $this->product->id)
        ->first();
      $this->userRating = $favorite ? $favorite->rating : 0;
    }
  }

 public function setRating($value)
{
    if (!auth()->check()) return redirect()->route('login');
    $productId = $this->product->id; 

    if ($this->userRating == $value) {
        Favorite::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->delete();
        $this->userRating = 0;
    } else {
        Favorite::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $productId],
            ['rating' => $value]
        );
        $this->userRating = $value;
    }

    $this->product->refresh();
}

  public function render()
  {
    return view('livewire.product-favorites');
  }
}
