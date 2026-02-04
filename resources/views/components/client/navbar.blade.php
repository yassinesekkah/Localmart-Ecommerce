@props(['categories'])
<header class="">
    <!-- navbar -->
    <div class="border-b">
    </div>
    <div class="pt-5">
        <div class="container">
            <div class="flex flex-wrap w-full items-center justify-between">
                <div class="lg:w-1/6 md:w-1/2 w-2/5">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="./assets/images/logo/freshcart-logo.svg" alt="TailwindCSS eCommerce HTML Template" />
                    </a>
                </div>
                <div class="lg:w-2/5 hidden lg:block">
                    <form action="#">
                        <div class="relative">
                            <label for="searchProducts" class="invisible hidden">Search</label>
                            <input
                                class="border border-gray-300 text-gray-900 rounded-lg focus:shadow-[0_0_0_.25rem_rgba(10,173,10,.25)] focus:ring-green-600 focus:ring-0 focus:border-green-600 block p-2 px-3 disabled:opacity-50 disabled:pointer-events-none w-full text-base"
                                type="search" placeholder="Search for products" id="searchProducts" />
                            <button class="absolute right-0 top-0 p-3" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="16"
                                    height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="lg:w-1/5 md:w-1/2 w-3/5">
                    <div class="flex gap-6 items-center justify-end relative">

                        <!-- Wishlist -->
                        <a href="#!" class="relative text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M19.5 12.572l-7.5 7.428-7.5-7.428a5 5 0 1 1 7.5-6.566 5 5 0 1 1 7.5 6.572" />
                            </svg>
                            <span
                                class="absolute -top-2 -right-2 h-5 w-5 rounded-full bg-green-600 text-white text-xs flex items-center justify-center">
                                5
                            </span>
                        </a>

                        <!-- User Dropdown -->
                        <div class="relative z-[9999]" x-data="{ open: false }">
                            @auth
                            <button
                                @click="open = !open"
                                @click.outside="open = false"
                                class="flex items-center gap-2 text-gray-700 hover:text-gray-900">
                                <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 7l5 5 5-5" />
                                </svg>
                            </button>

                            <div
                                x-show="open"
                                x-transition
                                class="absolute right-0 mt-2 w-44 bg-white border rounded shadow-lg">
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 hover:bg-gray-100">
                                    Profile
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                            @else
                            <a href="{{ route('login') }}" class="text-gray-600">Login</a>
                            @endauth
                        </div>

                        <!-- Cart -->
                        <button type="button" class="relative text-gray-700"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1-2.966 2.544h-6.852a3 3 0 0 1-2.965-2.544l-1.255-8.152A2 2 0 0 1 6.331 8z" />
                                <path d="M9 11V6a3 3 0 0 1 6 0v5" />
                            </svg>
                            <span
                                class="absolute -top-2 -right-2 h-5 w-5 rounded-full bg-green-600 text-white text-xs flex items-center justify-center">
                                0
                            </span>
                        </button>

                        <!-- Mobile Menu Button -->
                        <button class="lg:hidden" data-bs-toggle="offcanvas" data-bs-target="#navbar-default">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <nav
        class="navbar relative navbar-expand-lg lg:flex lg:flex-wrap items-center content-between text-black navbar-default">
        <div class="container max-w-7xl mx-auto w-full xl:px-4 lg:px-0">
            <div class="offcanvas offcanvas-left lg:visible" tabindex="-1" id="navbar-default">
                <div class="offcanvas-header pb-1">
                    <a href="{{'/'}}"><img src="https://localmart.com.pk/wp-content/uploads/2025/12/logo2.jpg"
                            alt="TailwindCSS eCommerce HTML Template" /></a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x text-gray-700" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="offcanvas-body lg:flex lg:items-center">
                    <div class="block lg:hidden mb-4">
                        <form action="#">
                            <div class="relative">
                                <label for="searhNavbar" class="invisible hidden">Search</label>
                                <input
                                    class="border border-gray-300 text-gray-900 rounded-lg focus:shadow-[0_0_0_.25rem_rgba(10,173,10,.25)] focus:ring-green-600 focus:ring-0 focus:border-green-600 block p-2 px-3 disabled:opacity-50 disabled:pointer-events-none w-full text-base"
                                    type="search" placeholder="Search for products" id="searhNavbar" />
                                <button class="absolute right-0 top-0 p-3" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="16"
                                        height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="block lg:hidden mb-4">
                        <a class="btn inline-flex items-center gap-x-2 bg-green-600 text-white border-green-600 disabled:opacity-50 disabled:pointer-events-none hover:text-white hover:bg-green-700 hover:border-green-700 active:bg-green-700 active:border-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 justify-center"
                            data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            <span class="mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-grid" width="16"
                                    height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                </svg>
                            </span>
                            All Categories
                        </a>
                        <div class="collapse mt-2" id="collapseExample">
                            <div class="card card-body">
                                <ul class="list-unstyled">
                                    <li><a class="dropdown-item" href="#!">Dairy, Bread & Eggs</a></li>
                                    <li><a class="dropdown-item" href="#!">Snacks & Munchies</a></li>
                                    <li><a class="dropdown-item" href="#!">Fruits & Vegetables</a></li>
                                    <li><a class="dropdown-item" href="#!">Cold Drinks & Juices</a></li>
                                    <li><a class="dropdown-item" href="#!">Breakfast & Instant Food</a></li>
                                    <li><a class="dropdown-item" href="#!">Bakery & Biscuits</a></li>
                                    <li><a class="dropdown-item" href="#!">Chicken, Meat & Fish</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown hidden lg:block">
                        <button
                            class="mr-4 btn inline-flex items-center gap-x-2 bg-green-600 text-white border-green-600 disabled:opacity-50 disabled:pointer-events-none hover:text-white hover:bg-green-700 hover:border-green-700 active:bg-green-700 active:border-green-700 focus:outline-none focus:ring-4 focus:ring-green-300"
                            type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-grid" width="16"
                                    height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                </svg>
                            </span>
                            All Categories
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#!">Dairy, Bread & Eggs</a></li>
                            <li><a class="dropdown-item" href="#!">Snacks & Munchies</a></li>
                            <li><a class="dropdown-item" href="#!">Fruits & Vegetables</a></li>
                            <li><a class="dropdown-item" href="#!">Cold Drinks & Juices</a></li>
                            <li><a class="dropdown-item" href="#!">Breakfast & Instant Food</a></li>
                            <li><a class="dropdown-item" href="#!">Bakery & Biscuits</a></li>
                            <li><a class="dropdown-item" href="#!">Chicken, Meat & Fish</a></li>
                        </ul>
                    </div>
                    <div>
                        <ul class="navbar-nav lg:flex gap-3 lg:items-center">
                            <li class="nav-item dropdown w-full lg:w-auto">
                                <a class="nav-link " href="/" role="button">Home</a>

                            </li>
                            <li class="nav-item dropdown w-full lg:w-auto">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">Catégorie</a>
                                <ul class="dropdown-menu">
                                    @foreach ($categories as $category)
                                    <li>
                                        <a class="dropdown-item" href="#!">
                                            {{$category->name}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    </div>
</header>