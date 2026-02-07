@props(['categories'])

@php
    $cart = session('cart', []);
    $cartCount = collect($cart)->sum('quantity');
@endphp
<!-- Header/Navbar -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <div class="flex items-center space-x-8">
                <a href="{{ url('/client') }}" class="text-2xl font-bold text-green-600">FreshCart</a>

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
                <a href="{{ route('client.cart.index') }}"
                    class="relative text-gray-700 hover:text-green-600 transition">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4
                            M7 13L5.4 5
                            M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17
                            m0 0a2 2 0 100 4 2 2 0 000-4
                            zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>

                    @if ($cartCount > 0)
                        <span
                            class="absolute -top-2 -right-2
                                    bg-green-600 text-white text-xs
                                    rounded-full w-5 h-5
                                    flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

            </div>
        </div>
    </div>
</header>
