<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;

class OrderController extends Controller
{
    public function index()
    {
        //  Récupère les commandes de l'utilisateur connecté
        $orders = auth()->user()->orders()->with('items.product')->orderBy('created_at', 'desc')->get();

        //  Passe les commandes à la vue
        return view('client.orders.index', compact('orders'));
    }
}
