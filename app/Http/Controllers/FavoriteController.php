<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    function index() {
    $productIds = Favorite::where('user_id', auth()->id())->pluck('product_id');

    $products = Product::whereIn('id', $productIds)->get();
        return view('client.favorite' , compact('products') );
    }
}
