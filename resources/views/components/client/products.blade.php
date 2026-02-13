@props(['products', 'categories'])

<!-- Products Section -->
<section id="products" class="my-14">
    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Recent Products</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($products as $product)
            <div class="group bg-white border border-gray-200 rounded-xl p-4 hover:shadow-lg transition-all duration-300">
                <div class="relative mb-4 cursor-pointer" onclick="openQuickViewModal({{ $product->id }})">
                    <div class="w-full h-48 rounded-lg overflow-hidden bg-cover bg-center relative"
                        style="background-image: url('{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x300/e5e7eb/1f2937?text=No+Image' }}');">
                        @if (empty($product->image))
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-100">
                            <span class="text-sm text-gray-500">No image available</span>
                        </div>
                        @endif
                    </div>
                    <div class="absolute top-0 right-1 z-10" onclick="event.stopPropagation()">
                        @livewire('product-likes', ['product' => $product], key($product->id))
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="cursor-pointer" onclick="openQuickViewModal({{ $product->id }})">
                        <span class="text-xs text-gray-500 hover:text-green-600 transition-colors">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                        <h3 class="font-semibold text-gray-900 line-clamp-2 min-h-[2.5rem]">
                            <span class="hover:text-green-600 transition-colors">{{ $product->name }}</span>
                        </h3>
                    </div>
                    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                        <div class="flex flex-col cursor-pointer" onclick="openQuickViewModal({{ $product->id }})">
                            <span class="text-lg font-bold text-gray-900">{{ number_format($product->price, 2) }} MAD</span>
                            @if($product->old_price && $product->old_price > $product->price)
                            <span class="text-xs text-gray-400 line-through">{{ number_format($product->old_price, 2) }} MAD</span>
                            @endif
                        </div>
                        @livewire('cart', ['productId' => $product->id])
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{--
    ✅ FAVORITES PORTAL
    One hidden favorites component per product, rendered while $product is in scope.
    JS will show the correct one when the modal opens.
--}}
@auth
<div id="favoritesPortal" class="hidden">
    @foreach ($products as $product)
    <div data-favorite-id="{{ $product->id }}">
        @livewire('product-favorites', ['product' => $product], key('fav-modal-' . $product->id))
    </div>
    @endforeach
</div>
@endauth

<!-- Quick View Modal -->
<div id="quickViewModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeQuickViewModal()"></div>

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

            <div class="overflow-y-auto max-h-[90vh]">
                <div class="p-6 md:p-8">

                    <div id="result_Product" class="grid md:grid-cols-2 gap-8">
                        <!-- Left: Image -->
                        <div class="space-y-4">
                            <div class="bg-gray-100 rounded-xl overflow-hidden aspect-square relative">
                                <img id="productMainImage"
                                    src="https://via.placeholder.com/500x500/e5e7eb/1f2937?text=Loading..."
                                    alt="Product" class="w-full h-full object-cover" />
                            </div>
                        </div>

                        <!-- Right: Info -->
                        <div class="space-y-6">
                            <a href="#" id="productCategory" class="inline-block text-sm text-green-600 hover:text-green-700 font-medium">Loading...</a>
                            <h2 id="productName" class="text-3xl font-bold text-gray-900">Loading...</h2>

                            <div class="flex items-baseline gap-3">
                                <span id="productPrice" class="text-3xl font-bold text-gray-900">0 MAD</span>
                                <span id="productOldPrice" class="text-xl text-gray-400 line-through hidden"></span>
                                <span id="productDiscount" class="px-3 py-1 bg-red-100 text-red-600 text-sm font-semibold rounded-full hidden"></span>
                            </div>

                            <div class="flex items-center gap-2">
                                <span id="stockBadge" class="px-3 py-1 text-white text-xs font-semibold rounded-full bg-green-600">Stock</span>
                                <span id="stockQuantity" class="text-sm text-gray-600 font-medium"></span>
                            </div>

                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-3">Description</h3>
                                <p id="productDescription" class="text-gray-600 leading-relaxed">Loading...</p>
                            </div>

                            <!-- Order Form -->
                            <form action="{{ route('client.cart.add', 0) }}" method="POST" id="orderForm" class="space-y-6 border-t border-gray-200 pt-6">
                                @csrf
                                <input type="hidden" id="modal_product_id" name="product_id" value="">
                                <div class="flex items-center gap-4">
                                    <label class="text-sm font-semibold text-gray-700">Quantity:</label>
                                    <div class="inline-flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                        <button type="button" onclick="decrementQuantity(this)"
                                            class="px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <input type="number" name="quantity" id="orderQuantity"
                                            class="w-16 px-4 py-3 text-center border-x border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500"
                                            oninput="validateQuantity(this)" onblur="validateQuantity(this)">
                                        <button type="button" onclick="incrementQuantity(this)"
                                            class="px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
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

                    <!-- =============================== -->
                    <!--        REVIEWS SECTION          -->
                    <!-- =============================== -->
                    <div id="reviews" class="mt-12 border-t border-gray-200 pt-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h3>

                        @auth
                        {{--
                            reviewFormWrapper:
                            - Shown only when user has NOT yet reviewed (JS controls this)
                            - Contains the comment form + the favorites button (mounted from portal via JS)
                            - When user HAS reviewed: this whole block is hidden, only reviewsList shows
                        --}}
                        <div id="reviewFormWrapper" class="mb-8 p-6 bg-gray-50 rounded-xl relative">

                            <form id="reviewForm" class="space-y-4">
                                @csrf
                                <input type="hidden" id="product_id" name="product_id">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                    </div>
                                    <span class="font-semibold text-gray-900">{{ auth()->user()->name }}</span>
                                </div>
                                <div class="relative">
                                    <input type="text" name="comment" id="review_input"
                                        placeholder="Write your review..."
                                        class="w-full pl-4 pr-12 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" />
                                    <button type="submit"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-green-600 hover:text-green-700 focus:outline-none">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
                                        </svg>
                                    </button>
                                </div>
                            </form>

                            {{--
                                ✅ Slot where the correct Livewire favorites component gets moved into by JS.
                                It stays empty until openQuickViewModal() calls mountFavorite(productId).
                            --}}
                            <div id="modalFavoriteSlot"
                                class="absolute top-4 right-4 z-10"
                                onclick="event.stopPropagation()">
                            </div>

                        </div>
                        @else
                        <div class="mb-8 p-5 bg-gray-50 rounded-xl text-center border border-dashed border-gray-300">
                            <p class="text-gray-500 text-sm">
                                <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">Login</a>
                                to leave a review
                            </p>
                        </div>
                        @endauth

                        <!-- Reviews List -->
                        <div id="reviewsList" class="space-y-4">
                            <p class="text-center text-gray-500 py-8">Loading reviews...</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popups -->
<div id="successPopup" class="fixed top-5 right-5 hidden items-center gap-2 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-[100]"></div>
<div id="errorPopup"   class="fixed top-5 right-5 hidden items-center gap-2 bg-red-500   text-white px-4 py-3 rounded-lg shadow-lg z-[100]"></div>

@push('scripts')
<script>
class QuickViewModal {
    constructor() {
        this.currentProductId  = null;
        this.modal             = document.getElementById('quickViewModal');
        this.loading           = document.getElementById('modalLoading');
        this.authUserId        = {{ auth()->id() ?? 'null' }};
        this.previousProductId = null; // track which favorite is currently mounted
        this.init();
    }

    init() {
        this.setupReviewFormListener();
        this.setupEscapeKey();
    }

    open(productId) {
        this.currentProductId = productId;
        this.showModal();
        this.loadProduct(productId);
        // Mount the correct favorites component for this product
        this.mountFavorite(productId);
        // Also dispatch for any Livewire listener
        if (typeof Livewire !== 'undefined') {
            Livewire.dispatch('load-product-favorites', { id: productId });
        }
    }

    close() {
        this.modal.classList.add('hidden');
        this.modal.classList.remove('flex');
        document.body.style.overflow = '';
        this.currentProductId = null;
    }

    // ✅ Move the correct hidden favorites component into the modal slot
    mountFavorite(productId) {
        const slot   = document.getElementById('modalFavoriteSlot');
        const portal = document.getElementById('favoritesPortal');
        if (!slot || !portal) return;

        // Put back previous one if any
        if (this.previousProductId) {
            const prev = portal.querySelector(`[data-favorite-id="${this.previousProductId}"]`);
            if (prev) {
                prev.style.display = '';
                portal.appendChild(prev);
            }
        }

        // Move the matching one into the slot
        const target = portal.querySelector(`[data-favorite-id="${productId}"]`);
        if (target) {
            slot.innerHTML = ''; // clear slot
            slot.appendChild(target);
            target.style.display = '';
        }

        this.previousProductId = productId;
    }

    showModal() {
        this.modal.classList.remove('hidden');
        this.modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        this.loading.classList.remove('hidden');

        const qty = document.getElementById('orderQuantity');
        if (qty) {
            // Remove old listeners by cloning
            const fresh = qty.cloneNode(true);
            qty.parentNode.replaceChild(fresh, qty);
            fresh.addEventListener('input',    () => validateQuantity(fresh));
            fresh.addEventListener('blur',     () => validateQuantity(fresh));
            fresh.addEventListener('keypress', (e) => { if (!/[0-9]/.test(e.key)) e.preventDefault(); });
            fresh.addEventListener('wheel',    (e) => e.preventDefault());
        }
    }

    async loadProduct(productId) {
        try {
            const res  = await fetch(`/client/product/infos/${encodeURIComponent(productId)}`, {
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' }
            });
            const data = await res.json();
            if (!res.ok) throw data;
            this.loading.classList.add('hidden');
            this.populateProductData(data);
        } catch {
            this.showError('Error loading product. Please try again later.');
        }
    }

    populateProductData(product) {
        if (!product) { this.showError('Product not found'); return; }
        const p = Array.isArray(product) ? product[0] : product;

        const qty = document.getElementById('orderQuantity');
        if (qty) qty.value = 1;

        this.setVal('product_id',       p.id);
        this.setVal('modal_product_id', p.id);

        const form = document.getElementById('orderForm');
        if (form) form.action = `/client/cart/add/${p.id}`;

        this.updateStockStatus(p.quantity);
        this.setText('productName',         p.name           || 'Product Name');
        this.setText('productCategory',     p.category?.name || 'Uncategorized');
        this.setText('productCategoryLink', p.category?.name || 'Uncategorized');
        this.setText('productPrice',        `${p.price || '0'} MAD`);
        this.setText('productDescription',  p.description    || 'No description available.');
        this.setText('productSKU',          p.sku            || `PRD-${p.id}`);
        this.setText('productBrand',        p.brand          || 'LocalMarket');

        this.updateImage(p);
        this.updatePricing(p);

        const reviews = p.reviews || [];
        this.displayReviews(reviews);
        this.updateReviewForm(reviews);  // ← controls wrapper visibility

        this.fadeIn();
    }

    // ✅ If user already reviewed: hide the whole form wrapper (nothing shown above the list)
    // If user hasn't reviewed: show the wrapper (form + favorites button)
    updateReviewForm(reviews) {
        const wrapper = document.getElementById('reviewFormWrapper');
        if (!wrapper) return; // guest: element doesn't exist

        const hasReviewed = this.authUserId
            && reviews.some(r => Number(r.user_id) === Number(this.authUserId));

        if (hasReviewed) {
            // Hide entire form wrapper — user just sees the reviews list
            wrapper.classList.add('hidden');
        } else {
            // Show form wrapper so user can comment and use favorites
            wrapper.classList.remove('hidden');
        }
    }

    updateStockStatus(quantity) {
        const badge   = document.getElementById('stockBadge');
        const qty     = document.getElementById('stockQuantity');
        const btn     = document.getElementById('addToCartBtn');
        const btnText = document.getElementById('addToCartText');
        const input   = document.getElementById('orderQuantity');
        const hidden  = document.getElementById('modal_product_id');

        qty.textContent = `${quantity} units`;

        const enable  = () => { btn.disabled = false; btnText.textContent = 'Add to Cart'; input.disabled = false; hidden.disabled = false; input.max = quantity; };
        const disable = () => { btn.disabled = true;  btnText.textContent = 'Out of Stock'; input.disabled = true; hidden.disabled = true; };

        if (quantity <= 0) {
            badge.textContent = 'Out of Stock';
            badge.className   = 'px-3 py-1 text-white text-xs font-semibold rounded-full bg-red-500';
            disable();
        } else if (quantity <= 5) {
            badge.textContent = 'Low Stock';
            badge.className   = 'px-3 py-1 text-white text-xs font-semibold rounded-full bg-orange-500';
            enable();
        } else {
            badge.textContent = 'In Stock';
            badge.className   = 'px-3 py-1 text-white text-xs font-semibold rounded-full bg-green-600';
            enable();
        }
    }

    updateImage(p) {
        const img = document.getElementById('productMainImage');
        img.src   = p.image ? `/storage/${p.image}` : 'https://via.placeholder.com/400x400/e5e7eb/1f2937?text=No+Image';
        img.alt   = p.name || 'Product';
    }

    updatePricing(p) {
        const oldEl  = document.getElementById('productOldPrice');
        const discEl = document.getElementById('productDiscount');
        if (p.old_price && parseFloat(p.old_price) > parseFloat(p.price)) {
            oldEl.textContent = `${p.old_price} MAD`;
            oldEl.classList.remove('hidden');
            const pct = Math.round(((parseFloat(p.old_price) - parseFloat(p.price)) / parseFloat(p.old_price)) * 100);
            discEl.textContent = `${pct}% Off`;
            discEl.classList.remove('hidden');
        } else {
            oldEl.classList.add('hidden');
            discEl.classList.add('hidden');
        }
    }

    displayReviews(reviews) {
        const list = document.getElementById('reviewsList');
        if (!reviews || reviews.length === 0) {
            list.innerHTML = `
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <p class="text-gray-500 font-medium">No reviews yet</p>
                    <p class="text-gray-400 text-sm mt-1">Be the first to review this product!</p>
                </div>`;
            return;
        }
        list.innerHTML = reviews.map(r => this.reviewHTML(r)).join('');
    }

    reviewHTML(review) {
        const initials = review.user?.name
            ? review.user.name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2)
            : 'UN';
        const userName = review.user?.name || 'Anonymous';
        const timeAgo  = this.timeAgo(review.created_at);
        const isOwn    = this.authUserId && Number(review.user_id) === Number(this.authUserId);

        let stars = '';
        for (let i = 1; i <= 5; i++) {
            stars += `<svg class="w-3 h-3 ${review.user_rating >= i ? 'text-yellow-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>`;
        }

        return `
        <div class="rounded-lg p-4 border ${isOwn ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-gray-100 hover:bg-gray-100 transition'}">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 ${isOwn ? 'bg-green-500 text-white' : 'bg-green-100 text-green-600'} rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">
                    ${initials}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-0.5">
                        <h4 class="font-semibold text-gray-900 text-sm">
                            ${userName}${isOwn ? ' <span class="text-xs text-green-600 font-normal">(You)</span>' : ''}
                        </h4>
                        <span class="text-[10px] text-gray-400">${timeAgo}</span>
                    </div>
                    <div class="flex items-center gap-0.5 mb-2">${stars}</div>
                    <p class="text-gray-600 text-sm leading-relaxed">${review.comment}</p>
                </div>
            </div>
        </div>`;
    }

    timeAgo(date) {
        const d = Math.floor((new Date() - new Date(date)) / 86400000);
        if (d === 0)  return 'Today';
        if (d === 1)  return '1 day ago';
        if (d < 7)    return `${d} days ago`;
        if (d < 30)   return `${Math.floor(d/7)} weeks ago`;
        if (d < 365)  return `${Math.floor(d/30)} months ago`;
        return `${Math.floor(d/365)} years ago`;
    }

    showError(message) {
        this.loading.classList.add('hidden');
        document.getElementById('result_Product').innerHTML =
            `<div class="col-span-2 p-8 text-center text-red-500">${message}</div>`;
    }

    fadeIn() {
        const el = document.getElementById('result_Product');
        el.classList.add('opacity-0');
        setTimeout(() => {
            el.classList.remove('opacity-0');
            el.classList.add('opacity-100', 'transition-opacity', 'duration-500');
        }, 50);
    }

    setVal(id, value) { const el = document.getElementById(id); if (el) el.value = value; }
    setText(id, text) { const el = document.getElementById(id); if (el) el.textContent = text; }

    setupReviewFormListener() {
        const form = document.getElementById('reviewForm');
        if (form) form.addEventListener('submit', (e) => this.handleSubmitReview(e));
    }

    async handleSubmitReview(e) {
        e.preventDefault();

        const productId       = document.getElementById('product_id').value;
        const comment         = document.getElementById('review_input').value.trim();
        const btn             = e.target.querySelector('button[type="submit"]');
        const originalBtnHTML = btn.innerHTML;

        if (!comment) { showErrorPopup('Please write a review first'); return; }

        try {
            btn.disabled  = true;
            btn.innerHTML = this.spinnerHTML();

            const fd = new FormData();
            fd.append('comment', comment);

            const res  = await fetch(`/client/product/create-Review/${encodeURIComponent(productId)}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept':       'application/json'
                },
                body: fd
            });
            const data = await res.json();

            if (data.status === 'success') {
                document.getElementById('review_input').value = '';
                this.displayReviews(data.data);
                this.updateReviewForm(data.data); // ← hides wrapper immediately after posting
                showSuccessPopup('Review submitted successfully!');
            } else {
                throw new Error(data.message || 'Failed to submit review');
            }
        } catch (err) {
            showErrorPopup(err.message || 'Error submitting review. Please try again.');
        } finally {
            btn.disabled  = false;
            btn.innerHTML = originalBtnHTML;
        }
    }

    spinnerHTML() {
        return `<svg class="animate-spin h-5 w-5 mx-auto text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>`;
    }

    setupEscapeKey() {
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') this.close(); });
    }
}

// ================================================
// POPUP HELPERS
// ================================================
function showSuccessPopup(message) {
    const el = document.getElementById('successPopup');
    el.textContent = message;
    el.classList.remove('hidden'); el.classList.add('flex');
    setTimeout(() => { el.classList.add('hidden'); el.classList.remove('flex'); }, 3000);
}
function showErrorPopup(message) {
    const el = document.getElementById('errorPopup');
    el.textContent = message;
    el.classList.remove('hidden'); el.classList.add('flex');
    setTimeout(() => { el.classList.add('hidden'); el.classList.remove('flex'); }, 3000);
}

// ================================================
// QUANTITY CONTROLS
// ================================================
let quantityCheckTimer;
let currentStockMax = 999;

function validateQuantity(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
    if (input.disabled) { showErrorPopup('Product is out of stock'); return; }
    const value = parseInt(input.value) || 0;
    const min   = parseInt(input.getAttribute('min')) || 1;
    const max   = parseInt(input.getAttribute('max')) || currentStockMax;
    if (input.value !== '' && value < min)  { input.value = min; showSuccessPopup(`Minimum quantity is ${min}`); }
    else if (value > max)                   { input.value = max; showSuccessPopup(`Maximum available quantity is ${max}`); }
    else                                    { checkServerQuantity(value, input); }
}

function incrementQuantity(button) {
    const input = button.previousElementSibling;
    const value = parseInt(input.value) || 0;
    const max   = parseInt(input.getAttribute('max')) || currentStockMax;
    if (value < max) { input.value = value + 1; validateQuantity(input); }
    else showSuccessPopup(`Maximum available quantity is ${max}`);
}

function decrementQuantity(button) {
    const input = button.nextElementSibling;
    const value = parseInt(input.value) || 0;
    const min   = parseInt(input.getAttribute('min')) || 1;
    if (input.disabled) { showErrorPopup('Product is out of stock'); return; }
    if (value > min) { input.value = value - 1; validateQuantity(input); }
    else showSuccessPopup(`Minimum quantity is ${min}`);
}

async function checkServerQuantity(quantity, input) {
    clearTimeout(quantityCheckTimer);
    quantityCheckTimer = setTimeout(async () => {
        const productId = document.getElementById('modal_product_id').value;
        if (!productId) return;
        try {
            const res  = await fetch(`/client/product/Quantity/${encodeURIComponent(productId)}`, {
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' }
            });
            if (!res.ok) throw new Error();
            const data = await res.json();
            if (data.quantity !== undefined) {
                currentStockMax = parseInt(data.quantity);
                input.setAttribute('max', currentStockMax);
                if (quantity > currentStockMax) {
                    input.value = currentStockMax;
                    if (currentStockMax === 0) {
                        showErrorPopup('Product is now out of stock');
                        input.disabled = true;
                        document.getElementById('addToCartBtn').disabled = true;
                        document.getElementById('addToCartText').textContent = 'Out of Stock';
                    } else {
                        showSuccessPopup(`Only ${currentStockMax} unit(s) available`);
                    }
                }
            }
        } catch { console.error('Error checking quantity'); }
    }, 500);
}

// ================================================
// GLOBAL FUNCTIONS
// ================================================
let quickViewModal;

function openQuickViewModal(productId) {
    if (!quickViewModal) quickViewModal = new QuickViewModal();
    quickViewModal.open(productId);
}

function closeQuickViewModal() {
    if (quickViewModal) quickViewModal.close();
}

document.addEventListener('DOMContentLoaded', () => {
    quickViewModal = new QuickViewModal();
});
</script>
@endpush