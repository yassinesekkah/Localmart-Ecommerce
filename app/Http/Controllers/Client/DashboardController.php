<?php

namespace App\Http\Controllers\Client;

use App\Core\Auth;
use App\Http\Controllers\Controller;
use App\Livewire\ProductLikes;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    function index()
    {
        $categories = Category::all();

        $products = Product::with(['category', 'likes'])->withCount('likes')->get();
        return view('Market', compact('products', 'categories'));
    }

    function CategorieProducts($id)
    {
        $categories = Category::all();

        $products = Product::where('category_id', $id)->get();
        //    dd($products);
        return view('client.categorie', compact('products', 'categories'));
    }

    function productDetails($id)
    {
        $product = Product::with(['category', 'reviews.user', 'likes'])->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->likes_count = $product->likes->count();
        $product->is_liked = auth()->check() ? $product->isLikeBy(auth()->user()) : false;
        return response()->json($product, 200);
    }

    function profile()
    {

        $user = Auth()->user();
        return view('dashboard', compact('user'));
    }
}
