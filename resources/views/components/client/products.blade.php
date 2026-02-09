@props(['products', 'categories'])
<!-- Popular Products Start-->

<!-- Popular Products -->
<section class="my-14">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">


            @foreach($products as $product)

            <div class="border border-gray-300 rounded-lg p-4 card-product relative group">
                <div class="relative mb-4">
                    <span class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded font-semibold">Sale</span>
                    <div class="w-full h-48 rounded mb-3 flex items-center justify-center bg-cover bg-center"
                        style="background-image: url('{{ $product->image ? asset('storage/'. $product->image) : url('https://productplaceholder.com/_next/image?url=https%3A%2F%2Fprd.place%2F320%2F320%3Fid%3D3%26p%3D30&w=640&q=75') }}')">
                        @if(empty($product->image))
                        <span class="text-yellow-600">Aucune image</span>
                        @endif
                    </div>
                    <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 opacity-0 invisible card-product-action transition-all duration-300">
                        <!-- Quick View Button - Pass product ID -->
                        <button onclick="openQuickViewModal({{$product->id}})" class="w-9 h-9 bg-white shadow-lg rounded-lg hover:bg-green-600 hover:text-white transition flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
<livewire:product-likes :product="$product" />
                    </div>
                </div>
                <div class="space-y-2">
                    <a href="#" class="text-sm text-gray-500 hover:text-green-600">{{ $product->category->name ?? 'Category' }}</a>
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

<!-- Quick View Modal -->
<div id="quickViewModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeQuickViewModal()"></div>
    <div class="relative bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Loading Spinner -->
        <div id="modalLoading" class="absolute inset-0 bg-white bg-opacity-90 flex items-center justify-center z-20 hidden">
            <div class="flex flex-col items-center">
                <svg class="animate-spin h-12 w-12 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="mt-4 text-gray-600">Loading product...</p>
            </div>
        </div>

        <div class="p-6">
            <!-- Close Button -->
            <button type="button" onclick="closeQuickViewModal()" class="absolute top-4 right-4 text-gray-700 hover:text-gray-900 transition-colors z-10">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>

            <!-- Product Content (Will be populated dynamically) -->
            <div id="result_Product" class="grid md:grid-cols-2 gap-6">
                <!-- Default Content (shown before AJAX loads) -->
                <div class="space-y-4">
                    <div class="bg-gray-100 rounded-lg overflow-hidden"> hjbjkbbjkbkbkbk
                        <img id="productMainImage" src="{{ $product->image ? asset('storage/' . $product->image) : url('https://commons.wikimedia.org/wiki/File:ZenFone_6_Mockup.svg') }}" alt="Product image" class="w-full h-96 object-cover" />
                    </div>
                    
                </div>

                <div class="space-y-4">
                    <!-- Category -->
                    <div>
                        <a href="#" id="productCategory" class="text-sm text-gray-500 hover:text-green-600">Loading...</a>
                    </div>

                    <!-- Product Name -->
                    <h2 id="productName" class="text-2xl font-bold text-gray-800">Loading...</h2>

                    <!-- Rating -->
                    <div class="flex items-center gap-2">
                        <div class="flex text-yellow-500" id="productRating">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                            </svg>
                        </div>
                        <span class="text-gray-500 text-sm">4.5 <span class="text-gray-400">(149 reviews)</span></span>
                    </div>

                    <!-- Price -->
                    <div class="flex items-baseline gap-2">
                        <span id="productPrice" class="text-3xl font-bold text-gray-800">$0.00</span>
                        <span id="productOldPrice" class="text-lg line-through text-gray-400"></span>
                        <span id="productDiscount" class="bg-red-100 text-red-600 px-2 py-1 rounded text-sm font-semibold hidden"></span>
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
                                <button onclick="decrementQuantity(this)" class="w-10 h-10 text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-colors">-</button>
                                <input type="number" value="1" min="1" max="10" class="w-16 text-center border-0 focus:ring-0" readonly />
                                <button onclick="incrementQuantity(this)" class="w-10 h-10 text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-colors">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to Cart
                        </button>
<livewire:product-likes :product="$product" />
                    </div>

                    <!-- Additional Info -->
                    <div class="border-t pt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">SKU:</span>
                            <span id="productSKU" class="text-gray-800 font-medium">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Category:</span>
                            <a href="#" id="productCategoryLink" class="text-green-600 hover:text-green-700">-</a>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Brand:</span>
                            <span id="productBrand" class="text-gray-800 font-medium">-</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="reviews" class="tab-content">
                <!-- Rating Summary -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="text-center">
                            <div class="text-6xl font-bold text-gray-900 mb-2">4.5</div>
                            <div class="flex justify-center text-yellow-500 text-2xl mb-2">
                                ★★★★☆
                            </div>
                            <p class="text-gray-600">Based on 149 reviews</p>
                        </div>

                        <div class="space-y-3">
                            <!-- 5 stars -->
                            <div class="flex items-center">
                                <span class="text-sm text-gray-600 w-12">5 ★</span>
                                <div class="flex-1 mx-4 bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 70%"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-12 text-right">104</span>
                            </div>
                            <!-- 4 stars -->
                            <div class="flex items-center">
                                <span class="text-sm text-gray-600 w-12">4 ★</span>
                                <div class="flex-1 mx-4 bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 20%"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-12 text-right">30</span>
                            </div>
                            <!-- 3 stars -->
                            <div class="flex items-center">
                                <span class="text-sm text-gray-600 w-12">3 ★</span>
                                <div class="flex-1 mx-4 bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 7%"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-12 text-right">10</span>
                            </div>
                            <!-- 2 stars -->
                            <div class="flex items-center">
                                <span class="text-sm text-gray-600 w-12">2 ★</span>
                                <div class="flex-1 mx-4 bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 2%"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-12 text-right">3</span>
                            </div>
                            <!-- 1 star -->
                            <div class="flex items-center">
                                <span class="text-sm text-gray-600 w-12">1 ★</span>
                                <div class="flex-1 mx-4 bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 1%"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-12 text-right">2</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Write Review Button -->
                <div class="mb-8">
                    <label for="review" class="block mb-2 text-sm font-medium text-gray-700">
                        Review
                    </label>

                    <textarea
                        name="review"
                        id="review"
                        rows="4"
                        placeholder="Write your review..."
                        class="
                            w-full 
                            px-4 py-3
                            bg-gray-50
                            border border-gray-300 
                            rounded-xl 
                            shadow-sm
                            resize-none
                            focus:outline-none 
                            focus:ring-2 
                            focus:ring-green-600 
                            focus:border-green-700
                            transition
                        "></textarea>
                    <button class="px-4 py-2 mt-1 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                        Ajouter Review
                    </button>
                </div>

                <!-- Customer Reviews -->
                <div class="space-y-6">
                    <h3 class="text-xl font-bold mb-6">Clients Reviews</h3>

                    <!-- Review 1 -->
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-semibold mr-4">
                                    JD
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">John Doe</h4>
                                    <div class="flex items-center mt-1">
                                        <div class="flex text-yellow-500 text-sm mr-2">★★★★★</div>
                                        <span class="text-sm text-gray-500">2 days ago</span>
                                    </div>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </button>
                        </div>

                        <h5 class="font-semibold text-gray-900 mb-2">Excellent Product!</h5>
                        <p class="text-gray-600 mb-4">
                            This is one of the best snacks I've ever had. The taste is authentic and the quality is top-notch.
                            Highly recommended for everyone who loves traditional Indian snacks. The packaging was also very good.
                        </p>

                        <div class="flex items-center space-x-6 text-sm">
                            <button class="flex items-center text-gray-500 hover:text-green-600 transition">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                                <span>Helpful (24)</span>
                            </button>
                            <button class="text-gray-500 hover:text-gray-700 transition">Reply</button>
                        </div>
                    </div>

                    
                    <!-- Load More -->
                    <!-- <div class="text-center pt-4">
                        <button class="px-6 py-2 border-2 border-green-600 text-green-600 font-semibold rounded-lg hover:bg-green-50 transition">
                            Load More Reviews
                        </button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@push('scripts')
<script>
    function openQuickViewModal(productId) {

        // if (e.target.closest('.quick-view-btn')) {
        const modal = document.getElementById('quickViewModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        const loading = document.getElementById('modalLoading');

        // Open modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        // Show loading spinner
        loading.classList.remove('hidden');

        // Fetch product data
        fetch(`/client/product/${encodeURIComponent(productId)}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })
            .then(product => {
                loading.classList.add('hidden');

                if (!product) {
                    document.getElementById('result_Product').innerHTML = '<div class="col-span-2 p-8 text-center text-gray-500">Product not found</div>';
                    return;
                }

                // If product is an array, get first item
                const productData = Array.isArray(product) ? product[0] : product;

                console.log('Product Data:', productData); // Debug log

                // Update modal content with product data
                document.getElementById('productName').textContent = productData.name || 'Product Name';
                document.getElementById('productCategory').textContent = productData.category?.name || 'Uncategorized';
                document.getElementById('productCategoryLink').textContent = productData.category?.name || 'Uncategorized';
                document.getElementById('productPrice').textContent = `${productData.price || '0'} MAD`;
                document.getElementById('productDescription').textContent = productData.description || 'No description available for this product.';
                document.getElementById('productSKU').textContent = productData.sku || `PRD-${productData.id}`;
                document.getElementById('productBrand').textContent = productData.brand || 'Generic';

                // Update product images
                const imageUrl = productData.image ?
                    `/storage/${productData.image}` :
                    'https://via.placeholder.com/400x400/e5e7eb/1f2937?text=No+Image';

                document.getElementById('productMainImage').src = imageUrl;
                document.getElementById('productMainImage').alt = productData.name || 'Product';

                // Update thumbnail
                // const thumbnailContainer = document.getElementById('productThumbnails');
                // thumbnailContainer.innerHTML = `
                //         <img src="${imageUrl}" 
                //             alt="image not exist" 
                //             class="w-full h-20 object-cover rounded cursor-pointer border-2 border-green-600" 
                //             onclick="document.getElementById('productMainImage').src = this.src" />
                //     `;

                // Update old price if exists
                const oldPriceElement = document.getElementById('productOldPrice');
                const discountElement = document.getElementById('productDiscount');

                if (productData.old_price && parseFloat(productData.old_price) > parseFloat(productData.price)) {
                    oldPriceElement.textContent = `${productData.old_price} MAD`;
                    oldPriceElement.classList.remove('hidden');

                    // Calculate discount percentage
                    const discount = Math.round(((parseFloat(productData.old_price) - parseFloat(productData.price)) / parseFloat(productData.old_price)) * 100);
                    discountElement.textContent = `${discount}% Off`;
                    discountElement.classList.remove('hidden');
                } else {
                    oldPriceElement.classList.add('hidden');
                    discountElement.classList.add('hidden');
                }

                // Add fade-in animation
                const resultDiv = document.getElementById('result_Product');
                resultDiv.classList.add('opacity-0');
                setTimeout(() => {
                    resultDiv.classList.remove('opacity-0');
                    resultDiv.classList.add('opacity-100', 'transition-opacity', 'duration-500');
                }, 50);
            })
            .catch(error => {
                console.error('Error fetching product:', error);
                loading.classList.add('hidden');
                document.getElementById('result_Product').innerHTML = `
                        <div class="col-span-2 p-8 text-center">
                            <div class="text-red-500 mb-2">Error loading product</div>
                            <div class="text-gray-500 text-sm">Please try again later</div>
                        </div>
                    `;
            });
    }

    function closeQuickViewModal() {
        const modal = document.getElementById('quickViewModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    // Existing functions (keep your original ones)
    function openOffcanvas() {
        const offcanvas = document.getElementById('offcanvasRight');
        const backdrop = document.getElementById('offcanvasBackdrop');

        backdrop.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            offcanvas.classList.remove('translate-x-full');
            backdrop.classList.add('opacity-100');
        }, 10);

    }

    function closeOffcanvas() {
        const offcanvas = document.getElementById('offcanvasRight');
        const backdrop = document.getElementById('offcanvasBackdrop');

        offcanvas.classList.add('translate-x-full');
        backdrop.classList.remove('opacity-100');

        setTimeout(() => {
            backdrop.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    function closeQuickViewModal() {
        const modal = document.getElementById('quickViewModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    function incrementQuantity(button) {
        const input = button.previousElementSibling;
        let value = parseInt(input.value);
        if (value < parseInt(input.max)) {
            input.value = value + 1;
        }
    }

    function decrementQuantity(button) {
        const input = button.nextElementSibling;
        let value = parseInt(input.value);
        if (value > parseInt(input.min)) {
            input.value = value - 1;
        }
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeQuickViewModal();
        }
    });


    function closeQuickViewModal() {
        const modal = document.getElementById('quickViewModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    function incrementQuantity(button) {
        const input = button.previousElementSibling;
        let value = parseInt(input.value);
        if (value < parseInt(input.max)) {
            input.value = value + 1;
        }
    }

    function decrementQuantity(button) {
        const input = button.nextElementSibling;
        let value = parseInt(input.value);
        if (value > parseInt(input.min)) {
            input.value = value - 1;
        }
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeQuickViewModal();
        }
    });
</script>

@endpush