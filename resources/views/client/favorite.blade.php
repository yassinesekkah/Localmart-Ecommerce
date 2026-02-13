@extends('layouts.client')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section with User Context -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center space-x-4">
                <!-- Animated Heart Icon -->
                <div class="relative">
                    <div class="absolute inset-0 bg-green-200 rounded-full animate-ping opacity-20"></div>
                    <div class="relative p-3 bg-gradient-to-br from-green-100 to-green-100 rounded-2xl">
                        <svg class="w-7 h-7 text-green-500 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold">
                        <span class="bg-gradient-to-r from-gray-900 via-green-600 to-green-600 bg-clip-text text-transparent">
                            My Wishlist
                        </span>
                    </h2>
                    <div class="flex items-center space-x-2 mt-2">
                        <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-sm font-medium">
                            {{ $products->count() }} {{ Str::plural('item', $products->count()) }} saved
                        </span>
                        @if(!$products->isEmpty())
                        <span class="text-sm text-gray-500">
                            • Updated just now
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            @if(!$products->isEmpty())
           <button 
    onclick="window.location.reload()" 
    class="group flex items-center space-x-2 px-4 py-2 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-xl transition-all duration-300"
>
    <svg class="w-4 h-4 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
    </svg>
    <span>Refresh</span>
</button>
            @endif
        </div>
    </div>

    @if ($products->isEmpty())
    <!-- Modern Empty State with Animation -->
    <div class="flex flex-col items-center justify-center py-16 px-4 bg-gradient-to-br from-green-50 via-white to-green-50 rounded-3xl border border-green-100">
        <div class="relative mb-8">
            <!-- Floating Hearts Animation -->
            <div class="absolute -top-10 -left-10 animate-bounce delay-100">
                <svg class="w-8 h-8 text-green-200" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
            </div>
            <div class="absolute -bottom-5 -right-8 animate-bounce delay-300">
                <svg class="w-6 h-6 text-green-200" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
            </div>

            <!-- Main Illustration -->
            <div class="w-72 h-72 bg-gradient-to-br from-green-100 via-green-100 to-green-200 rounded-full flex items-center justify-center shadow-2xl">
                <div class="text-center">
                    <svg class="w-32 h-32 text-green-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span class="block mt-2 text-3xl">✨</span>
                </div>
            </div>
        </div>

        <h3 class="text-3xl font-bold text-gray-900 mb-3">Your wishlist is empty</h3>
        <p class="text-gray-600 text-center max-w-md mb-8 text-lg">
            Start exploring and items you love. They'll be waiting for you here!
        </p>

        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ url('/client') }}"
                class="px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center space-x-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span>Discover Products</span>
            </a>
            <button onclick="window.location.reload()"
                class="px-8 py-4 bg-white text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:border-green-200 hover:bg-green-50 hover:text-green-600 transition-all flex items-center space-x-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span>Refresh</span>
            </button>
        </div>
    </div>
    @else
    <!-- Products Grid - Modern Card Design -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6">
        @foreach ($products as $product)
        <div class="group bg-white rounded-3xl hover:rounded-3xl border border-gray-100 hover:border-transparent hover:shadow-[0_20px_70px_-15px_rgba(0,0,0,0.1)] transition-all duration-500 relative overflow-hidden">

            <!-- Decorative Gradient Background on Hover -->
            <div class="absolute inset-0 bg-gradient-to-br from-green-50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

            <!-- Sale Badge - Modern Style -->
            @if(isset($product->sale) && $product->sale)
            <span class="absolute top-4 left-4 z-20 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center space-x-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.96 1.78 2.34 1.78 1.33 0 2.03-.6 2.03-1.5 0-.9-.6-1.33-2.2-1.78-2.04-.54-3.23-1.47-3.23-3.01 0-1.8 1.56-3.01 3.37-3.17V4h2.67v1.95c1.58.31 2.6 1.36 2.7 3h-1.93c-.08-.95-.7-1.54-1.94-1.54-1.17 0-1.88.53-1.88 1.38 0 .75.5 1.22 2.1 1.68 2.2.6 3.33 1.5 3.33 3.14 0 1.75-1.48 2.98-3.38 3.18z" />
                </svg>
                <span>SALE</span>
            </span>
            @endif

            <!-- Favorite Button - Livewire Component -->
            <div class="absolute top-4 right-4 z-20 transform group-hover:scale-110 transition-transform duration-300">
                <livewire:product-likes :product="$product" />
            </div>

            <!-- Image Container with Creative Hover Effect -->
            <div class="relative overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <div class="relative w-full aspect-square">
                    <!-- Background Blur Effect -->
                    <div class="absolute inset-0 bg-cover bg-center blur-xl scale-110 opacity-30"
                        style="background-image: url('{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x400/f3f4f6/9ca3af?text=✨' }}');">
                    </div>

                    <!-- Main Product Image -->
                    <div class="relative w-full h-full rounded-2xl bg-cover bg-center transform group-hover:scale-110 transition-transform duration-700 ease-out"
                        style="background-image: url('{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x400/f3f4f6/9ca3af?text=✨' }}');">
                    </div>

                    @if (empty($product->image))
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-gray-400 font-medium bg-white/80 px-4 py-2 rounded-full backdrop-blur-sm">
                            📸 No image
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Quick Actions Overlay - Modern Glassmorphism -->
                <div class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-white via-white/95 to-transparent backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                    <div class="flex justify-center space-x-3">

                    </div>
                </div>
            </div>

            <!-- Product Details - Modern Typography -->
            <div class="p-5 relative z-10">
                <!-- Category Pill -->
                <div class="mb-3">
                    <a href="#" class="inline-flex items-center px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-medium hover:bg-green-100 transition-colors">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </a>
                </div>

                <!-- Product Name with Truncation -->
                <h3 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2 min-h-[3.5rem]">
                    <a href="#" class="hover:text-green-600 transition-colors">
                        {{ $product->name }}
                    </a>
                </h3>

                <!-- Engagement Stats -->
                <div class="flex items-center space-x-4 mb-4">
                    <div class="flex items-center space-x-1.5">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-700">{{ number_format($product->likes->count()) }}</span>
                    </div>
                </div>

                <!-- Price and Add to Cart Section -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-500 mb-1">Price</span>
                        <div class="flex items-baseline space-x-1">
                            <span class="text-2xl font-bold text-gray-900">{{ number_format($product->price) }}</span>
                            <span class="text-sm font-medium text-gray-500">MAD</span>
                        </div>
                    </div>
                </div>
                <form action="{{ route('client.cart.add', $product->id) }}" method="POST" class="block">
                    @csrf
                    <button type="submit"
                        class="relative w-full px-5 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-medium rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all transform hover:scale-105 hover:shadow-lg flex items-center space-x-2 group/add">
                        <svg class="w-5 h-5 group-hover/add:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Add</span>

                        <!-- Ripple Effect -->
                        <span class="absolute inset-0 rounded-xl bg-white/20 scale-0 group-hover/add:scale-100 transition-transform duration-500"></span>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination with Modern Design -->
    @if(method_exists($products, 'links'))
    <div class="mt-12">
        {{ $products->links() }}
    </div>
    @endif
    @endif
</div>
@endsection