<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function index(){

    $user = auth()->user();
    $productCount = Product::where('user_id', $user->id)->count();

    
    // Seller dashboard
    if ($user->hasRole('seller')) {

        return view('admin.dashboard', [
            'role' => 'seller',
            'productsCount' => $productCount,
            'ordersCount'   => 23, //static for now
            'revenue' => 0,  ///static
        ]);
    }

    // Admin / Moderator dashboard
    return view('admin.dashboard', [
        'role' => 'admin',
        'usersCount'    => User::count(),
        'productsCount' => Product::count(),
        'ordersCount'   => 23, ///static for now
        'revenue'       => 0,  ///static
    ]);
}
}