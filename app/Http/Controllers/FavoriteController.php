<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    function index() {
    $productIds = Like::where('user_id', auth()->id())->pluck('product_id');
// $products = Product::withCount('favorites') 
//     ->withAvg('favorites', 'rating')
//     ->get();
    $products = Product::whereIn('id', $productIds)->get();
        return view('client.favorite' , compact('products') );
    }
}
