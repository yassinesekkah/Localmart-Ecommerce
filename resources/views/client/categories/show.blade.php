@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('client.categories.index') }}" class="text-gray-700 hover:text-blue-600">
                    Categories
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 text-gray-500">{{ $category->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
            @if($category->image)
                <div class="w-full md:w-32 h-32 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                    <img src="{{ asset($category->image) }}" 
                         alt="{{ $category->name }}" 
                         class="w-full h-full object-cover">
                </div>
            @endif
            
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $category->name }}</h1>
                
                @if($category->description)
                    <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                @endif
                
                <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                    <span>
                        <i class="fas fa-box mr-1"></i>
                        {{ $category->products->count() }} products
                    </span>
                    @if($category->parent)
                        <span>
                            <i class="fas fa-folder mr-1"></i>
                            Parent: {{ $category->parent->name }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Subcategories -->
    @if($subcategories->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Subcategories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($subcategories as $subcategory)
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-1">
                                    <a href="{{ route('client.categories.show', $subcategory->slug) }}" 
                                       class="hover:text-blue-600 transition-colors">
                                        {{ $subcategory->name }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ $subcategory->active_products_count }} products
                                </p>
                            </div>
                            <a href="{{ route('client.categories.products', $subcategory->slug) }}" 
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition-colors text-sm">
                                Browse
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Products in this category -->
    <div>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Products in {{ $category->name }}</h2>
            
            @if($category->products->count() > 0)
                <a href="{{ route('client.categories.products', $category->slug) }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                    View All Products ({{ $category->products->count() }})
                </a>
            @endif
        </div>

        @if($category->products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($category->products->take(8) as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        @if($product->image)
                            <div class="h-48 bg-gray-200">
                                <img src="{{ asset($product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <i class="fas fa-box text-gray-400 text-4xl"></i>
                            </div>
                        @endif
                        
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="text-lg font-bold text-blue-600 mb-2">${{ number_format($product->price, 2) }}</p>
                            
                            @if($product->description)
                                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->description, 60) }}</p>
                            @endif
                            
                            <button class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition-colors">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($category->products->count() > 8)
                <div class="text-center mt-8">
                    <a href="{{ route('client.categories.products', $category->slug) }}" 
                       class="bg-gray-200 text-gray-700 px-6 py-3 rounded hover:bg-gray-300 transition-colors">
                        View All {{ $category->products->count() }} Products
                    </a>
                </div>
            @endif
        @else
            <div class="text-center py-12 bg-white rounded-lg shadow-md">
                <i class="fas fa-box-open text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No products in this category</h3>
                <p class="text-gray-500 mb-4">Check back later or browse other categories</p>
                <a href="{{ route('client.categories.index') }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                    Browse All Categories
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
