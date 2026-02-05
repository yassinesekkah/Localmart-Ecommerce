@props(['products', 'categories'])<!-- Popular Products Start-->

<!-- Popular Products -->
<section class="my-14">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6"> Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <!-- Product Card 1 -->
            @php
            $categoryImages = [
            'assets/images/products/product-img-2.jpg',
            'assets/images/category/category-tea-coffee-drinks.jpg',
            'assets/images/category/category-instant-food.jpg',
            'assets/images/category/category-bakery-biscuits.jpg',
            'assets/images/category/category-cleaning-essentials.jpg',
            'assets/images/category/category-dairy-bread-eggs.jpg',
            'assets/images/category/category-snack-munchies.jpg',
            'assets/images/category/category-baby-care.jpg',
            'assets/images/category/category-chicken-meat-fish.jpg',
            'assets/images/category/category-pet-care.jpg',
            '',
            ];
            @endphp
            @foreach($products as $product)
            @php
                $imagePath = $categoryImages[$loop->index % count($categoryImages)];
            @endphp
            <div class="border border-gray-300 rounded-lg p-4 card-product relative group">
                <div class="relative mb-4">
                    <span class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded font-semibold">Sale</span>
                    <div class="w-full h-48 rounded mb-3 flex items-center justify-center bg-cover bg-center"
                        style="background-image: url('{{ asset($imagePath) }}');">
                
                        @if(empty($imagePath))
                            <span class="text-yellow-600">Aucune image</span>
                        @endif
                    </div>
                    <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 opacity-0 invisible card-product-action transition-all duration-300">
                        <button class="w-9 h-9 bg-white shadow-lg rounded-lg hover:bg-green-600 hover:text-white transition flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        <button class="w-9 h-9 bg-white shadow-lg rounded-lg hover:bg-green-600 hover:text-white transition flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="space-y-2">
                    <a href="#" class="text-sm text-gray-500 hover:text-green-600">{{$product->name}}</a>
                    <h3 class="font-medium truncate">
                        <a href="#" class="hover:text-green-600">{{$product->description}}</a>
                    </h3>
                    <div class="flex items-center space-x-2">
                        <div class="flex text-yellow-500 text-sm">
                            ★★★★☆
                        </div>
                        <span class="text-sm text-gray-500">4.5 (149)</span>
                    </div>
                    <div class="flex items-center justify-between pt-2">
                        <div>
                            <span class="font-semibold text-gray-900">$${{$product->price}}</span>
                            <span class="line-through text-gray-500 ml-2 text-sm">$24</span>
                        </div>
                        <button class="px-3 py-1.5 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                            </svg>
                            Add
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>