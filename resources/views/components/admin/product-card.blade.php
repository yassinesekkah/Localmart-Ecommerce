@props(['product', 'role'])


<div class="bg-white rounded-lg border border-gray-200 shadow-sm
           hover:shadow-md transition overflow-hidden">

    <div class="flex flex-col bg-neutral-primary-soft p-3">
        <button type="button"
            onclick="openModal({{ $product->id }})"
            class="product-btn text-left focus:outline-none">
            <!-- Image -->
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/category/category-1.jpg') }}"
                alt="{{ $product->name }}" class="w-full h-32 object-cover rounded-md mb-2" />

            <!-- Content -->
            <div class="flex flex-col flex-1">

                <!-- Category -->
                <span
                    class="inline-block w-fit mb-1 px-2 py-0.5 text-xs font-medium
                       text-indigo-700 bg-indigo-50 rounded">
                    {{ $product->category->name }}
                </span>

                <!-- Title -->
                <h5 class="text-sm font-semibold text-gray-800 mb-1 truncate">
                    {{ $product->name }}
                </h5>

                <!-- Description -->
                <p class="text-xs text-gray-500 mb-2 line-clamp-2">
                    {{ $product->description }}
                </p>

                <!-- Price -->
                <div class="mb-2">
                    <span class="text-base font-bold text-indigo-600">
                        {{ number_format($product->price, 2) }} MAD
                    </span>
                </div>
            </div>
        </button>
        <!-- Actions -->
        <div class="flex gap-2 mt-auto">
            @if($role === 'seller')
            {{-- Edit --}}
            <a href="{{ route('seller.products.edit', $product) }}"
                class="flex-1 text-xs font-medium text-white
                            bg-emerald-600 hover:bg-emerald-500
                            rounded px-2 py-1.5 transition text-center">
                Modifier
            </a>
            @endif
            {{-- Delete --}}
            <form action="{{ route('seller.products.destroy', $product) }}" method="POST" class="flex-1"
                onsubmit="return confirm('Are you sure you want to delete this product?')">

                @csrf
                @method('DELETE')

                <button type="submit"
                    class="w-full text-xs font-medium text-white
                   bg-red-600 hover:bg-red-500
                   rounded px-2 py-1.5 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>


    <!-- Quick View Modal -->
    <div id="productModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal()"></div>

        <!-- Modal Content -->
        <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden max-w-4xl w-full transform transition-all max-h-[90vh] flex flex-col">

            <!-- Loading Spinner -->
            <div id="modalLoading" class="absolute inset-0 bg-white/90 flex items-center justify-center z-30 hidden">
                <div class="flex flex-col items-center">
                    <svg class="animate-spin h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="mt-4 text-gray-600">Loading...</p>
                </div>
            </div>

            <!-- Close Button -->
            <button onclick="closeModal()" class="absolute top-4 right-4 z-30 bg-white/90 hover:bg-white rounded-full p-2 shadow-lg transition-all duration-200 hover:scale-110">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="grid md:grid-cols-2 gap-0 overflow-hidden">
                <!-- Left Column - Image Section -->
                <div class="relative">
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br opacity-20 z-10"></div>

                    <!-- Product Image -->
                    <img id="modalProductImage"
                        src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/category/category-1.jpg') }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover object-center relative z-0 min-h-[500px]">

                    <!-- Product Info Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 z-20">
                        <h2 id="modalProductName" class="text-2xl font-bold text-white mb-2">{{ $product->name }}</h2>
                        <span id="modalProductCategory" class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $product->category->name }}
                        </span>
                    </div>
                </div>

                <!-- Right Column - Scrollable Content -->
                <div class="flex flex-col overflow-hidden overflow-y-auto">
                    <!-- Product Details (Fixed at top) -->
                    <div class="p-2 border-b border-gray-200">

                        <!-- Price -->
                        <div class="flex items-baseline gap-2 mb-4 text-md font-bold ">
                            <span>Price:</span>
                            <span id="modalProductPrice" class="bg-gradient-to-r from-green-700 to-green-600 bg-clip-text text-transparent">
                                {{ number_format($product->price, 2) }} MAD
                            </span>
                        </div>
                        <!-- Quantity -->
                        <div class="flex items-baseline gap-2 mb-4 text-md font-bold ">
                            <span>Quantity:</span>
                            <span id="modalProductPrice" class="bg-gradient-to-r from-green-700 to-green-600 bg-clip-text text-transparent">
                                {{ $product->quantity }}
                            </span>
                        </div>
                        <!-- descritopn -->
                        <div class="flex items-baseline gap-2 mb-4 text-md font-bold ">
                            <span>description:</span>
                            <span id="modalProductPrice" class="bg-gradient-to-r from-gray-700 text-[12px] to-gray-600 bg-clip-text text-transparent">
                                {{ $product->description }}
                            </span>
                        </div>
                    </div>

                    <!-- Reviews Section (Scrollable) -->
                    <div class="flex-1 p-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 sticky top-0 bg-white pb-2">
                            Customer Reviews
                        </h3>

                        <!-- Reviews List -->
                        <div id="reviewsList" class="space-y-4">
                            <p class="text-gray-500 text-center py-8">Loading reviews...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    #productModal.flex .bg-white {
        animation: fadeIn 0.3s ease-out;
    }

    /* Custom scrollbar */
    #reviewsList::-webkit-scrollbar {
        width: 6px;
    }

    #reviewsList::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    #reviewsList::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    #reviewsList::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endpush

<script>
    let currentProductId = null;

    function openModal(productId) {
        currentProductId = productId;
        const modal = document.getElementById('productModal');
        const loading = document.getElementById('modalLoading');

        // Open modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        // Show loading
        loading.classList.remove('hidden');

        // Fetch product with reviews
        fetchProductReviews(productId);
    }

    function closeModal() {
        const modal = document.getElementById('productModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
        currentProductId = null;
    }

    function fetchProductReviews(productId) {
        const loading = document.getElementById('modalLoading');

        fetch(`{{ route('ShowReview', ':id') }}`.replace(':id', productId), {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.message || 'Failed to load product');
                }
                return data;
            })
            .then(result => {
                loading.classList.add('hidden');

                if (result.status === 'success' && result.data) {
                    const product = result.data;

                    // Update product details
                    if (product.name) {
                        document.getElementById('modalProductName').textContent = product.name;
                    }
                    if (product.price) {
                        document.getElementById('modalProductPrice').textContent = `${parseFloat(product.price).toFixed(2)} MAD`;
                    }
                    if (product.category?.name) {
                        document.getElementById('modalProductCategory').textContent = product.category.name;
                    }
                    if (product.image) {
                        document.getElementById('modalProductImage').src = `/storage/${product.image}`;
                    }

                    // Display reviews
                    displayReviews(product.reviews || []);
                } else {
                    throw new Error('Invalid response format');
                }
            })
            .catch(error => {
                console.error('Error fetching product:', error);
                loading.classList.add('hidden');

                document.getElementById('reviewsList').innerHTML = `
                <div class="text-center py-8">
                    <div class="text-red-500 mb-2">Error loading product</div>
                    <div class="text-gray-500 text-sm">${error.message || 'Please try again later'}</div>
                </div>
            `;
            });
    }

    function displayReviews(reviews) {
        const reviewsList = document.getElementById('reviewsList');

        if (!reviews || reviews.length === 0) {
            reviewsList.innerHTML = `
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <p class="text-gray-500">No reviews yet.</p>
                </div>
            `;
            return;
        }

        reviewsList.innerHTML = reviews.map(review => {
            const userName = review.user?.name || 'Anonymous';
            const initials = userName.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
            const timeAgo = getTimeAgo(review.created_at);
            const avatarColors = ['bg-blue-100 text-blue-600', 'bg-green-100 text-green-600', 'bg-purple-100 text-purple-600', 'bg-pink-100 text-pink-600'];
            const avatarColor = avatarColors[Math.floor(Math.random() * avatarColors.length)];

            return `
                <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 ${avatarColor} rounded-full flex items-center justify-center font-semibold flex-shrink-0">
                            ${initials}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-semibold text-gray-900 text-sm">${userName}</h4>
                                <span class="text-xs text-gray-500">${timeAgo}</span>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">${review.comment || 'No comment provided'}</p>
                            
                            <!-- Review Actions -->
                            
                        @if($role === 'moderator')
                            <div class="flex justify-end items-end gap-4 mt-3">
                                <a href="/admin/review/${review.id}/Delete"
                                class="text-md text-red-500 hover:text-lg hover:text-red-700 transition-all">
                                    Delete
                                </a>
                            </div>
                        @endif
                        </div>
                    </div>
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
        if (diffInDays < 30) return `${Math.floor(diffInDays / 7)} week${Math.floor(diffInDays / 7) > 1 ? 's' : ''} ago`;
        if (diffInDays < 365) return `${Math.floor(diffInDays / 30)} month${Math.floor(diffInDays / 30) > 1 ? 's' : ''} ago`;
        return `${Math.floor(diffInDays / 365)} year${Math.floor(diffInDays / 365) > 1 ? 's' : ''} ago`;
    }

    // Close on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
</script>