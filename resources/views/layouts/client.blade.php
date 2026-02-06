<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-client.head />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased ">

    <x-client.navbar />
    <!-- Page Content -->
    <main class="overflow-hidden">
        @yield('content')

    </main>
    <x-client.footer :categories="$categories" />
    
<!-- Libs JS -->
<script>
    function toggleDropdown(event) {
        event.stopPropagation();
        const menu = document.getElementById('dropdownMenu');
        const arrow = document.getElementById('dropdownArrow');
        
        if (menu.classList.contains('hidden')) {
            // Show dropdown
            menu.classList.remove('hidden');
            setTimeout(() => {
                menu.classList.remove('opacity-0', 'scale-95');
                menu.classList.add('opacity-100', 'scale-100');
            }, 10);
            arrow.style.transform = 'rotate(180deg)';
        } else {
            // Hide dropdown
            menu.classList.remove('opacity-100', 'scale-100');
            menu.classList.add('opacity-0', 'scale-95');
            arrow.style.transform = 'rotate(0deg)';
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 200);
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('dropdownMenu');
        const arrow = document.getElementById('dropdownArrow');
        
        if (menu && !menu.classList.contains('hidden')) {
            menu.classList.remove('opacity-100', 'scale-100');
            menu.classList.add('opacity-0', 'scale-95');
            arrow.style.transform = 'rotate(0deg)';
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 200);
        }
    });

        function toggleCategoryDropdown(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('categoryDropdown');
        const arrow = document.getElementById('categoryArrow');
        
        if (dropdown.classList.contains('hidden')) {
            // Show dropdown
            dropdown.classList.remove('hidden');
            setTimeout(() => {
                dropdown.classList.remove('opacity-0', 'scale-95');
                dropdown.classList.add('opacity-100', 'scale-100');
            }, 10);
            arrow.style.transform = 'rotate(180deg)';
        } else {
            // Hide dropdown
            dropdown.classList.remove('opacity-100', 'scale-100');
            dropdown.classList.add('opacity-0', 'scale-95');
            arrow.style.transform = 'rotate(0deg)';
            setTimeout(() => {
                dropdown.classList.add('hidden');
            }, 200);
        }
    }

    // Close category dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('categoryDropdown');
        const arrow = document.getElementById('categoryArrow');
        
        if (dropdown && !dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('opacity-100', 'scale-100');
            dropdown.classList.add('opacity-0', 'scale-95');
            arrow.style.transform = 'rotate(0deg)';
            setTimeout(() => {
                dropdown.classList.add('hidden');
            }, 200);
        }
    });


    // Mobile menu toggle
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }

    document.getElementById('copyright').textContent = new Date().getFullYear();

        document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.productsSwiper', {
            // Responsive breakpoints
            slidesPerView: 1,
            spaceBetween: 16,
            breakpoints: {
                // when window width is >= 640px
                640: {
                    slidesPerView: 2,
                    spaceBetween: 16
                },
                // when window width is >= 1024px
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 16
                },
                // when window width is >= 1280px
                1280: {
                    slidesPerView: 5,
                    spaceBetween: 16
                }
            },
            
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            
            // Pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            
            // Auto height for slides
            autoHeight: false,
            
            // Loop mode
            loop: false,
            
            // Grab cursor
            grabCursor: true,
            
            // Keyboard control
            keyboard: {
                enabled: true,
            },
        });
    });
    function openQuickViewModal() {
    const modal = document.getElementById('quickViewModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
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

function openQuickViewModal(productId) {
    const modal = document.getElementById('quickViewModal');
    const loading = document.getElementById('modalLoading');
    
    // Open modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
    
    // Show loading spinner
    loading.classList.remove('hidden');
    
    // Fetch product data
    fetch(`/product/${encodeURIComponent(productId)}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(product => {
        // Hide loading spinner
        loading.classList.add('hidden');
        
        if (!product || product.length === 0) {
            document.getElementById('result_Product').innerHTML = '<div class="col-span-2 p-8 text-center text-gray-500">Product not found</div>';
            return;
        }
        
        // If product is an array, get first item
        const productData = Array.isArray(product) ? product[0] : product;
        
        // Update modal content with product data
        document.getElementById('productName').textContent = productData.name || 'Product Name';
        document.getElementById('productCategory').textContent = productData.category?.name || 'Category';
        document.getElementById('productCategoryLink').textContent = productData.category?.name || 'Category';
        document.getElementById('productPrice').textContent = `${productData.price || '0'} MAD`;
        document.getElementById('productDescription').textContent = productData.description || 'No description available';
        document.getElementById('productSKU').textContent = productData.sku || `PRD-${productData.id}`;
        document.getElementById('productBrand').textContent = productData.brand || 'Unknown';
        
        // Update old price if exists
        if (productData.old_price && productData.old_price > productData.price) {
            document.getElementById('productOldPrice').textContent = `${productData.old_price} MAD`;
            document.getElementById('productOldPrice').classList.remove('hidden');
            
            // Calculate discount
            const discount = Math.round(((productData.old_price - productData.price) / productData.old_price) * 100);
            document.getElementById('productDiscount').textContent = `${discount}% Off`;
            document.getElementById('productDiscount').classList.remove('hidden');
        } else {
            document.getElementById('productOldPrice').classList.add('hidden');
            document.getElementById('productDiscount').classList.add('hidden');
        }
        
        // Update product image if available
        if (productData.image) {
            document.getElementById('productMainImage').src = productData.image;
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
        document.getElementById('result_Product').innerHTML = '<div class="col-span-2 p-8 text-center text-red-500">Error loading product. Please try again.</div>';
    });
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
</script>
</body>

</html>