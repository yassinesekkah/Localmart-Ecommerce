<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class home extends Controller
{
    function index(){
        $categories = Category::all();
        $products = Product::all();
        return view('Market', compact('products', 'categories'));
    }
}
