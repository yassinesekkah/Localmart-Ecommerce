@props(['products', 'categories'])

<!-- Products Section -->
<section id="products" class="my-14">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Products</h2>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($products as $product)
                <!-- Product Card -->
                <div onclick="openQuickViewModal({{ $product->id }})"
                    class="group bg-white border cursor-pointer border-gray-200 rounded-xl p-4 hover:shadow-lg transition-all duration-300">
                    <!-- Product Image Container -->
                    <div class="relative mb-4 overflow-hidden rounded-lg">
                        <!-- Sale Badge -->
                        @if ($product->old_price && $product->old_price > $product->price)
                            <span
                                class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-semibold px-2.5 py-1 rounded-md">
                                Sale
                            </span>
                        @endif

                        <!-- Product Image -->
                        <div class="relative h-48 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x300/e5e7eb/1f2937?text=No+Image' }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">

                            @if (empty($product->image))
                                <span class="absolute inset-0 flex items-center justify-center text-sm text-gray-500">
                                    No image available
                                </span>
                            @endif
                        </div>

                        <!-- Hover Actions -->
                        <div
                            class="absolute inset-x-0 bottom-4 flex justify-center items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <!-- Quick View Button -->
                            <button onclick="openQuickViewModal({{ $product->id }})"
                                class="p-2 bg-white rounded-lg shadow-md hover:bg-green-600 hover:text-white transition-colors duration-200"
                                title="Quick View">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>

                            <!-- Wishlist Button -->
                            <button
                                class="p-2 bg-white rounded-lg shadow-md hover:bg-green-600 hover:text-white transition-colors duration-200"
                                title="Add to Wishlist">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="space-y-3">
                        <!-- Category -->
                        <a href="#" class="text-xs text-gray-500 hover:text-green-600 transition-colors">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </a>

                        <!-- Product Name -->
                        <h3 class="font-semibold text-gray-900 line-clamp-2 min-h-[2.5rem]">
                            <a href="#" class="hover:text-green-600 transition-colors">
                                {{ $product->name }}
                            </a>
                        </h3>

                        <!-- Rating -->
                        <div class="flex items-center gap-2">
                            <div class="flex text-yellow-400 text-sm">
                                ★★★★☆
                            </div>
                            <span class="text-xs text-gray-500">(149)</span>
                        </div>

                        <!-- Price & Add to Cart -->
                        <div class="flex items-center justify-between pt-2">
                            <!-- Price -->
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-gray-900">{{ number_format($product->price, 2) }}
                                    MAD</span>
                                @if ($product->old_price && $product->old_price > $product->price)
                                    <span
                                        class="text-xs text-gray-400 line-through">{{ number_format($product->old_price, 2) }}
                                        MAD</span>
                                @endif
                            </div>

                            <!-- Add to Cart Button -->
                            <form action="{{ route('client.cart.add', $product->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-1 px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>Add</span>
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
<div id="quickViewModal" class="fixed flex items-center justify-center inset-0 z-50 hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeQuickViewModal()"></div>

    <!-- Modal Container -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <!-- Modal Content -->
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden">
            <!-- Loading Spinner -->
            <div id="modalLoading"
                class="absolute inset-0 bg-white/90 backdrop-blur-sm flex items-center justify-center z-20 hidden">
                <div class="text-center">
                    <svg class="animate-spin h-12 w-12 text-green-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <p class="text-gray-600 font-medium">Loading product...</p>
                </div>
            </div>

            <!-- Close Button -->
            <button onclick="closeQuickViewModal()"
                class="absolute top-4 right-4 z-30 p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Scrollable Content -->
            <div class="overflow-y-auto max-h-[90vh]">
                <div class="p-6 md:p-8">
                    <!-- Product Details -->
                    <div id="result_Product" class="grid md:grid-cols-2 gap-8">
                        <!-- Left Column - Image -->
                        <div class="space-y-4">
                            <div class="bg-gray-100 rounded-xl overflow-hidden aspect-square">
                                <img id="productMainImage"
                                    src="https://via.placeholder.com/500x500/e5e7eb/1f2937?text=Loading..."
                                    alt="Product" class="w-full h-full object-cover" />
                            </div>
                        </div>

                        <!-- Right Column - Product Info -->
                        <div class="space-y-6">
                            <!-- Category -->
                            <div>
                                <a href="#" id="productCategory"
                                    class="inline-block text-sm text-green-600 hover:text-green-700 font-medium">
                                    Loading...
                                </a>
                            </div>

                            <!-- Product Name -->
                            <h2 id="productName" class="text-3xl font-bold text-gray-900">
                                Loading...
                            </h2>

                            <!-- Rating -->
                            <div class="flex items-center gap-3">
                                <div class="flex text-yellow-400 text-lg">
                                    ★★★★☆
                                </div>
                                <span class="text-sm text-gray-500">4.5 (149 reviews)</span>
                            </div>

                            <!-- Price -->
                            <div class="flex items-baseline gap-3">
                                <span id="productPrice" class="text-xl font-bold text-gray-900">0 MAD</span>
                                <span id="productOldPrice" class="text-xl text-gray-400 line-through hidden"></span>
                                <span id="productDiscount"
                                    class="px-3 py-1 bg-red-100 text-red-600 text-sm font-semibold rounded-full hidden"></span>
                            </div>

                            <!-- Stock Status -->
                            <div class="flex items-center gap-2">
                                <span
                                    class="Stok1 px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full">
                                    Stock
                                </span>
                                <span class="Stock text-sm text-gray-600 font-medium"></span>
                            </div>

                            <!-- Description -->
                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-3">
                                    Description
                                </h3>
                                <p id="productDescription" class="text-gray-600 leading-relaxed">
                                    Loading...
                                </p>
                            </div>

                            <!-- Order Form -->
                            <form action="{{ route('client.cart.add', $product->id ?? 0) }}" method="POST"
                                class="space-y-6 border-t border-gray-200 pt-6">
                                @csrf
                                <input type="hidden" id="modal_product_id" name="product_id">

                                <!-- Quantity Selector -->
                                <div class="flex items-center gap-4">
                                    <label class="text-sm font-semibold text-gray-700">Quantity:</label>
                                    <div
                                        class="inline-flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                        <button type="button" onclick="decrementQuantity(this)"
                                            class="px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <input type="number" name="quantity" id="orderQuantity" value="1"
                                            min="1" max="10"
                                            class="w-16 px-4 py-3 text-center border-x border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500"
                                            readonly />
                                        <button type="button" onclick="incrementQuantity(this)"
                                            class="px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Add to Cart Button -->
                                <button type="submit" id="addToCartBtn"
                                    class="w-full flex items-center justify-center gap-3 px-6 py-4 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Add to Cart</span>
                                </button>
                            </form>

                            <livewire:product-likes :product="$product" :key="'product-like-' . $product->id" />

                            <!-- Product Meta -->
                            <div class="space-y-3 border-t border-gray-200 pt-6">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">SKU:</span>
                                    <span id="productSKU" class="font-medium text-gray-900">-</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Category:</span>
                                    <a href="#" id="productCategoryLink"
                                        class="font-medium text-green-600 hover:text-green-700">-</a>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Brand:</span>
                                    <span id="productBrand" class="font-medium text-gray-900">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div id="reviews" class="mt-12 border-t border-gray-200 pt-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h3>

                        <!-- Add Review Form (Authenticated Users Only) -->
                        @auth
                            <div class="mb-8 p-6 bg-gray-50 rounded-xl">
                                <form id="reviewForm" class="space-y-4">
                                    @csrf
                                    <input type="hidden" id="product_id" name="product_id">

                                    <!-- User Info -->
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                        </div>
                                        <span class="font-semibold text-gray-900">{{ auth()->user()->name }}</span>
                                    </div>

                                    <!-- Review Input -->
                                    <div class="relative">
                                        <input type="text" name="comment" id="review_input"
                                            placeholder="Write your review..."
                                            class="w-full pl-4 pr-12 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                            required />
                                        <button type="submit"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-green-600 hover:text-green-700 focus:outline-none">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endauth

                        <!-- Reviews List -->
                        <div id="reviewsList" class="space-y-6">
                            <p class="text-center text-gray-500 py-8">Loading reviews...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // ========================================
        // QUICK VIEW MODAL - Product Management
        // ========================================

        class QuickViewModal {
            constructor() {
                this.currentProductId = null;
                this.modal = document.getElementById('quickViewModal');
                this.loading = document.getElementById('modalLoading');
                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupEscapeKey();
            }

            // Open modal and load product
            open(productId) {
                this.currentProductId = productId;
                this.showModal();
                this.loadProduct(productId);
            }

            // Close modal
            close() {
                this.modal.classList.add('hidden');
                this.modal.classList.remove('flex');
                document.body.style.overflow = '';
                this.currentProductId = null;
            }

            // Show modal UI
            showModal() {
                this.modal.classList.remove('hidden');
                this.modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
                this.loading.classList.remove('hidden');
            }

            // Load product data from API
            async loadProduct(productId) {
                try {
                    const response = await fetch(`/client/product/infos/${encodeURIComponent(productId)}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok) throw data;

                    this.loading.classList.add('hidden');
                    this.populateProductData(data);

                } catch (error) {
                    console.error('Error fetching product:', error);
                    this.showError('Error loading product. Please try again later.');
                }
            }

            // Populate modal with product data
            populateProductData(product) {
                if (!product) {
                    this.showError('Product not found');
                    return;
                }

                const productData = Array.isArray(product) ? product[0] : product;

                // Set product IDs
                this.setElementValue('product_id', productData.id);
                this.setElementValue('modal_product_id', productData.id);

                // Update text content
                this.setElementText('productName', productData.name || 'Product Name');
                this.setElementText('productCategory', productData.category?.name || 'Uncategorized');
                this.setElementText('productCategoryLink', productData.category?.name || 'Uncategorized');
                this.setElementText('productPrice', `${productData.price || '0'} MAD`);
                this.setElementText('productDescription', productData.description || 'No description available.');
                this.setElementText('productSKU', productData.sku || `PRD-${productData.id}`);
                this.setElementText('productBrand', productData.brand || 'LocalMarket');
                let Stok = document.querySelector('.Stock')
                Stok.textContent = productData.quantity
                if (productData.quantity <= 5) {
                    let style = document.querySelector('.Stok1')
                    style.classList.remove('bg-green-700')
                    style.classList.add('bg-red-500')
                }

                // Update image
                this.updateProductImage(productData);

                // Update pricing
                this.updatePricing(productData);

                // Display reviews
                this.displayReviews(productData.reviews || []);

                // Fade-in animation
                this.fadeInResult();
            }

            // Update product image
            updateProductImage(productData) {
                const imageUrl = productData.image ?
                    `/storage/${productData.image}` :
                    'https://via.placeholder.com/400x400/e5e7eb/1f2937?text=No+Image';

                const imgElement = document.getElementById('productMainImage');
                imgElement.src = imageUrl;
                imgElement.alt = productData.name || 'Product';
            }

            // Update pricing with discount
            updatePricing(productData) {
                const oldPriceElement = document.getElementById('productOldPrice');
                const discountElement = document.getElementById('productDiscount');

                if (productData.old_price && parseFloat(productData.old_price) > parseFloat(productData.price)) {
                    oldPriceElement.textContent = `${productData.old_price} MAD`;
                    oldPriceElement.classList.remove('hidden');

                    const discount = Math.round(
                        ((parseFloat(productData.old_price) - parseFloat(productData.price)) /
                            parseFloat(productData.old_price)) * 100
                    );

                    discountElement.textContent = `${discount}% Off`;
                    discountElement.classList.remove('hidden');
                } else {
                    oldPriceElement.classList.add('hidden');
                    discountElement.classList.add('hidden');
                }
            }

            // Display product reviews
            displayReviews(reviews) {
                const reviewsList = document.getElementById('reviewsList');

                if (!reviews || reviews.length === 0) {
                    reviewsList.innerHTML = `
                <p class="text-gray-500 text-center py-4">
                    No reviews yet. Be the first to review this product!
                </p>
            `;
                    return;
                }

                reviewsList.innerHTML = reviews.map(review => this.createReviewHTML(review)).join('');
            }

            // Create review HTML
            createReviewHTML(review) {
                const initials = review.user?.name ?
                    review.user.name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2) :
                    'UN';
                const userName = review.user?.name || 'Anonymous';
                const timeAgo = this.getTimeAgo(review.created_at);

                return `
            <div class="border-b border-gray-200 pb-6 mb-6">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center font-bold text-green-600 mr-4">
                            ${initials}
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">${userName}</h4>
                            <div class="flex items-center mt-1">
                                <span class="text-sm text-gray-500">${timeAgo}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">${review.comment}</p>
            </div>
        `;
            }

            // Calculate time ago
            getTimeAgo(date) {
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

            // Show error message
            showError(message) {
                this.loading.classList.add('hidden');
                document.getElementById('result_Product').innerHTML = `
            <div class="col-span-2 p-8 text-center">
                <div class="text-red-500 mb-2">${message}</div>
            </div>
        `;
            }

            // Fade-in animation
            fadeInResult() {
                const resultDiv = document.getElementById('result_Product');
                resultDiv.classList.add('opacity-0');
                setTimeout(() => {
                    resultDiv.classList.remove('opacity-0');
                    resultDiv.classList.add('opacity-100', 'transition-opacity', 'duration-500');
                }, 50);
            }

            // Helper: Set element value
            setElementValue(id, value) {
                const element = document.getElementById(id);
                if (element) element.value = value;
            }

            // Helper: Set element text
            setElementText(id, text) {
                const element = document.getElementById(id);
                if (element) element.textContent = text;
            }

            // Setup event listeners
            setupEventListeners() {
                // Add to Cart Form
                const orderForm = document.getElementById('orderForm');
                if (orderForm) {
                    orderForm.addEventListener('submit', (e) => this.handleAddToCart(e));
                }

                // Review Form
                const reviewForm = document.getElementById('reviewForm');
                if (reviewForm) {
                    reviewForm.addEventListener('submit', (e) => this.handleSubmitReview(e));
                }
            }

            // Handle Add to Cart
            async handleAddToCart(e) {
                e.preventDefault();

                const productId = document.getElementById('modal_product_id').value;
                const form = e.target;
                const button = document.getElementById('addToCartBtn');
                const originalContent = button.innerHTML;

                try {
                    // Show loading
                    button.disabled = true;
                    button.innerHTML = this.getSpinnerHTML();

                    const formData = new FormData(form);
                    const response = await fetch(`/client/create-order/${encodeURIComponent(productId)}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        this.showAddToCartSuccess(button, originalContent);
                    } else {
                        throw new Error(data.message || 'Failed to add product');
                    }

                } catch (error) {
                    console.error('Error adding product:', error);
                    alert('Error adding product to cart. Please try again.');
                    button.disabled = false;
                    button.innerHTML = originalContent;
                }
            }

            // Show Add to Cart success
            showAddToCartSuccess(button, originalContent) {
                button.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>Added to Cart!</span>
        `;
                button.classList.remove('bg-green-600', 'hover:bg-green-700');
                button.classList.add('bg-green-700');

                alert('Product added to cart successfully!');

                setTimeout(() => {
                    button.disabled = false;
                    button.innerHTML = originalContent;
                    button.classList.remove('bg-green-700');
                    button.classList.add('bg-green-600', 'hover:bg-green-700');
                }, 2000);
            }

            // Handle Submit Review
            async handleSubmitReview(e) {
                e.preventDefault();

                const productId = document.getElementById('product_id').value;
                const comment = document.getElementById('review_input').value;
                const submitButton = e.target.querySelector('button[type="submit"]');
                const originalButtonContent = submitButton.innerHTML;

                try {
                    // Show loading
                    submitButton.disabled = true;
                    submitButton.innerHTML = this.getSpinnerHTML('green');

                    const formData = new FormData();
                    formData.append('comment', comment);

                    const response = await fetch(`/client/product/create-Review/${encodeURIComponent(productId)}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        // Clear input
                        document.getElementById('review_input').value = '';

                        // Update reviews
                        this.displayReviews(data.data);

                        // Reset button
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonContent;
                    } else {
                        throw new Error(data.message || 'Failed to submit review');
                    }

                } catch (error) {
                    console.error('Error submitting review:', error);
                    alert(error.message || 'Error submitting review. Please try again.');
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonContent;
                }
            }

            // Get spinner HTML
            getSpinnerHTML(color = 'white') {
                return `
            <svg class="animate-spin h-5 w-5 mx-auto text-${color}-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        `;
            }

            // Setup escape key
            setupEscapeKey() {
                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        this.close();
                    }
                });
            }
        }

        // ========================================
        // QUANTITY CONTROLS
        // ========================================

        function incrementQuantity(button) {
            const input = button.previousElementSibling;
            const value = parseInt(input.value);
            const max = parseInt(input.max);

            if (value < max) {
                input.value = value + 1;
            }
        }

        function decrementQuantity(button) {
            const input = button.nextElementSibling;
            const value = parseInt(input.value);
            const min = parseInt(input.min);

            if (value > min) {
                input.value = value - 1;
            }
        }

        // ========================================
        // GLOBAL FUNCTIONS (for HTML onclick)
        // ========================================

        let quickViewModal;

        function openQuickViewModal(productId) {
            if (!quickViewModal) {
                quickViewModal = new QuickViewModal();
            }
            quickViewModal.open(productId);
        }

        function closeQuickViewModal() {
            if (quickViewModal) {
                quickViewModal.close();
            }
        }

        // ========================================
        // INITIALIZATION
        // ========================================

        document.addEventListener('DOMContentLoaded', function() {
            quickViewModal = new QuickViewModal();
        });
    </script>
@endpush
