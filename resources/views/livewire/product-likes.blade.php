<div>
    <!-- Wishlist Button -->
<button wire:click="toggleLike"
    class="w-12 h-12 bg-white rounded-lg flex flex-col items-center justify-center relative">
    
    @if (!$product->isLikeBy(auth()->user()))
        <svg class="w-10 h-10 text-gray-500 transition-transform duration-200 transform hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
    @else
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-500 transition-transform duration-200 transform hover:scale-125" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
    @endif

    <!-- Number under the heart -->
    <span class="text-xs text-black mt-1">{{ $product->likes->count() }}</span>
</button>


</div>

