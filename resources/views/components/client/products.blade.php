@props(['products', 'categories'])
<!-- Popular Products Start-->

<!-- Popular Products -->
<section class="my-14">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
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

            @foreach ($products as $product)
                @php
                    $imagePath = $categoryImages[$loop->index % count($categoryImages)];
                @endphp
                <div class="border border-gray-300 rounded-lg p-4 card-product relative group">
                    <div class="relative mb-4">
                        <span
                            class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded font-semibold">Sale</span>
                        <div class="w-full h-48 rounded mb-3 flex items-center justify-center bg-cover bg-center"
                            style="background-image: url('{{ asset($imagePath) }}');">
                            @if (empty($imagePath))
                                <span class="text-yellow-600">Aucune image</span>
                            @endif
                        </div>
                        <div
                            class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 opacity-0 invisible card-product-action transition-all duration-300">
                            <!-- Quick View Button - Pass product ID -->
                            <button onclick="openQuickViewModal({{ $product->id }})"
                                class="w-9 h-9 bg-white shadow-lg rounded-lg hover:bg-green-600 hover:text-white transition flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            <!-- Wishlist Button -->
                            <button
                                class="w-9 h-9 bg-white shadow-lg rounded-lg hover:bg-green-600 hover:text-white transition flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <a href="#"
                            class="text-sm text-gray-500 hover:text-green-600">{{ $product->category->name ?? 'Category' }}</a>
                        <h3 class="font-medium truncate">
                            <a href="#" class="hover:text-green-600">{{ $product->name }}</a>
                        </h3>
                        <div class="flex items-center space-x-2">
                            <div class="flex text-yellow-500 text-sm">
                                ★★★★☆
                            </div>
                            <span class="text-sm text-gray-500">4.5 (149)</span>
                        </div>
                        <div class="flex items-center justify-between pt-2">
                            <div>
                                <span class="font-semibold text-gray-900">{{ $product->price }} MAD</span>
                            </div>
                            <form action="{{ route('client.cart.add', $product) }}">
                                @csrf

                                <button type="submit"
                                    class="px-3 py-1.5 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Quick View Modal -->
<div id="quickViewModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeQuickViewModal()"></div>
    <div class="relative bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Loading Spinner -->
        <div id="modalLoading"
            class="absolute inset-0 bg-white bg-opacity-90 flex items-center justify-center z-20 hidden">
            <div class="flex flex-col items-center">
                <svg class="animate-spin h-12 w-12 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <p class="mt-4 text-gray-600">Loading product...</p>
            </div>
        </div>

        <div class="p-6">
            <!-- Close Button -->
            <button type="button" onclick="closeQuickViewModal()"
                class="absolute top-4 right-4 text-gray-700 hover:text-gray-900 transition-colors z-10">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>

            <!-- Product Content (Will be populated dynamically) -->
            <div id="result_Product" class="grid md:grid-cols-2 gap-6">
                <!-- Default Content (shown before AJAX loads) -->
                <div class="space-y-4">
                    <div class="bg-gray-100 rounded-lg overflow-hidden">
                        <img id="productMainImage" src="/assets/images/products/product-img-1.jpg" alt="Product"
                            class="w-full h-96 object-cover" />
                    </div>
                    <div class="grid grid-cols-4 gap-2" id="productThumbnails">
                        <img src="/assets/images/products/product-img-1.jpg" alt="Thumbnail"
                            class="w-full h-20 object-cover rounded cursor-pointer border-2 border-green-600" />
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Category -->
                    <div>
                        <a href="#" id="productCategory"
                            class="text-sm text-gray-500 hover:text-green-600">Loading...</a>
                    </div>

                    <!-- Product Name -->
                    <h2 id="productName" class="text-2xl font-bold text-gray-800">Loading...</h2>

                    <!-- Rating -->
                    <div class="flex items-center gap-2">
                        <div class="flex text-yellow-500" id="productRating">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                            </svg>
                        </div>
                        <span class="text-gray-500 text-sm">4.5 <span class="text-gray-400">(149
                                reviews)</span></span>
                    </div>

                    <!-- Price -->
                    <div class="flex items-baseline gap-2">
                        <span id="productPrice" class="text-3xl font-bold text-gray-800">$0.00</span>
                        <span id="productOldPrice" class="text-lg line-through text-gray-400"></span>
                        <span id="productDiscount"
                            class="bg-red-100 text-red-600 px-2 py-1 rounded text-sm font-semibold hidden"></span>
                    </div>

                    <!-- Stock Status -->
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full"></span>
                        <span class="text-sm text-green-600 font-medium">In Stock</span>
                    </div>

                    <!-- Description -->
                    <div class="border-t pt-4">
                        <h3 class="text-sm font-semibold text-gray-800 mb-2">Description</h3>
                        <p id="productDescription" class="text-gray-600 text-sm">
                            Loading product description...
                        </p>
                    </div>

                    <!-- Quantity & Add to Cart -->
                    <div class="border-t pt-4 flex items-center gap-4">
                        <div class="flex items-center">
                            <span class="text-sm font-medium text-gray-700 mr-3">Quantity:</span>
                            <div class="border border-gray-300 rounded-lg flex items-center">
                                <button onclick="decrementQuantity(this)"
                                    class="w-10 h-10 text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-colors">-</button>
                                <input type="number" value="1" min="1" max="10"
                                    class="w-16 text-center border-0 focus:ring-0" readonly />
                                <button onclick="incrementQuantity(this)"
                                    class="w-10 h-10 text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-colors">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button
                            class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to Cart
                        </button>
                        <button
                            class="bg-gray-100 text-gray-800 px-4 py-3 rounded-lg hover:bg-gray-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Additional Info -->
                    <div class="border-t pt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">SKU:</span>
                            <span id="productSKU" class="text-gray-800 font-medium">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Category:</span>
                            <a href="#" id="productCategoryLink"
                                class="text-green-600 hover:text-green-700">-</a>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Brand:</span>
                            <span id="productBrand" class="text-gray-800 font-medium">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
