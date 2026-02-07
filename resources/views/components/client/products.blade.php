@props(['products', 'categories'])
<!-- Popular Products Start-->

<!-- Popular Products -->
<section class="my-14">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach ($products as $product)
                <div class="border border-gray-300 rounded-lg p-4 card-product relative group">
                    <div class="relative mb-4">
                        <span
                            class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded font-semibold">Sale</span>
                        <div class="w-full h-48 rounded mb-3 flex items-center justify-center bg-cover bg-center"
                            style="background-image: url('{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x300/e5e7eb/1f2937?text=No+Image' }}');">
                            @if (empty($product->image))
                                <span class="text-yellow-600">Aucune image</span>
                            @endif
                        </div>
                        <div
                            class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 opacity-0 invisible card-product-action transition-all duration-300">
                            <!-- Quick View Button -->
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
                            {{--lbutton dyal add rah katzid l product fel panier bghiti tbadel design mat7ayedch route--}}
                            <form action="{{ route('client.cart.add', $product->id) }}" method="POST" class="inline">
                                @csrf

                                <button type="submit"
                                    class="px-3 py-1.5 bg-green-600 text-white text-sm rounded-lg
                                     hover:bg-green-700 transition flex items-center">
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

            <!-- Product Content -->
            <div id="result_Product" class="grid md:grid-cols-2 gap-6">
                <!-- Left Column - Image -->
                <div class="space-y-4">
                    <div class="bg-gray-100 rounded-lg overflow-hidden">
                        <img id="productMainImage"
                            src="https://via.placeholder.com/400x400/e5e7eb/1f2937?text=Loading..." alt="Product"
                            class="w-full h-96 object-cover" />
                    </div>
                </div>

                <!-- Right Column - Details -->
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
                        <div class="flex text-yellow-500">★★★★☆</div>
                        <span class="text-gray-500 text-sm">4.5 <span class="text-gray-400">(149
                                reviews)</span></span>
                    </div>

                    <!-- Price -->
                    <div class="flex items-baseline gap-2">
                        <span id="productPrice" class="text-3xl font-bold text-gray-800">0 MAD</span>
                        <span id="productOldPrice" class="text-lg line-through text-gray-400 hidden"></span>
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
                        <p id="productDescription" class="text-gray-600 text-sm">Loading...</p>
                    </div>

                    <!-- Order Form -->
                    <form id="orderForm" class="border-t pt-4 space-y-4">
                        @csrf
                        <input type="hidden" id="modal_product_id" name="product_id">

                        <!-- Quantity -->
                        <div class="flex items-center gap-4">
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-gray-700 mr-3">Quantity:</span>
                                <div class="border border-gray-300 rounded-lg flex items-center">
                                    <button type="button" onclick="decrementQuantity(this)"
                                        class="w-10 h-10 text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-colors">-</button>
                                    <input type="number" name="quantity" id="orderQuantity" value="1"
                                        min="1" max="10" class="w-16 text-center border-0 focus:ring-0"
                                        readonly />
                                    <button type="button" onclick="incrementQuantity(this)"
                                        class="w-10 h-10 text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-colors">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <button type="submit" id="addToCartBtn"
                                class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Add to Cart</span>
                            </button>
                            <button type="button"
                                class="bg-gray-100 text-gray-800 px-4 py-3 rounded-lg hover:bg-gray-200 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>

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

            <!-- Reviews Section -->
            <div id="reviews" class="border-t mt-6 pt-6">
                <h3 class="text-xl font-bold mb-6">Clients Reviews</h3>

                <!-- Add Review Form -->
                @auth
                    <div class="mb-8">
                        <form id="reviewForm" class="space-y-4">
                            @csrf
                            <input type="hidden" id="product_id" name="product_id">

                            <label class="flex items-center justify-start">
                                <div
                                    class="w-10 h-10 bg-green-400 text-white rounded-full flex items-center justify-center mr-4 font-semibold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                                <h4 class="font-semibold text-gray-900">{{ auth()->user()->name }}</h4>
                            </label>

                            <input type="text" name="comment" id="review_input" placeholder="Write your review..."
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-700 transition"
                                required />

                            <div class="flex justify-end">
                                <button type="submit" class="text-gray-400 hover:text-green-600">
                                    <svg class="w-8 h-8 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                @endauth

                <!-- Reviews List -->
                <div id="reviewsList" class="space-y-6">
                    <p class="text-gray-500 text-center py-4">Loading reviews...</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Global variable to store current product ID
        let currentProductId = null;

        function openQuickViewModal(productId) {
            currentProductId = productId;
            const modal = document.getElementById('quickViewModal');
            const loading = document.getElementById('modalLoading');

            // Open modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';

            // Show loading spinner
            loading.classList.remove('hidden');

            // Fetch product data with comments
            fetch(`/client/product/infos/${encodeURIComponent(productId)}`, {
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
                        document.getElementById('result_Product').innerHTML =
                            '<div class="col-span-2 p-8 text-center text-gray-500">Product not found</div>';
                        return;
                    }

                    const productData = Array.isArray(product) ? product[0] : product;


                    // Set product IDs for both forms
                    document.getElementById('product_id').value = productData.id;
                    document.getElementById('modal_product_id').value = productData.id;

                    // Update product details
                    document.getElementById('productName').textContent = productData.name || 'Product Name';
                    document.getElementById('productCategory').textContent = productData.category?.name ||
                        'Uncategorized';
                    document.getElementById('productCategoryLink').textContent = productData.category?.name ||
                        'Uncategorized';
                    document.getElementById('productPrice').textContent = `${productData.price || '0'} MAD`;
                    document.getElementById('productDescription').textContent = productData.description ||
                        'No description available.';
                    document.getElementById('productSKU').textContent = productData.sku || `PRD-${productData.id}`;
                    document.getElementById('productBrand').textContent = productData.brand || 'Generic';

                    // Update image
                    const imageUrl = productData.image ?
                        `/storage/${productData.image}` :
                        'https://via.placeholder.com/400x400/e5e7eb/1f2937?text=No+Image';
                    document.getElementById('productMainImage').src = imageUrl;
                    document.getElementById('productMainImage').alt = productData.name || 'Product';

                    // Update old price if exists
                    const oldPriceElement = document.getElementById('productOldPrice');
                    const discountElement = document.getElementById('productDiscount');

                    if (productData.old_price && parseFloat(productData.old_price) > parseFloat(productData.price)) {
                        oldPriceElement.textContent = `${productData.old_price} MAD`;
                        oldPriceElement.classList.remove('hidden');

                        const discount = Math.round(((parseFloat(productData.old_price) - parseFloat(productData
                            .price)) / parseFloat(productData.old_price)) * 100);
                        discountElement.textContent = `${discount}% Off`;
                        discountElement.classList.remove('hidden');
                    } else {
                        oldPriceElement.classList.add('hidden');
                        discountElement.classList.add('hidden');
                    }

                    // Display Comments/Reviews
                    displayReviews(productData.reviews || []);

                    // Fade-in animation
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

        // Quick Add to Cart (from product grid)
        // function quickAddToCart(productId) {
        //     const formData = new FormData();
        //     formData.append('quantity', 1);

        //     // Find the button using class selector
        //     const button = document.querySelector(`.quick-add-btn-${productId}`);
        //     const originalContent = button.innerHTML;

        //     // Disable button and show loading
        //     button.disabled = true;
        //     button.innerHTML = '<svg class="animate-spin h-4 w-4 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

        //     fetch(`/client/create-order/${encodeURIComponent(productId)}`, {
        //             method: 'POST',
        //             headers: {
        //                 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        //                 'Accept': 'application/json'
        //             },
        //             body: formData
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.status === 'success') {
        //                 console.log('Product added to cart:', data.data);

        //                 // Show success feedback
        //                 button.innerHTML = '<svg class="w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        //                 button.classList.remove('bg-green-600', 'hover:bg-green-700');
        //                 button.classList.add('bg-green-700');

        //                 // Show alert
        //                 alert('Product added to cart successfully!');

        //                 // Reset button after 2 seconds
        //                 setTimeout(() => {
        //                     button.disabled = false;
        //                     button.innerHTML = originalContent;
        //                     button.classList.remove('bg-green-700');
        //                     button.classList.add('bg-green-600', 'hover:bg-green-700');
        //                 }, 2000);
        //             } else {
        //                 throw new Error(data.message || 'Failed to add product to cart');
        //             }
        //         })
        //         .catch(error => {
        //             console.error('Error adding product to cart:', error);
        //             alert('Error adding product to cart. Please try again.');

        //             // Reset button
        //             button.disabled = false;
        //             button.innerHTML = originalContent;
        //         });
        // }

        function displayReviews(reviews) {
            const reviewsList = document.getElementById('reviewsList');

            if (!reviews || reviews.length === 0) {
                reviewsList.innerHTML =
                    '<p class="text-gray-500 text-center py-4">No reviews yet. Be the first to review this product!</p>';
                return;
            }

            reviewsList.innerHTML = reviews.map(comment => {
                const initials = comment.user?.name ? comment.user.name.split(' ').map(n => n[0]).join('')
                    .toUpperCase().substring(0, 2) : 'UN';
                const userName = comment.user?.name || 'Anonymous';
                const timeAgo = getTimeAgo(comment.created_at);

                return `
            <div class="border-b border-gray-200 pb-6">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-semibold mr-4">
                            ${initials}
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">${userName}</h4>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-500 text-sm mr-2">★★★★★</div>
                                <span class="text-sm text-gray-500">${timeAgo}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">${comment.comment}</p>
            </div>
        `;
            }).join('');
        }

        function getTimeAgo(date) {
            const now = new Date();
            const createdAt = new Date(date);
            const diffInMs = now - createdAt;
            const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));

            if (diffInDays === 0) return 'Today';
            if (diffInDays === 1) return '1 day ago';
            if (diffInDays < 7) return `${diffInDays} days ago`;
            if (diffInDays < 30) return `${Math.floor(diffInDays / 7)} weeks ago`;
            if (diffInDays < 365) return `${Math.floor(diffInDays / 30)} months ago`;
            return `${Math.floor(diffInDays / 365)} years ago`;
        }

        // DOM Ready
        document.addEventListener('DOMContentLoaded', function() {
            // Order Form Submit (Add to Cart in Modal)
            const orderForm = document.getElementById('orderForm');
            if (orderForm) {
                orderForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const productId = document.getElementById('modal_product_id').value;
                    const formData = new FormData(this);
                    const button = document.getElementById('addToCartBtn');
                    const originalContent = button.innerHTML;

                    // Disable button and show loading
                    button.disabled = true;
                    button.innerHTML = `
                <svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;

                    fetch(`/client/create-order/${encodeURIComponent(productId)}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                console.log('Product added to cart:', data.data);

                                // Show success state
                                button.innerHTML = `
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Added to Cart!</span>
                        `;
                                button.classList.remove('bg-green-600', 'hover:bg-green-700');
                                button.classList.add('bg-green-700');

                                // Show success message
                                alert('Product added to cart successfully!');

                                // Reset after 2 seconds
                                setTimeout(() => {
                                    button.disabled = false;
                                    button.innerHTML = originalContent;
                                    button.classList.remove('bg-green-700');
                                    button.classList.add('bg-green-600', 'hover:bg-green-700');
                                }, 2000);
                            } else {
                                throw new Error(data.message || 'Failed to add product');
                            }
                        })
                        .catch(error => {
                            console.error('Error adding product:', error);
                            alert('Error adding product to cart. Please try again.');

                            // Reset button
                            button.disabled = false;
                            button.innerHTML = originalContent;
                        });
                });
            }

            // Review Form Submit - UPDATED TO USE YOUR API ENDPOINT
            const reviewForm = document.getElementById('reviewForm');
            if (reviewForm) {
                reviewForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const productId = document.getElementById('product_id').value;
                    const comment = document.getElementById('review_input').value;
                    const submitButton = this.querySelector('button[type="submit"]');
                    const originalButtonContent = submitButton.innerHTML;

                    // Disable button and show loading
                    submitButton.disabled = true;
                    submitButton.innerHTML = `
                <svg class="animate-spin h-8 w-8 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;

                    // Create FormData
                    const formData = new FormData();
                    formData.append('comment', comment);

                    // Send review to your specific API endpoint
                    fetch(`/client/product/create-Review/${encodeURIComponent(productId)}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {

                                // Clear input
                                document.getElementById('review_input').value = '';

                                // Update reviews list with the new data from server
                                displayReviews(data.data);

                                // Show success message
                                alert('Review submitted successfully!');

                                // Reset button
                                submitButton.disabled = false;
                                submitButton.innerHTML = originalButtonContent;
                            } else {
                                throw new Error(data.message || 'Failed to submit review');
                            }
                        })
                        .catch(error => {
                            console.error('Error submitting review:', error);
                            alert(error.message || 'Error submitting review. Please try again.');

                            // Reset button
                            submitButton.disabled = false;
                            submitButton.innerHTML = originalButtonContent;
                        });
                });
            }
        });

        function closeQuickViewModal() {
            const modal = document.getElementById('quickViewModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
            currentProductId = null;
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
