<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    function index()
    {
        $categories = Category::all();

        $products = Product::all();

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
        $product = Product::with(['category', 'reviews.user'])->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }
}
