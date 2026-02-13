@props(['products', 'categories'])

<!-- Products Section -->
<section id="products" class="my-14">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Recent Products</h2>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($products as $product)
            <!-- Product Card -->
            <div class="group bg-white border border-gray-200 rounded-xl p-4 hover:shadow-lg transition-all duration-300">
                <!-- Product Image Container -->
                <div class="relative mb-4 cursor-pointer" onclick="openQuickViewModal({{ $product->id }})">
                    <div class="w-full h-48 rounded-lg overflow-hidden bg-cover bg-center relative"
                        style="background-image: url('{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x300/e5e7eb/1f2937?text=No+Image' }}');">
                        @if (empty($product->image))
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-100">
                            <span class="text-sm text-gray-500">No image available</span>
                        </div>
                        @endif
                    </div>

                    <!-- Livewire Like Button -->
                    <div class="absolute top-0 right-1 z-10" onclick="event.stopPropagation()">
                        @livewire('product-likes', ['product' => $product], key($product->id))
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-3">
                    <div class="cursor-pointer" onclick="openQuickViewModal({{ $product->id }})">
                        <!-- Category -->
                        <span class="text-xs text-gray-500 hover:text-green-600 transition-colors">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>

                        <!-- Product Name -->
                        <h3 class="font-semibold text-gray-900 line-clamp-2 min-h-[2.5rem]">
                            <span class="hover:text-green-600 transition-colors">
                                {{ $product->name }}
                            </span>
                        </h3>
                    </div>

                    <!-- Price & Add to Cart -->
                    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                        <!-- Price -->
                        <div class="flex flex-col cursor-pointer" onclick="openQuickViewModal({{ $product->id }})">
                            <span class="text-lg font-bold text-gray-900">{{ number_format($product->price, 2) }} MAD</span>
                            @if($product->old_price && $product->old_price > $product->price)
                            <span class="text-xs text-gray-400 line-through">{{ number_format($product->old_price, 2) }} MAD</span>
                            @endif
                        </div>

                        <!-- Add to Cart Button (Does NOT open modal) -->
                     @livewire('cart' , ['productId'=>$product->id])

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Quick View Modal -->
<div id="quickViewModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeQuickViewModal()"></div>

    <!-- Modal Content -->
    <div class="relative w-full max-w-5xl">
        <div class="relative bg-white rounded-2xl shadow-2xl max-h-[90vh] overflow-hidden">
            <!-- Loading Spinner -->
            <div id="modalLoading" class="absolute inset-0 bg-white/90 backdrop-blur-sm flex items-center justify-center z-20 hidden">
                <div class="text-center">
                    <svg class="animate-spin h-12 w-12 text-green-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
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
                            <div class="bg-gray-100 rounded-xl overflow-hidden aspect-square relative">
                                <img id="productMainImage"
                                    src="https://via.placeholder.com/500x500/e5e7eb/1f2937?text=Loading..."
                                    alt="Product"
                                    class="w-full h-full object-cover" />
                            </div>
                        </div>

                        <!-- Right Column - Product Info -->
                        <div class="space-y-6">
                            <!-- Category -->
                            <div>
                                <a href="#" id="productCategory" class="inline-block text-sm text-green-600 hover:text-green-700 font-medium">
                                    Loading...
                                </a>
                            </div>

                            <!-- Product Name -->
                            <h2 id="productName" class="text-3xl font-bold text-gray-900">
                                Loading...
                            </h2>

                            <!-- Price -->
                            <div class="flex items-baseline gap-3">
                                <span id="productPrice" class="text-3xl font-bold text-gray-900">0 MAD</span>
                                <span id="productOldPrice" class="text-xl text-gray-400 line-through hidden"></span>
                                <span id="productDiscount" class="px-3 py-1 bg-red-100 text-red-600 text-sm font-semibold rounded-full hidden"></span>
                            </div>

                            <!-- Stock Status -->
                            <div class="flex items-center gap-2">
                                <span id="stockBadge" class="px-3 py-1 text-white text-xs font-semibold rounded-full bg-green-600">
                                    Stock
                                </span>
                                <span id="stockQuantity" class="text-sm text-gray-600 font-medium"></span>
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
                            <form action="{{ route('client.cart.add', 0) }}" method="POST" id="orderForm" class="space-y-6 border-t border-gray-200 pt-6">
                                @csrf
                                <input type="hidden" id="modal_product_id" name="product_id" value="">

                                <!-- Quantity Selector -->
                                <div class="flex items-center gap-4">
                                    <label class="text-sm font-semibold text-gray-700">Quantity:</label>
                                    <div class="inline-flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                        <button type="button" onclick="decrementQuantity(this)"
                                            class="px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <input type="number"
                                            name="quantity"
                                            id="orderQuantity"
                                            class="w-16"
                                            oninput="validateQuantity(this)"
                                            onblur="validateQuantity(this)">
                                        <button type="button" onclick="incrementQuantity(this)"
                                            class="px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Add to Cart Button -->
                                <button type="submit" id="addToCartBtn"
                                    class="w-full flex items-center justify-center gap-3 px-6 py-4 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 transition-all duration-200 disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed disabled:hover:bg-gray-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span id="addToCartText">Add to Cart</span>
                                </button>
                            </form>

                            <!-- Product Meta -->
                            <div class="space-y-3 border-t border-gray-200 pt-6">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">SKU:</span>
                                    <span id="productSKU" class="font-medium text-gray-900">-</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Category:</span>
                                    <a href="#" id="productCategoryLink" class="font-medium text-green-600 hover:text-green-700">-</a>
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

                        <!-- Add Review Form -->
                        @auth
                        <div class="relative mb-8 p-6 bg-gray-50 rounded-xl">
                            <form id="reviewForm" class="space-y-4">
                                @csrf
                                <input type="hidden" id="product_id" name="product_id">

                                <!-- User Info -->
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                    </div>
                                    <span class="font-semibold text-gray-900">{{ auth()->user()->name }}</span>
                                </div>

                                <!-- Review Input -->
                                <div class="relative">
                                    <input type="text" name="comment" id="review_input" placeholder="Write your review..."
                                        class="w-full pl-4 pr-12 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" />
                                    <button type="submit"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-green-600 hover:text-green-700 focus:outline-none">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Favorites Button -->
                                <div id="modalFavoriteWrapper" class="absolute top-4 right-4 z-10">
                                    @livewire('product-favorites', key('modal-favorites'))
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

<!-- Success Popup -->
<div id="successPopup" class="fixed top-5 right-5 hidden items-center gap-2 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg transition-all duration-300 z-50">
</div>

@push('scripts')
<script>
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

        open(productId) {
            this.currentProductId = productId;
            this.showModal();
            this.loadProduct(productId);

            if (typeof Livewire !== 'undefined') {
                Livewire.dispatch('load-product-favorites', {
                    id: productId
                });
            }
        }

        close() {
            this.modal.classList.add('hidden');
            this.modal.classList.remove('flex');
            document.body.style.overflow = '';
            this.currentProductId = null;
        }

        showModal() {
            this.modal.classList.remove('hidden');
            this.modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            this.loading.classList.remove('hidden');

            let orderQuantity = document.getElementById('orderQuantity');

            if (orderQuantity) {
                // Écoute les changements de l'input
                orderQuantity.addEventListener('input', function() {
                    validateQuantity(this);
                });

                // Valide aussi quand l'utilisateur quitte le champ
                orderQuantity.addEventListener('blur', function() {
                    validateQuantity(this);
                });

                // Empêche la saisie de caractères non-numériques avec le clavier
                orderQuantity.addEventListener('keypress', function(e) {
                    // Autorise uniquement les chiffres
                    if (!/[0-9]/.test(e.key)) {
                        e.preventDefault();
                    }
                });

                // Empêche le scroll de la molette de modifier la valeur
                orderQuantity.addEventListener('wheel', function(e) {
                    e.preventDefault();
                });
            }
        }

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
                this.showError('Error loading product. Please try again later.');
            }
        }

        populateProductData(product) {
            if (!product) {
                this.showError('Product not found');
                return;
            }

            const productData = Array.isArray(product) ? product[0] : product;

            // Reset quantity to 1
            const quantityInput = document.getElementById('orderQuantity');
            if (quantityInput) {
                quantityInput.value = 1;
            }

            // Set product IDs
            this.setElementValue('product_id', productData.id);
            this.setElementValue('modal_product_id', productData.id);

            // Update form action
            const orderForm = document.getElementById('orderForm');
            if (orderForm) {
                orderForm.action = `/client/cart/add/${productData.id}`;
            }

            // Update stock status and button state
            this.updateStockStatus(productData.quantity);

            // Update text content
            this.setElementText('productName', productData.name || 'Product Name');
            this.setElementText('productCategory', productData.category?.name || 'Uncategorized');
            this.setElementText('productCategoryLink', productData.category?.name || 'Uncategorized');
            this.setElementText('productPrice', `${productData.price || '0'} MAD`);
            this.setElementText('productDescription', productData.description || 'No description available.');
            this.setElementText('productSKU', productData.sku || `PRD-${productData.id}`);
            this.setElementText('productBrand', productData.brand || 'LocalMarket');

            // Update image
            this.updateProductImage(productData);

            // Update pricing
            this.updatePricing(productData);

            // Display reviews
            this.displayReviews(productData.reviews || []);

            // Fade-in animation
            this.fadeInResult();
        }

        updateStockStatus(quantity) {
            const stockBadge = document.getElementById('stockBadge');
            const stockQuantity = document.getElementById('stockQuantity');
            const addToCartBtn = document.getElementById('addToCartBtn');
            const addToCartText = document.getElementById('addToCartText');
            const quantityInput = document.getElementById('orderQuantity');
            const productIdInput = document.getElementById('modal_product_id');

            // Update stock display
            stockQuantity.textContent = `${quantity} units`;

            if (quantity <= 0) {
                // Out of stock
                stockBadge.textContent = 'Out of Stock';
                stockBadge.classList.remove('bg-green-600');
                stockBadge.classList.add('bg-red-500');

                // Disable button and inputs
                addToCartBtn.disabled = true;
                addToCartText.textContent = 'Out of Stock';
                quantityInput.disabled = true;
                productIdInput.disabled = true;

            } else if (quantity <= 5) {
                // Low stock
                stockBadge.textContent = 'Stock';
                stockBadge.classList.remove('bg-green-600');
                stockBadge.classList.add('bg-orange-500');

                // Enable button and inputs
                addToCartBtn.disabled = false;
                addToCartText.textContent = 'Add to Cart';
                quantityInput.disabled = false;
                productIdInput.disabled = false;

                // Update max quantity
                quantityInput.max = quantity;

            } else {
                // In stock
                stockBadge.textContent = 'In Stock';
                stockBadge.classList.remove('bg-orange-500', 'bg-red-500');
                stockBadge.classList.add('bg-green-600');

                // Enable button and inputs
                addToCartBtn.disabled = false;
                addToCartText.textContent = 'Add to Cart';
                quantityInput.disabled = false;
                productIdInput.disabled = false;

                // Update max quantity
                quantityInput.max = quantity;
            }
        }

        updateProductImage(productData) {
            const imageUrl = productData.image ?
                `/storage/${productData.image}` :
                'https://via.placeholder.com/400x400/e5e7eb/1f2937?text=No+Image';

            const imgElement = document.getElementById('productMainImage');
            imgElement.src = imageUrl;
            imgElement.alt = productData.name || 'Product';
        }

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

        displayReviews(reviews) {
            const reviewsList = document.getElementById('reviewsList');

            if (!reviews || reviews.length === 0) {
                reviewsList.innerHTML = `
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <p class="text-gray-500 font-medium">No reviews yet</p>
                    <p class="text-gray-400 text-sm mt-1">Be the first to review this product!</p>
                </div>
            `;
                return;
            }

            reviewsList.innerHTML = reviews.map(review => this.createReviewHTML(review)).join('');
        }

        createReviewHTML(review) {
            const initials = review.user?.name ?
                review.user.name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2) : 'UN';
            const userName = review.user?.name || 'Anonymous';
            const timeAgo = this.getTimeAgo(review.created_at);

            return `
            <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center font-bold text-green-600 flex-shrink-0">
                        ${initials}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="font-semibold text-gray-900">${userName}</h4>
                            <span class="text-xs text-gray-500">${timeAgo}</span>
                        </div>
                        <p class="text-gray-600 text-sm">${review.comment}</p>
                    </div>
                </div>
            </div>
        `;
        }

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

        showError(message) {
            this.loading.classList.add('hidden');
            document.getElementById('result_Product').innerHTML = `
            <div class="col-span-2 p-8 text-center">
                <div class="text-red-500 mb-2">${message}</div>
            </div>
        `;
        }

        fadeInResult() {
            const resultDiv = document.getElementById('result_Product');
            resultDiv.classList.add('opacity-0');
            setTimeout(() => {
                resultDiv.classList.remove('opacity-0');
                resultDiv.classList.add('opacity-100', 'transition-opacity', 'duration-500');
            }, 50);
        }

        setElementValue(id, value) {
            const element = document.getElementById(id);
            if (element) element.value = value;
        }

        setElementText(id, text) {
            const element = document.getElementById(id);
            if (element) element.textContent = text;
        }

        setupEventListeners() {
            const reviewForm = document.getElementById('reviewForm');
            if (reviewForm) {
                reviewForm.addEventListener('submit', (e) => this.handleSubmitReview(e));
            }
        }

        async handleSubmitReview(e) {
            e.preventDefault();

            const productId = document.getElementById('product_id').value;
            const comment = document.getElementById('review_input').value;
            const submitButton = e.target.querySelector('button[type="submit"]');
            const originalButtonContent = submitButton.innerHTML;

            try {
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
                    document.getElementById('review_input').value = '';
                    this.displayReviews(data.data);
                    showSuccessPopup('Review submitted successfully!');
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonContent;
                } else {
                    throw new Error(data.message || 'Failed to submit review');
                }

            } catch (error) {
                console.error('Error submitting review:', error);
                showSuccessPopup('Error submitting review. Please try again.');
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonContent;
            }
        }

        getSpinnerHTML(color = 'white') {
            return `
            <svg class="animate-spin h-5 w-5 mx-auto text-${color}-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        `;
        }

        setupEscapeKey() {
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    this.close();
                }
            });
        }
    }

    function showSuccessPopup(message) {
        const popup = document.getElementById('successPopup');
        popup.classList.remove('hidden');
        popup.classList.add('flex');
        popup.textContent = message;
        setTimeout(() => {
            popup.classList.add('hidden');
            popup.classList.remove('flex');
        }, 3000);
    }
    // Function to validate quantity input
    function validateQuantity(input) {
        // Removes non-numeric characters
        input.value = input.value.replace(/[^0-9]/g, '');

        // Récupère les valeurs
        const value = parseInt(input.value) || 0;
        const min = parseInt(input.getAttribute('min')) || 1;
        const max = parseInt(input.getAttribute('max')) || currentStockMax;
        // Validates against min/max
        if (value < min && input.value !== '') {
            input.value = min;
            showSuccessPopup(`Minimum quantity is ${min}`);
            return;
        } else if (value > max) {
            input.value = max;
            showSuccessPopup(`Maximum available quantity is ${max}`);
            return;
        } else {
            checkServerQuantity(value, input);
        }
        // Si l'input est désactivé (rupture de stock), empêcher toute saisie
        if (input.disabled) {
            input.value = '';
            showSuccessPopup('Product is out of stock');
            return;
        }
    }

    function incrementQuantity(button) {
        const input = button.previousElementSibling;
        const value = parseInt(input.value) || 0;
        const max = parseInt(input.getAttribute('max')) || currentStockMax;
        if (value < max) {
            input.value = value + 1;
            validateQuantity(input);
        } else {
            showSuccessPopup(`Maximum available quantity is ${max}`);
        }
    }

    function decrementQuantity(button) {
        const input = button.nextElementSibling;
        const value = parseInt(input.value) || 0;
        const min = parseInt(input.getAttribute('min')) || 1;
        if (input.disabled) {
            showSuccessPopup('Product is out of stock');
            return;
        }

        if (value > min) {
            input.value = value - 1;
            validateQuantity(input);
        } else {
            showSuccessPopup(`Minimum quantity is ${min}`);
        }
    }

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

    document.addEventListener('DOMContentLoaded', function() {
        quickViewModal = new QuickViewModal();
    });



    // ============================================
    // SOLUTION COMPLÈTE POUR LA VALIDATION DE QUANTITÉ
    // ============================================

    // Variable globale pour le debounce
    let quantityCheckTimer;
    let currentStockMax = 999; // Stock maximum par défaut

    /**
     * Valide la quantité saisie par l'utilisateur
     * - Bloque si produit en rupture de stock
     * - Nettoie les caractères non-numériques
     * - Vérifie min/max
     * - Déclenche vérification serveur
     */


    /**
     * Vérifie la disponibilité du stock côté serveur
     * Utilise un debounce pour éviter trop de requêtes
     */
    async function checkServerQuantity(quantity, input) {
        // Annule le timer précédent
        clearTimeout(quantityCheckTimer);

        // Lance une nouvelle vérification après 500ms
        quantityCheckTimer = setTimeout(async () => {
            const productId = document.getElementById('modal_product_id').value;

            if (!productId) {
                console.error('Product ID not found');
                return;
            }

            try {
                const response = await fetch(
                    `/client/product/Quantity/${encodeURIComponent(productId)}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    }
                );

                if (!response.ok) {
                    throw new Error('Failed to fetch stock information');
                }

                const data = await response.json();

                // Met à jour le stock maximum basé sur la réponse serveur
                if (data.quantity !== undefined) {
                    currentStockMax = parseInt(data.quantity);
                    input.setAttribute('max', currentStockMax);

                    // Vérifie si la quantité actuelle dépasse le stock disponible
                    if (quantity > currentStockMax) {
                        input.value = currentStockMax;

                        if (currentStockMax === 0) {
                            // Rupture de stock
                            showSuccessPopup('Product is now out of stock');
                            input.disabled = true;

                            const addToCartBtn = document.getElementById('addToCartBtn');
                            if (addToCartBtn) {
                                addToCartBtn.disabled = true;
                                document.getElementById('addToCartText').textContent = 'Out of Stock';
                            }
                        } else {
                            // Stock limité
                            showSuccessPopup(`Only ${currentStockMax} unit(s) available in stock`);
                        }
                    }
                }

            } catch (error) {
                console.error('Error checking quantity:', error);
                showSuccessPopup('Unable to verify stock availability');
            }
        }, 500); // Attends 500ms après la dernière frappe
    }
    /**
     * Initialisation quand le DOM est chargé
     */

    // ============================================
    // EXEMPLE DE RÉPONSE SERVEUR ATTENDUE
    // ============================================
    /*
    Route côté serveur (Laravel):
    Route::get('/client/product/Quantity/{productId}', function($productId) {
        $product = Product::find($productId);
        
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        
        return response()->json([
            'quantity' => $product->quantity,
            'product_id' => $product->id,
            'name' => $product->name
        ]);
    });
    */
</script>
@endpush