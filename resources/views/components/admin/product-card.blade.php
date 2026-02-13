@props(['product', 'role'])

<div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition overflow-hidden">
    <div class="flex flex-col bg-neutral-primary-soft p-3">
        <button type="button" onclick="openModal({{ $product->id }})" class="product-btn text-left focus:outline-none">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/category/category-1.jpg') }}"
                alt="{{ $product->name }}" class="w-full h-32 object-cover rounded-md mb-2" />

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

        <div class="flex gap-2 mt-auto">
            @if($role === 'seller')
            <a href="{{ route('seller.products.edit', $product) }}"
                class="flex-1 text-xs font-medium text-white bg-emerald-600 hover:bg-emerald-500 rounded px-2 py-1.5 transition text-center">
                Modifier
            </a>

            <form id="delete-form-{{ $product->id }}" action="{{ route('seller.products.destroy', $product) }}" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="button"
                    onclick="openProductConfirmModal({{ $product->id }})"
                    class="w-full text-xs font-medium text-white bg-red-600 hover:bg-red-500 rounded px-2 py-1.5 transition">
                    Delete
                </button>
            </form>
            @endif
        </div>
    </div>
    <!-- Notification errors -->
    <div id="notification"
        class="fixed top-5 right-5 z-[100] hidden transform transition-all duration-300 translate-y-[-20px] opacity-0">
        <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-xl flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span id="notification-message">Message ici</span>
        </div>
    </div>

    <!-- conferm delete review Modal -->
    <div id="confirmModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeConfirmModal()"></div>
        <div class="relative bg-white rounded-xl shadow-2xl max-w-sm w-full p-6 transform transition-all scale-95 opacity-0 duration-200" id="confirmContent">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Confirmation</h3>
                <p class="text-sm text-gray-500 mt-2">Voulez-vous vraiment supprimer ce commentaire ? Cette action est irréversible.</p>
            </div>
            <div class="mt-6 flex gap-3">
                <button onclick="closeConfirmModal()" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium transition">Annuler</button>
                <button id="confirmDeleteBtn" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition shadow-sm">Supprimer</button>
            </div>
        </div>
    </div>

    <div id="productModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden max-w-4xl w-full transform transition-all max-h-[90vh] flex flex-col">

            <div id="modalLoading" class="absolute inset-0 bg-white/90 flex items-center justify-center z-30 hidden">
                <div class="flex flex-col items-center">
                    <svg class="animate-spin h-12 w-12 text-indigo-600" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            <button onclick="closeModal()" class="absolute top-4 right-4 z-40 bg-white/90 rounded-full p-2 shadow-lg hover:scale-110 transition-all">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="grid md:grid-cols-2 gap-0 overflow-hidden h-full">
                <div class="relative bg-gray-100">
                    <img id="modalProductImage" src="" alt="" class="w-full h-full object-cover min-h-[400px]">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 p-6">
                        <h2 id="modalProductName" class="text-2xl font-bold text-white mb-2"></h2>
                        <span id="modalProductCategory" class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full"></span>
                    </div>
                </div>

                <div class="flex flex-col h-full overflow-hidden bg-white">
                    <div class="p-6 border-b border-gray-100 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Prix:</span>
                            <span id="modalProductPrice" class="text-xl font-bold text-indigo-600"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Quantité:</span>
                            <span id="modalProductQuantity" class="font-semibold text-gray-800"></span>
                        </div>
                        <div>
                            <span class="text-gray-500 font-medium block mb-1">Description:</span>
                            <p id="modalProductDescription" class="text-sm text-gray-600 leading-relaxed"></p>
                        </div>
                    </div>

                    <div class="flex-1 overflow-y-auto p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 sticky top-0 bg-white z-10">Commentaires Clients</h3>
                        <div id="reviewsList" class="space-y-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentProductId = null;

    function openModal(productId) {
        currentProductId = productId;
        const modal = document.getElementById('productModal');
        modal.classList.replace('hidden', 'flex');
        document.body.style.overflow = 'hidden';
        fetchProductData(productId);
    }

    function closeModal() {
        const modal = document.getElementById('productModal');
        modal.classList.replace('flex', 'hidden');
        document.body.style.overflow = 'auto';
    }

    function fetchProductData(productId) {
        const loading = document.getElementById('modalLoading');
        loading.classList.remove('hidden');

        // استبدال :id يدوياً في JavaScript لتفادي مشاكل Blade
        let url = "{{ route('ShowReview', ':id') }}".replace(':id', productId);

        fetch(url, {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(result => {
                loading.classList.add('hidden');
                if (result.status === 'success') {
                    const p = result.data;
                    document.getElementById('modalProductName').textContent = p.name;
                    document.getElementById('modalProductPrice').textContent = `${parseFloat(p.price).toFixed(2)} MAD`;
                    document.getElementById('modalProductCategory').textContent = p.category?.name || 'N/A';
                    document.getElementById('modalProductQuantity').textContent = p.quantity;
                    document.getElementById('modalProductDescription').textContent = p.description;
                    document.getElementById('modalProductImage').src = p.image ? `/storage/${p.image}` : '/assets/images/category/category-1.jpg';

                    renderReviews(p.reviews || []);
                }
            })
            .catch(err => {
                loading.classList.add('hidden');
                showNotification("Fetch error:", err);
            });
    }

    function renderReviews(reviews) {
        const list = document.getElementById('reviewsList');
        if (!reviews.length) {
            list.innerHTML = '<div class="text-center py-6 text-gray-400">Aucun avis pour le moment.</div>';
            return;
        }

        list.innerHTML = reviews.map(review => {
            const userName = review.user?.name || 'Anonyme';
            const initials = userName.substring(0, 2).toUpperCase();

            return `
                <div id="review-item-${review.id}" class="bg-gray-50 rounded-xl p-4 border border-transparent hover:border-gray-200 transition">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xs font-bold shadow-sm">
                            ${initials}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center mb-1">
                                <h4 class="text-sm font-bold text-gray-800 truncate">${userName}</h4>
                                <span class="text-[10px] text-gray-400">${formatDate(review.created_at)}</span>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">${review.comment}</p>
                            
                            @if($role === 'moderator')
                                <div class="mt-3 flex justify-end border-t border-gray-200 pt-2">
                                    <button onclick="handleDeleteReview(${review.id})" 
                                        class="text-red-500 font-medium">
                                    Supprimer
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }

    /**
     * دالة واحدة جامعة وشاملة للمسح
     * كتحكم في فتح المودال، إرسال الطلب، الأنيميشن، والتنبيهات
     */
    async function handleDeleteReview(reviewId) {
        
        if (!reviewId) {
            showNotification("Erreur: back-end error", "error");
            return;
        }

        let reviewIdToDelete = reviewId;

        // 1. إظهار المودال (Confirm Modal)
        const modal = document.getElementById('confirmModal');
        const content = document.getElementById('confirmContent');

        modal.classList.replace('hidden', 'flex');
        setTimeout(() => {
            content.classList.replace('scale-95', 'scale-100');
            content.classList.replace('opacity-0', 'opacity-100');
        }, 10);

        // 2. ربط زر التأكيد بالعملية
        const deleteBtn = document.getElementById('confirmDeleteBtn');
        deleteBtn.onclick = async function() {

            closeConfirmModal(); // إغلاق المودال قبل البدء

            try {
                const url = `/moderator/review/${reviewIdToDelete}`;
                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (response.ok && result.status === 'success') {
                    const element = document.getElementById(`review-item-${reviewIdToDelete}`);
                    if (element) {
                        // أنيميشن المسح
                        element.style.transition = 'all 0.4s ease';
                        element.style.opacity = '0';
                        element.style.transform = 'translateX(20px)';
                        setTimeout(() => {
                            element.remove();
                            showNotification('Supprimé avec succès');
                        }, 400);
                    }
                } else {
                    showNotification(result.message || "Erreur lors de la suppression", "error");
                }
            } catch (error) {
                showNotification("Erreur réseau", "error");
            } finally {
                reviewIdToDelete = null;
            }
        };
    }

    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString('fr-FR', {
            day: 'numeric',
            month: 'short'
        });
    }

    function showNotification(message, type = 'success') {
        const notif = document.getElementById('notification');
        const msgSpan = document.getElementById('notification-message');

        msgSpan.textContent = message;

        notif.classList.remove('hidden');

        setTimeout(() => {
            notif.classList.add('translate-y-0', 'opacity-100');
            notif.classList.remove('translate-y-[-20px]', 'opacity-0');
        }, 10);

        setTimeout(() => {
            notif.classList.remove('translate-y-0', 'opacity-100');
            notif.classList.add('translate-y-[-20px]', 'opacity-0');
            setTimeout(() => notif.classList.add('hidden'), 300);
        }, 5000);
    }

    let reviewIdToDelete = null;

   
    function openConfirmModal(reviewId) {
        reviewIdToDelete = reviewId;
        const modal = document.getElementById('confirmModal');
        const content = document.getElementById('confirmContent');

        modal.classList.replace('hidden', 'flex');
        setTimeout(() => {
            content.classList.replace('scale-95', 'scale-100');
            content.classList.replace('opacity-0', 'opacity-100');
        }, 10);
    }

    // 2. هادي لإغلاق مودال التأكيد
    function closeConfirmModal() {
        const modal = document.getElementById('confirmModal');
        const content = document.getElementById('confirmContent');

        content.classList.replace('scale-100', 'scale-95');
        content.classList.replace('opacity-100', 'opacity-0');
        setTimeout(() => modal.classList.replace('flex', 'hidden'), 200);
        reviewIdToDelete = null;
    }



    document.addEventListener('keydown', (e) => e.key === 'Escape' && closeModal());
</script>