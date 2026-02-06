<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $role = $user->getRoleNames()->first();

        $categories = Category::latest()->get();

        return view('admin.categories.index', compact('categories', 'role'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    //enregistre categorie
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        ///slug ghi 7na kanchado title wkangeneriweh title"Maroua dev" => slug"maroua-dev"
        //bach f link nkhadmo bih f3awt mandiro id= machi ghadi ne3tiw lel user ydakhlo
        $validated['slug'] = Str::slug($validated['name']);

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $productCount = $category->products()->count();

        // Check category a products
        if ($productCount > 0) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Cannot delete category with products!');
        }

        // Delete image
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
