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
                    <a href="{{ route('client.categories.show', $category->slug) }}" class="text-gray-700 hover:text-blue-600">
                        {{ $category->name }}
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 text-gray-500">Products</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Categories</h3>
                <div class="space-y-2">
                    @foreach($categories as $rootCategory)
                        <div class="mb-4">
                            <a href="{{ route('client.categories.show', $rootCategory->slug) }}" 
                               class="block font-medium text-gray-700 hover:text-blue-600 mb-2 {{ $rootCategory->id == $category->id ? 'text-blue-600 font-bold' : '' }}">
                                {{ $rootCategory->name }}
                            </a>
                            
                            @if($rootCategory->children->count() > 0)
                                <div class="ml-4 space-y-1">
                                    @foreach($rootCategory->children as $child)
                                        <a href="{{ route('client.categories.show', $child->slug) }}" 
                                           class="block text-sm text-gray-600 hover:text-blue-600 {{ $child->id == $category->id ? 'text-blue-600 font-semibold' : '' }}">
                                            {{ $child->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Search & Filter</h3>
                
                <form method="GET" action="{{ route('client.categories.products', $category->slug) }}">
                    <!-- Search -->
                    <div class="mb-4">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Products</label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search products..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Sort -->
                    <div class="mb-4">
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                        <select id="sort" 
                                name="sort" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price (Low to High)</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price (High to Low)</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition-colors">
                        Apply Filters
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:w-3/4">
            <!-- Category Header -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $category->name }} Products</h1>
                        <p class="text-gray-600">
                            {{ $products->total() }} products found
                            @if(request('search'))
                                for "{{ request('search') }}"
                            @endif
                        </p>
                    </div>
                    
                    @if(request()->hasAny(['search', 'sort']))
                        <a href="{{ route('client.categories.products', $category->slug) }}" 
                           class="text-blue-600 hover:text-blue-800 text-sm">
                            Clear Filters
                        </a>
                    @endif
                </div>
            </div>

            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($products as $product)
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
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->description, 80) }}</p>
                                @endif
                                
                                <div class="flex gap-2">
                                    <button class="flex-1 bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition-colors text-sm">
                                        Add to Cart
                                    </button>
                                    <button class="bg-gray-200 text-gray-700 px-3 py-2 rounded hover:bg-gray-300 transition-colors">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-lg shadow-md">
                    <i class="fas fa-search text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No products found</h3>
                    <p class="text-gray-500 mb-4">
                        @if(request('search'))
                            Try searching with different keywords
                        @else
                            No products available in this category yet
                        @endif
                    </p>
                    <a href="{{ route('client.categories.products', $category->slug) }}" 
                       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                        Clear Search
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
