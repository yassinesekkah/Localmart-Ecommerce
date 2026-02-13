@props(['categories'])


<!-- Header/Navbar -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <div class="flex items-center space-x-8">
                <a href="{{ url('/client') }}" class="text-2xl font-bold text-green-600">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="LocalMart" class="h-10">
                </a>

                <!-- Navigation -->
                <nav class="hidden lg:flex space-x-6 items-center">
                    <a href="{{ url('/client') }}" class="text-gray-700 hover:text-green-600 transition">Home</a>

                    <!-- Category Dropdown -->
                    <div class="relative">
                        <button onclick="toggleCategoryDropdown(event)"
                            class="flex items-center gap-1 text-gray-700 hover:text-green-600 transition">
                            Catégorie
                            <svg class="w-4 h-4 transition-transform duration-200" id="categoryArrow"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 7l5 5 5-5" />
                            </svg>
                        </button>

                        <ul id="categoryDropdown"
                            class="hidden absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 transform scale-95 transition-all duration-200 max-h-64 overflow-y-auto">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('client.categorieProducts', $category->id) }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-600 transition">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- New Order Link -->
                    <a href="{{ route('client.orders.index') }}"
                        class="text-gray-700 hover:text-green-600 transition">
                        Order
                    </a>
                </nav>
            </div>

            <!-- Icons -->
            <div class="flex items-center space-x-4">
                <!-- User Account -->
                <div class="relative z-[9999]">
                    @auth
                        <button onclick="toggleDropdown(event)"
                            class="flex items-center gap-2 text-gray-700 hover:text-gray-900">
                            <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" id="dropdownArrow" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path d="M5 7l5 5 5-5" />
                            </svg>
                        </button>

                        <div id="dropdownMenu"
                            class="hidden absolute right-0 mt-2 w-44 bg-white border rounded shadow-lg opacity-0 transform scale-95 transition-all duration-200">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">
                                Profile
                            </a>
                            <a href="{{ route('client.favorite') }}" class="block px-4 py-2 hover:bg-gray-100">
                                My favorites
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600">Login</a>
                    @endauth
                </div>

                <!-- Shopping icon -->
                <a href="{{ route('client.cart.index') }}">
                    
                    <livewire:cart-counter />
                </a>
            </div>
        </div>
    </div>
</header>
