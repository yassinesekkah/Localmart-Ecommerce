@props(['product', 'role'])

{{-- ============================================================
     PRODUCT CARD
     The modal + scripts are wrapped in @once so they render
     only ONE TIME even when this component is looped.
     openProductModal() is defined globally via window.
     ============================================================ --}}

<div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition overflow-hidden">
    <div class="flex flex-col bg-neutral-primary-soft p-3">

        {{-- Card button --}}
        <button type="button"
            onclick="openProductModal({{ $product->id }})"
            class="text-left focus:outline-none">

            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/category/category-1.jpg') }}"
                alt="{{ $product->name }}"
                class="w-full h-32 object-cover rounded-md mb-2" />

            <div class="flex flex-col flex-1">
                <span class="inline-block w-fit mb-1 px-2 py-0.5 text-xs font-medium text-indigo-700 bg-indigo-50 rounded">
                    {{ $product->category->name }}
                </span>
                <h5 class="text-sm font-semibold text-gray-800 mb-1 truncate">{{ $product->name }}</h5>
                <p class="text-xs text-gray-500 mb-2 line-clamp-2">{{ $product->description }}</p>
                <div class="mb-2">
                    <span class="text-base font-bold text-indigo-600">{{ number_format($product->price, 2) }} MAD</span>
                </div>
            </div>
        </button>

        {{-- Actions --}}
        <div class="flex gap-2 mt-auto">
            @if($role === 'seller')
            <a href="{{ route('seller.products.edit', $product) }}"
                class="flex-1 text-xs font-medium text-white bg-emerald-600 hover:bg-emerald-500 rounded px-2 py-1.5 transition text-center">
                Modifier
            </a>
            @endif

            <form action="{{ route('seller.products.destroy', $product) }}" method="POST" class="flex-1"
                onsubmit="return confirm('Are you sure you want to delete this product?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full text-xs font-medium text-white bg-red-600 hover:bg-red-500 rounded px-2 py-1.5 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================
     @once — everything below renders exactly ONE time
     no matter how many cards are on the page
     ============================================================ --}}
@once

{{-- ── MODAL HTML ──────────────────────────────────────────── --}}
<div id="productModal"
    style="display:none;"
    class="fixed inset-0 z-50 items-center justify-center p-4">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
        onclick="closeProductModal()"></div>

    {{-- Box --}}
    <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden max-w-4xl w-full max-h-[90vh] flex flex-col">

        {{-- Spinner --}}
        <div id="modalLoading"
            style="display:none;"
            class="absolute inset-0 bg-white/90 flex items-center justify-center z-30">
            <div class="flex flex-col items-center">
                <svg class="animate-spin h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="mt-3 text-gray-500 text-sm">Loading...</p>
            </div>
        </div>

        {{-- Close --}}
        <button onclick="closeProductModal()"
            class="absolute top-4 right-4 z-30 bg-white/90 hover:bg-white rounded-full p-2 shadow-lg transition hover:scale-110">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="grid md:grid-cols-2 overflow-hidden flex-1 min-h-0">

            {{-- ── Left: image + overlay ── --}}
            <div class="relative flex-shrink-0">
                <img id="modalProductImage" src="" alt=""
                    class="w-full h-full object-cover object-center min-h-[400px]">

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                <div class="absolute bottom-0 left-0 right-0 p-6 z-10">
                    <h2 id="modalProductName" class="text-2xl font-bold text-white mb-1"></h2>
                    <span id="modalProductCategory"
                        class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full mb-3">
                    </span>
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-1 text-white/90 text-xs">
                            <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                            <span id="modalLikesCount"></span>
                        </div>
                        <div class="flex items-center gap-1">
                            <div id="modalAvgStars" class="flex gap-0.5"></div>
                            <span id="modalAvgRating" class="text-white/80 text-xs ml-1"></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Right: details + reviews ── --}}
            <div class="flex flex-col overflow-y-auto">

                {{-- Details --}}
                <div class="p-5 border-b border-gray-100 space-y-3">

                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-500 w-24">Price</span>
                        <span id="modalProductPrice" class="text-lg font-bold text-green-700"></span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-500 w-24">Stock</span>
                        <div class="flex items-center gap-2">
                            <span id="modalStockBadge"
                                class="px-2.5 py-0.5 rounded-full text-xs font-bold text-white">
                            </span>
                            <span id="modalStockQty" class="text-sm font-medium"></span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-500 w-24">Favorites</span>
                        <span id="modalFavoritesCount" class="text-sm text-indigo-600 font-semibold"></span>
                    </div>

                    <div class="pt-1">
                        <span class="text-sm font-semibold text-gray-500">Description</span>
                        <p id="modalProductDescription" class="text-gray-500 text-xs mt-1 leading-relaxed"></p>
                    </div>
                </div>

                {{-- Reviews --}}
                <div class="flex-1 p-4 pb-6">
                    <h3 class="text-base font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">
                        Customer Reviews
                    </h3>
                    <div id="reviewsList" class="space-y-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── STYLES (once) ────────────────────────────────────────── --}}
<style>
    @keyframes modalFadeIn {
        from { opacity: 0; transform: scale(0.96); }
        to   { opacity: 1; transform: scale(1); }
    }
    #productModal > div:last-child { animation: modalFadeIn 0.25s ease-out; }
    #reviewsList::-webkit-scrollbar       { width: 4px; }
    #reviewsList::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    #reviewsList::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
</style>

{{-- ── SCRIPTS (once) ──────────────────────────────────────── --}}
<script>
    // Role passed from Blade, available to all functions below
    const PRODUCT_MODAL_ROLE = @json($role);

    // ── Open ─────────────────────────────────────────────────
    function openProductModal(productId) {
        const modal   = document.getElementById('productModal');
        const loading = document.getElementById('modalLoading');

        // Use style.display so there's no Tailwind class conflict
        modal.style.display   = 'flex';
        loading.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        document.getElementById('reviewsList').innerHTML =
            '<p class="text-gray-400 text-center py-6 text-sm">Loading reviews...</p>';

        fetchProduct(productId);
    }

    // ── Close ────────────────────────────────────────────────
    function closeProductModal() {
        document.getElementById('productModal').style.display  = 'none';
        document.getElementById('modalLoading').style.display  = 'none';
        document.body.style.overflow = 'auto';
    }

    // ── Fetch from show() ─────────────────────────────────────
    function fetchProduct(productId) {
        const url = '{{ route('ShowReview', ':id') }}'.replace(':id', productId);

        fetch(url, { headers: { 'Accept': 'application/json' } })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw new Error(data.message || 'Request failed');
                return data;
            })
            .then(result => {
                document.getElementById('modalLoading').style.display = 'none';
                if (result.status === 'success' && result.data) {
                    populateModal(result.data);
                } else {
                    throw new Error('Invalid response format');
                }
            })
            .catch(err => {
                document.getElementById('modalLoading').style.display = 'none';
                document.getElementById('reviewsList').innerHTML = `
                    <div class="text-center py-8">
                        <p class="text-red-500 font-medium">Error loading product</p>
                        <p class="text-gray-400 text-xs mt-1">${err.message}</p>
                    </div>`;
            });
    }

    // ── Populate all fields ───────────────────────────────────
    function populateModal(p) {
        setText('modalProductName',        p.name              || '');
        setText('modalProductCategory',    p.category?.name    || 'Uncategorized');
        setText('modalProductPrice',       `${parseFloat(p.price || 0).toFixed(2)} MAD`);
        setText('modalProductDescription', p.description       || 'No description available.');

        const img = document.getElementById('modalProductImage');
        img.src   = p.image ? `/storage/${p.image}` : '{{ asset('assets/images/category/category-1.jpg') }}';
        img.alt   = p.name || 'Product';

        // Stock
        renderStockStatus(p.quantity ?? 0);

        // Likes
        const likesCount = Array.isArray(p.likes) ? p.likes.length : 0;
        setText('modalLikesCount', `${likesCount} Like${likesCount !== 1 ? 's' : ''}`);

        // Favorites + avg rating
        const favCount  = p.favorites_count         ?? 0;
        const avgRating = parseFloat(p.favorites_avg_rating ?? 0);
        setText('modalFavoritesCount', `${favCount} Favorite${favCount !== 1 ? 's' : ''}`);
        renderStars('modalAvgStars', avgRating);
        setText('modalAvgRating', avgRating > 0 ? `${avgRating.toFixed(1)} / 5` : 'No rating yet');

        // Reviews
        renderReviews(p.reviews || []);
    }

    // ── Stock badge ───────────────────────────────────────────
    function renderStockStatus(quantity) {
        const badge = document.getElementById('modalStockBadge');
        const qty   = document.getElementById('modalStockQty');

        qty.textContent = `${quantity} unit${quantity !== 1 ? 's' : ''} available`;

        if (quantity <= 0) {
            badge.textContent = 'Out of Stock';
            badge.className   = 'px-2.5 py-0.5 rounded-full text-xs font-bold text-white bg-red-500';
            qty.className     = 'text-sm text-red-500 font-medium';
        } else if (quantity <= 5) {
            badge.textContent = 'Low Stock';
            badge.className   = 'px-2.5 py-0.5 rounded-full text-xs font-bold text-white bg-orange-400';
            qty.className     = 'text-sm text-orange-500 font-medium';
        } else {
            badge.textContent = 'In Stock';
            badge.className   = 'px-2.5 py-0.5 rounded-full text-xs font-bold text-white bg-green-500';
            qty.className     = 'text-sm text-green-600 font-medium';
        }
    }

    // ── Stars ─────────────────────────────────────────────────
    function renderStars(elementId, rating) {
        const el = document.getElementById(elementId);
        if (!el) return;
        let html = '';
        for (let i = 1; i <= 5; i++) {
            const active = rating >= i - 0.25;
            html += `<svg class="w-3.5 h-3.5 ${active ? 'text-yellow-400' : 'text-white/30'}"
                fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462
                c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755
                1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539
                -1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461
                a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>`;
        }
        el.innerHTML = html;
    }

    // ── Reviews ───────────────────────────────────────────────
    function renderReviews(reviews) {
        const list = document.getElementById('reviewsList');

        if (!reviews.length) {
            list.innerHTML = `
                <div class="text-center py-8">
                    <svg class="w-14 h-14 mx-auto text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <p class="text-gray-400 text-sm">No reviews yet.</p>
                </div>`;
            return;
        }

        const colors = [
            'bg-blue-100 text-blue-700',
            'bg-green-100 text-green-700',
            'bg-purple-100 text-purple-700',
            'bg-pink-100 text-pink-700',
            'bg-yellow-100 text-yellow-700',
        ];

        list.innerHTML = reviews.map((review, i) => {
            const name     = review.user?.name || 'Anonymous';
            const initials = name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
            const timeAgo  = getTimeAgo(review.created_at);
            const color    = colors[i % colors.length];

            const deleteBtn = PRODUCT_MODAL_ROLE === 'moderator'
                ? `<div class="flex justify-end mt-2">
                       <a href="/admin/review/${review.id}/Delete"
                          onclick="return confirm('Delete this review?')"
                          class="text-xs text-red-500 hover:text-red-700 font-medium transition-colors">
                           Delete
                       </a>
                   </div>`
                : '';

            return `
            <div class="bg-gray-50 rounded-xl p-3 hover:bg-gray-100 transition border border-gray-100">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 ${color} rounded-full flex items-center justify-center font-semibold text-xs flex-shrink-0">
                        ${initials}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-semibold text-gray-800 text-sm">${name}</span>
                            <span class="text-[11px] text-gray-400">${timeAgo}</span>
                        </div>
                        <p class="text-gray-500 text-xs leading-relaxed">
                            ${review.comment || 'No comment provided'}
                        </p>
                        ${deleteBtn}
                    </div>
                </div>
            </div>`;
        }).join('');
    }

    // ── Helpers ───────────────────────────────────────────────
    function setText(id, value) {
        const el = document.getElementById(id);
        if (el) el.textContent = value;
    }

    function getTimeAgo(date) {
        const d = Math.floor((new Date() - new Date(date)) / 86400000);
        if (d === 0)  return 'Today';
        if (d === 1)  return '1 day ago';
        if (d < 7)    return `${d} days ago`;
        if (d < 30)   return `${Math.floor(d/7)} week${Math.floor(d/7) > 1 ? 's' : ''} ago`;
        if (d < 365)  return `${Math.floor(d/30)} month${Math.floor(d/30) > 1 ? 's' : ''} ago`;
        return `${Math.floor(d/365)} year${Math.floor(d/365) > 1 ? 's' : ''} ago`;
    }

    // Escape key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeProductModal();
    });
</script>
@endonce