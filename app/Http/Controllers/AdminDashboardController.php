<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Like;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class AdminDashboardController extends Controller
{
    //
    public function index(){

    $user = auth()->user();
    $totalClient =  [];
    $totalSellers = [];
    $totalModerator = [] ; 
    // $clients = User::role('client')->get();


    // dd($clients);
    $users = User::all();
    // dd($users);

    foreach($users as $user) {
        if($user->hasRole('client')){
            $totalClient[] = $user ;
        }elseif($user->hasRole('seller')){
            $totalSellers[] = $user;
        }elseif($user->hasRole('moderator')){
            $totalModerator[] = $user;
        }

    }
    // Admin / Moderator dashboard
    return view('admin.dashboard', [
        'role' => 'admin',
        'usersCount'    => User::count(),
        'totalClient' =>  count($totalClient),
        'totalSellers' =>  count($totalSellers),
        'totalModerator' => count($totalModerator),
        'productsCount' => Product::count(),
        'categoryCount' => Category::count(),
        'ordersCount'   => Order::count(),
        'likesCount'       => Like::count(),
        'pendings' => Order::where('status' , 'pending')->count(),
        'paids' => Order::where('status' , 'paid')->count(),
        'delivered' => Order::where('status' , 'delivered')->count() ,
        'revenue' => Order::where('status' , 'delivered')->sum('total') ,
    ]);
}
}
