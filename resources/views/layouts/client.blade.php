<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-client.head />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
     
@livewireStyles
</head>

<body class="font-sans antialiased ">

    <x-client.navbar />
    <!-- Page Content -->
    <main class="overflow-hidden">
        @yield('content')

    </main>
    <x-client.footer :categories="$categories" />

    {{-- Toast messages --}}
    @if (session('success'))
    <div id="toast"
        class="fixed bottom-5 left-5 z-50 flex items-center gap-3
                bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg
                transform translate-y-6 opacity-0
                transition-all duration-500">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-sm font-medium">
            {{ session('success') }}
        </span>
    </div>
    @endif

    @if (session('error'))
    <div id="toast"
        class="fixed bottom-5 left-5 z-50 flex items-center gap-3
                bg-red-600 text-white px-4 py-3 rounded-lg shadow-lg
                transform translate-y-6 opacity-0
                transition-all duration-500">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span class="text-sm font-medium">
            {{ session('error') }}
        </span>
    </div>
    @endif



@livewireScripts
@stack('scripts')
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


        /*************************** add review and reviews ************************************ */
        document.getElementById('comment').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

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
                        console.log('ajouter corectly', data.data);

                    }
                })
                .catch(error => console.error('errore on this product', error));
        });
        
    </script>
    @stack('scripts')

</body>

</html>