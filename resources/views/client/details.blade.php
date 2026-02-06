@props(['products'])
@extends('layouts.client')
@section('title', 'Products')

@section('content')

<x-client.products :products="$products" />
<x-client.categories :categories="$categories" />
@endsection
    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative container mx-auto mt-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Breadcrumb -->
    <section class="bg-white py-4 border-b">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-green-600">Home</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('shop') }}" class="text-gray-500 hover:text-green-600">Shop</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('category', $product->category->slug) }}" class="text-gray-500 hover:text-green-600">{{ $product->category->name }}</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-900">{{ $product->name }}</span>
            </nav>
        </div>
    </section>

    <!-- Product Detail -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-8 mb-12">
                <!-- Product Images -->
                <div>
                    <div class="bg-white rounded-lg p-8 mb-4">
                        <div class="relative">
                            @if($product->discount > 0)
                                <span class="absolute top-4 left-4 bg-red-600 text-white text-sm px-3 py-1 rounded font-semibold z-10">
                                    Sale {{ $product->discount }}%
                                </span>
                            @endif
                            <img src="{{ $selectedImage }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg transition-transform duration-300 hover:scale-105">
                        </div>
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($product->images as $image)
                            <div 
                                wire:click="selectImage('{{ $image->url }}')"
                                class="bg-white rounded-lg p-4 border-2 cursor-pointer transition
                                {{ $selectedImage === $image->url ? 'border-green-600' : 'border-transparent hover:border-green-600' }}">
                                <img src="{{ $image->url }}" alt="Thumbnail" class="w-full h-auto">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product Info -->
                <div class="bg-white rounded-lg p-8">
                    <div class="mb-4">
                        <a href="{{ route('category', $product->category->slug) }}" class="text-sm text-green-600 hover:underline">
                            {{ $product->category->name }}
                        </a>
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                    
                    <!-- Rating -->
                    <div class="flex items-center mb-6">
                        <div class="flex text-yellow-500 text-lg mr-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($product->rating))
                                    ★
                                @elseif($i - 0.5 <= $product->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                        <span class="text-gray-600 text-sm">{{ number_format($product->rating, 1) }}</span>
                        <span class="text-gray-400 text-sm mx-2">•</span>
                        <a href="#reviews" wire:click="switchTab('reviews')" class="text-green-600 text-sm hover:underline">
                            {{ $product->reviews_count }} reviews
                        </a>
                    </div>
                    
                    <!-- Price -->
                    <div class="mb-6">
                        <div class="flex items-baseline space-x-3">
                            <span class="text-4xl font-bold text-gray-900">${{ number_format($selectedSize->price, 2) }}</span>
                            @if($product->discount > 0)
                                <span class="text-2xl text-gray-400 line-through">${{ number_format($selectedSize->original_price, 2) }}</span>
                                <span class="text-lg text-green-600 font-semibold">{{ $product->discount }}% Off</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Inclusive of all taxes</p>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="border-t border-b border-gray-200 py-4 mb-6 space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Brand:</span>
                            <span class="text-gray-900 font-medium">{{ $product->brand }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Weight:</span>
                            <span class="text-gray-900 font-medium">{{ $selectedSize->weight }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Availability:</span>
                            <span class="text-green-600 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Size Selection -->
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">Size:</h3>
                        <div class="flex space-x-3">
                            @foreach($product->sizes as $size)
                                <button 
                                    wire:click="selectSize({{ $size->id }})"
                                    class="px-4 py-2 border-2 rounded-lg font-medium transition
                                    {{ $selectedSize->id === $size->id ? 'border-green-600 bg-green-50 text-green-600' : 'border-gray-300 text-gray-700 hover:border-green-600 hover:text-green-600' }}">
                                    {{ $size->weight }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Quantity Selector -->
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">Quantity:</h3>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button wire:click="decreaseQuantity" class="px-4 py-2 text-gray-600 hover:bg-gray-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                    </svg>
                                </button>
                                <input type="number" wire:model="quantity" min="1" max="10" class="w-16 text-center border-x border-gray-300 py-2 focus:outline-none">
                                <button wire:click="increaseQuantity" class="px-4 py-2 text-gray-600 hover:bg-gray-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            </div>
                            <span class="text-sm text-gray-500">Maximum 10 items allowed</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex space-x-4 mb-6">
                        <button wire:click="addToCart" class="flex-1 px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Add to Cart
                        </button>
                        <button 
                            wire:click="toggleWishlist"
                            class="px-6 py-3 border-2 font-semibold rounded-lg transition
                            {{ $isInWishlist ? 'bg-red-50 border-red-500 text-red-500' : 'border-green-600 text-green-600 hover:bg-green-50' }}">
                            <svg class="w-5 h-5" fill="{{ $isInWishlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Buy Now Button -->
                    <button class="w-full px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition mb-6">
                        Buy Now
                    </button>
                    
                    <!-- Additional Info -->
                    <div class="border-t border-gray-200 pt-6 space-y-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>100% Genuine Products</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Easy 7 days return & exchange</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Free delivery on orders above $50</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="bg-white rounded-lg p-8">
                <!-- Tab Headers -->
                <div class="border-b border-gray-200 mb-8">
                    <nav class="flex space-x-8">
                        <button 
                            wire:click="switchTab('description')"
                            class="pb-4 px-1 border-b-2 font-semibold transition
                            {{ $activeTab === 'description' ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Product Details
                        </button>
                        <button 
                            wire:click="switchTab('info')"
                            class="pb-4 px-1 border-b-2 font-semibold transition
                            {{ $activeTab === 'info' ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Information
                        </button>
                        <button 
                            wire:click="switchTab('reviews')"
                            class="pb-4 px-1 border-b-2 font-semibold transition
                            {{ $activeTab === 'reviews' ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Reviews ({{ $product->reviews_count }})
                        </button>
                    </nav>
                </div>

                <!-- Tab Content: Description -->
                @if($activeTab === 'description')
                    <div>
                        <div class="prose max-w-none">
                            <h3 class="text-xl font-bold mb-4">Description</h3>
                            <p class="text-gray-600 mb-4">{!! nl2br(e($product->description)) !!}</p>
                            
                            @if($product->features)
                                <h4 class="text-lg font-semibold mb-3">Features:</h4>
                                <ul class="list-disc list-inside space-y-2 text-gray-600 mb-6">
                                    @foreach(json_decode($product->features) as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            
                            @if($product->storage_instructions)
                                <h4 class="text-lg font-semibold mb-3">Storage Instructions:</h4>
                                <p class="text-gray-600">{{ $product->storage_instructions }}</p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Tab Content: Information -->
                @if($activeTab === 'info')
                    <div>
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-xl font-bold mb-4">Product Information</h3>
                                <table class="w-full">
                                    <tbody class="divide-y divide-gray-200">
                                        <tr>
                                            <td class="py-3 text-gray-600">Brand</td>
                                            <td class="py-3 text-gray-900 font-medium">{{ $product->brand }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 text-gray-600">Manufacturer</td>
                                            <td class="py-3 text-gray-900 font-medium">{{ $product->manufacturer }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 text-gray-600">Country of Origin</td>
                                            <td class="py-3 text-gray-900 font-medium">{{ $product->country_of_origin }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 text-gray-600">Shelf Life</td>
                                            <td class="py-3 text-gray-900 font-medium">{{ $product->shelf_life }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            @if($product->nutritional_info)
                                <div>
                                    <h3 class="text-xl font-bold mb-4">Nutritional Information</h3>
                                    <p class="text-sm text-gray-500 mb-4">Per 100g serving</p>
                                    <table class="w-full">
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach(json_decode($product->nutritional_info, true) as $key => $value)
                                                <tr>
                                                    <td class="py-3 text-gray-600">{{ $key }}</td>
                                                    <td class="py-3 text-gray-900 font-medium">{{ $value }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Tab Content: Reviews -->
                @if($activeTab === 'reviews')
                    <div>
                        <!-- Rating Summary -->
                        <div class="bg-gray-50 rounded-lg p-6 mb-8">
                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="text-center">
                                    <div class="text-6xl font-bold text-gray-900 mb-2">{{ number_format($product->rating, 1) }}</div>
                                    <div class="flex justify-center text-yellow-500 text-2xl mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($product->rating))
                                                ★
                                            @elseif($i - 0.5 <= $product->rating)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-gray-600">Based on {{ $product->reviews_count }} reviews</p>
                                </div>
                                
                                <div class="space-y-3">
                                    @foreach([5 => 104, 4 => 30, 3 => 10, 2 => 3, 1 => 2] as $stars => $count)
                                        <div class="flex items-center">
                                            <span class="text-sm text-gray-600 w-12">{{ $stars }} ★</span>
                                            <div class="flex-1 mx-4 bg-gray-200 rounded-full h-2">
                                                <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ ($count / $product->reviews_count) * 100 }}%"></div>
                                            </div>
                                            <span class="text-sm text-gray-600 w-12 text-right">{{ $count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Write Review Button -->
                        <div class="mb-8">
                            <button wire:click="$toggle('showReviewForm')" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                                Write a Review
                            </button>
                        </div>

                        <!-- Review Form -->
                        @if($showReviewForm)
                            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                                <h3 class="text-xl font-bold mb-4">Write Your Review</h3>
                                <form wire:submit.prevent="submitReview">
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Rating</label>
                                        <div class="flex space-x-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <button 
                                                    type="button"
                                                    wire:click="$set('newReviewRating', {{ $i }})"
                                                    class="text-3xl hover:text-yellow-400 transition {{ $i <= $newReviewRating ? 'text-yellow-500' : 'text-gray-300' }}">
                                                    ★
                                                </button>
                                            @endfor
                                        </div>
                                        @error('newReviewRating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Review Title</label>
                                        <input type="text" wire:model="newReviewTitle" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                        @error('newReviewTitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Your Review</label>
                                        <textarea wire:model="newReviewText" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                                        @error('newReviewText') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Your Name</label>
                                        <input type="text" wire:model="newReviewName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                        @error('newReviewName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                                        Submit Review
                                    </button>
                                </form>
                            </div>
                        @endif

                        <!-- Customer Reviews -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-bold mb-6">Customer Reviews</h3>
                            
                            @foreach($displayedReviews as $review)
                                <div class="border-b border-gray-200 pb-6">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-{{ ['green', 'blue', 'purple', 'pink'][rand(0,3)] }}-100 rounded-full flex items-center justify-center text-{{ ['green', 'blue', 'purple', 'pink'][rand(0,3)] }}-600 font-semibold mr-4">
                                                {{ strtoupper(substr($review->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">{{ $review->name }}</h4>
                                                <div class="flex items-center mt-1">
                                                    <div class="flex text-yellow-500 text-sm mr-2">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            {{ $i <= $review->rating ? '★' : '☆' }}
                                                        @endfor
                                                    </div>
                                                    <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button wire:click="toggleBookmark({{ $review->id }})" class="text-gray-400 hover:text-green-600">
                                            <svg class="w-5 h-5" fill="{{ $review->bookmarkedBy->contains(auth()->id()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <h5 class="font-semibold text-gray-900 mb-2">{{ $review->title }}</h5>
                                    <p class="text-gray-600 mb-4">{{ $review->text }}</p>
                                    
                                    <div class="flex items-center space-x-6 text-sm">
                                        <button wire:click="likeReview({{ $review->id }})" class="flex items-center text-gray-500 hover:text-green-600 transition">
                                            <svg class="w-5 h-5 mr-1" fill="{{ $review->likedBy->contains(auth()->id()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                            </svg>
                                            <span>Helpful ({{ $review->likes }})</span>
                                        </button>
                                        <button class="text-gray-500 hover:text-gray-700 transition">Reply</button>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Load More -->
                            @if($reviews->count() > $displayedReviewsCount)
                                <div class="text-center pt-4">
                                    <button wire:click="loadMoreReviews" class="px-6 py-2 border-2 border-green-600 text-green-600 font-semibold rounded-lg hover:bg-green-50 transition">
                                        Load More Reviews
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-8">Related Products</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="border border-gray-300 rounded-lg p-4 hover:shadow-lg transition">
                        <a href="{{ route('product.show', $relatedProduct->id) }}">
                            <div class="bg-gray-100 rounded mb-3 h-48 flex items-center justify-center">
                                <img src="{{ $relatedProduct->images->first()->url ?? '' }}" alt="{{ $relatedProduct->name }}" class="max-h-full">
                            </div>
                            <span class="text-sm text-gray-500 hover:text-green-600">{{ $relatedProduct->category->name }}</span>
                            <h3 class="font-medium mt-1 mb-2 truncate">{{ $relatedProduct->name }}</h3>
                            <div class="flex items-center text-yellow-500 text-xs mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= floor($relatedProduct->rating) ? '★' : '☆' }}
                                @endfor
                                <span class="text-gray-500 ml-1">{{ number_format($relatedProduct->rating, 1) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="font-semibold text-gray-900">${{ number_format($relatedProduct->price, 0) }}</span>
                                    @if($relatedProduct->discount > 0)
                                        <span class="line-through text-gray-500 text-sm ml-1">${{ number_format($relatedProduct->original_price, 0) }}</span>
                                    @endif
                                </div>
                                <button class="px-3 py-1.5 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                                    Add
                                </button>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection