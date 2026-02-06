<!-- Sidebar -->
<aside class="h-full w-64 bg-white border-r border-gray-200 flex flex-col shadow-md">

    <!-- Logo -->
    <div class="px-5 py-2 border-b border-gray-200">
        <a href="{{ route('admin.dashboard') }}" class="inline-block">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-semibold text-gray-900">LocalMart</h1>
                    <p class="text-[11px] text-gray-500">Admin Panel</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <div class="flex-1 overflow-y-auto px-3 py-5">
        <nav class="space-y-6">

            <!-- Main -->
            <div>
                <h3 class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2 px-2">
                    Main
                </h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                    {{ request()->routeIs('admin.dashboard')
                                        ? 'bg-blue-50 text-blue-700 border border-blue-200'
                                        : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Catalog -->
            <div>
                <h3 class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2 px-2">
                    Catalog
                </h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                    {{ request()->routeIs('admin.categories.*')
                                        ? 'bg-blue-50 text-blue-700 border border-blue-200'
                                        : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" />
                                <rect x="14" y="3" width="7" height="7" />
                                <rect x="3" y="14" width="7" height="7" />
                                <rect x="14" y="14" width="7" height="7" />
                            </svg>
                            <span>Categories</span>
                        </a>
                    </li>

                    {{-- Products --}}
                    <li>
                        <a href="{{ route('seller.products.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                        {{ request()->routeIs('seller.products.*')
                                            ? 'bg-blue-50 text-blue-700 border border-blue-200'
                                            : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M7 7h.01" />
                                <path d="M3 7l9-4 9 4-9 4-9-4Z" />
                                <path d="M3 17l9 4 9-4" />
                                <path d="M3 12l9 4 9-4" />
                            </svg>
                            <span>Products</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Orders -->
            <div>
                <h3 class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2 px-2">
                    Orders
                </h3>
                <ul class="space-y-1">
                    <li>
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                    {{ request()->routeIs('admin.orders.*')
                                        ? 'bg-blue-50 text-blue-700 border border-blue-200'
                                        : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="9" cy="21" r="1" />
                                <circle cx="20" cy="21" r="1" />
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                            </svg>
                            <span>Orders</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Users -->
            @role('admin')
                <div>
                    <h3 class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2 px-2">
                        Users
                    </h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.usres.role') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                    {{ request()->routeIs('admin.users.*')
                                        ? 'bg-blue-50 text-blue-700 border border-blue-200'
                                        : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197" />
                                </svg>
                                <span>Users</span>
                            </a>

                        </li>
                    </ul>
                </div>
            @endrole
        </nav>
    </div>

    <!-- User -->
    <div class="px-3 py-4 border-t border-gray-200">
        <div class="flex items-center gap-3 px-2">
            <div class="w-9 h-9 bg-gray-300 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>

            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-[11px] text-gray-500">
                    {{ auth()->user()->getRoleNames()->first() }}
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-md transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

</aside>
<!-- End Sidebar -->
