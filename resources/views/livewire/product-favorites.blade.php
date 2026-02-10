<div class="absolute right-2">
    <button wire:click="toggleFavorite"
    class="w-12 h-12 rounded-lg flex flex-col items-center justify-center relative">
    
    @if (!$product->isFavoriteBy(auth()->user()))
     <svg class="w-7 h-7 text-gray-400 transition-transform duration-200 hover:scale-125"
            fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.1 6.466
                a1 1 0 00.95.69h6.8c.969 0 1.371 1.24.588 1.81l-5.5 4
                a1 1 0 00-.364 1.118l2.1 6.466
                c.3.921-.755 1.688-1.538 1.118l-5.5-4
                a1 1 0 00-1.176 0l-5.5 4
                c-.783.57-1.838-.197-1.538-1.118l2.1-6.466
                a1 1 0 00-.364-1.118l-5.5-4
                c-.783-.57-.38-1.81.588-1.81h6.8
                a1 1 0 00.95-.69l2.1-6.466z"/>
        </svg>
    @else
  <svg class="w-9 h-9 text-yellow-400 transition-transform duration-200 hover:scale-125"
            fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M12 17.27L18.18 21
                l-1.64-7.03L22 9.24
                l-7.19-.61L12 2
                9.19 8.63 2 9.24
                l5.46 4.73L5.82 21z"/>
        </svg>
    @endif

</button>
</div>
