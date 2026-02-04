@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Product Categories</h1>
        <p class="text-gray-600">Browse our wide selection of products by category</p>
    </div>

    @if($categories->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    @if($category->image)
                        <div class="h-48 bg-gray-200">
                            <img src="{{ asset($category->image) }}" 
                                 alt="{{ $category->name }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-folder text-white text-4xl"></i>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">
                            <a href="{{ route('client.categories.show', $category->slug) }}" 
                               class="hover:text-blue-600 transition-colors">
                                {{ $category->name }}
                            </a>
                        </h3>
                        
                        @if($category->description)
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($category->description, 80) }}</p>
                        @endif
                        
                        @if($category->children->count() > 0)
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-2">Subcategories:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($category->children->take(3) as $child)
                                        <a href="{{ route('client.categories.show', $child->slug) }}" 
                                           class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded hover:bg-blue-200 transition-colors">
                                            {{ $child->name }}
                                        </a>
                                    @endforeach
                                    @if($category->children->count() > 3)
                                        <span class="text-xs text-gray-500">+{{ $category->children->count() - 3 }} more</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        <div class="flex justify-between items-center">
                            <a href="{{ route('client.categories.products', $category->slug) }}" 
                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors text-sm">
                                View Products
                            </a>
                            <span class="text-sm text-gray-500">
                                {{ $category->activeProducts()->count() }} products
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-folder-open text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No categories available</h3>
            <p class="text-gray-500">Check back later for new product categories</p>
        </div>
    @endif
</div>
@endsection
