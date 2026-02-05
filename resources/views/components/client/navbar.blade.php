@props(['categories'])
<!-- Header/Navbar -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <div class="flex items-center space-x-8">
                <a href="{{url('/') }}" class="text-2xl font-bold text-green-600">FreshCart</a>

                <!-- Navigation -->
                <nav class="hidden lg:flex space-x-6 items-center">
                    <a href="{{url('/') }}" class="text-gray-700 hover:text-green-600 transition">Home</a>
                    <a href="#" class="text-gray-700 hover:text-green-600 transition">Shop</a>
                    <a href="{{url('/profile')}}" class="text-gray-700 hover:text-green-600 transition">Account</a>

                    <!-- Category Dropdown -->
                    <div class="relative">
                        <button
                            onclick="toggleCategoryDropdown(event)"
                            class="flex items-center gap-1 text-gray-700 hover:text-green-600 transition">
                            Catégorie
                            <svg class="w-4 h-4 transition-transform duration-200" id="categoryArrow" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 7l5 5 5-5" />
                            </svg>
                        </button>

                        <ul
                            id="categoryDropdown"
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
                </nav>
            </div>

            <!-- Search Bar -->
            <div class="hidden md:flex flex-1 max-w-lg mx-8">
                <input type="text" placeholder="Search for products..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Icons -->
            <div class="flex items-center space-x-4">
                <!-- Wishlist -->
                <button class="text-gray-700 hover:text-green-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>

                <!-- User Account -->
                <div class="relative z-[9999]">
                    @auth
                    <button
                        onclick="toggleDropdown(event)"
                        class="flex items-center gap-2 text-gray-700 hover:text-gray-900">
                        <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 transition-transform duration-200" id="dropdownArrow" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 7l5 5 5-5" />
                        </svg>
                    </button>

                    <div
                        id="dropdownMenu"
                        class="hidden absolute right-0 mt-2 w-44 bg-white border rounded shadow-lg opacity-0 transform scale-95 transition-all duration-200">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 hover:bg-gray-100">
                            Profile
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

                <!-- Shopping Cart -->
                <button class="relative text-gray-700 hover:text-green-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-green-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">2</span>
                </button>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden text-gray-700 hover:text-green-600" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden pb-4">
            <nav class="flex flex-col space-y-2">
                <a href="#" class="text-gray-700 hover:text-green-600 py-2 px-4 rounded hover:bg-gray-50 transition">Home</a>
                <a href="#" class="text-gray-700 hover:text-green-600 py-2 px-4 rounded hover:bg-gray-50 transition">Shop</a>
                <a href="#" class="text-gray-700 hover:text-green-600 py-2 px-4 rounded hover:bg-gray-50 transition">Stores</a>
                <a href="#" class="text-gray-700 hover:text-green-600 py-2 px-4 rounded hover:bg-gray-50 transition">Pages</a>
                <a href="#" class="text-gray-700 hover:text-green-600 py-2 px-4 rounded hover:bg-gray-50 transition">Account</a>
            </nav>

            <!-- Mobile Search -->
            <div class="mt-4">
                <input type="text" placeholder="Search for products..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
        </div>
    </div>
</header>