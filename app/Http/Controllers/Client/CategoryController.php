<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Afficher toutes les catégories pour le client
    
    public function index()
    {
        if (!auth()->user()->can('view-categories')) {
            abort(403, 'Unauthorized action.');
        }
        
        $categories = Category::root()
            ->active()
            ->with(['children' => function($query) {
                $query->active()->ordered();
            }])
            ->ordered()
            ->get();

        return view('client.categories.index', compact('categories'));
    }

    //Afficher  détails d'une catégorie 
     
    public function show($slug)
    {
        if (!auth()->user()->can('view-categories')) {
            abort(403, 'Unauthorized action.');
        }
        
        $category = Category::where('slug', $slug)
            ->active()
            ->with(['parent', 'children', 'products' => function($query) {
                $query->where('is_active', true)->latest();
            }])
            ->firstOrFail();

        // Obtenir les sous-catégories avec leur nombre de produits
        $subcategories = $category->children()
            ->active()
            ->withCount(['activeProducts'])
            ->ordered()
            ->get();

        return view('client.categories.show', compact('category', 'subcategories'));
    }

    //Afficher les produits d'une catégorie spécifique
     
    public function products($slug, Request $request)
    {
        if (!auth()->user()->can('view-categories')) {
            abort(403, 'Unauthorized action.');
        }
        
        $category = Category::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $query = $category->activeProducts();

        // fnction recherche
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // fnction de tri
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12);

        // Obtenir catégories 
        $categories = Category::root()
            ->active()
            ->with(['children' => function($query) {
                $query->active()->ordered();
            }])
            ->ordered()
            ->get();

        return view('client.categories.products', compact('category', 'products', 'categories'));
    }
}
