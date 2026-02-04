   <!-- Sidebar -->
   <aside class="fixed inset-y-0 left-0 w-80 bg-white border-r border-gray-200 flex flex-col shadow-lg">
       <!-- Logo -->
       <div class="px-6 pt-6 pb-4 border-b border-gray-200">
           <a href="{{ route('admin.categories.index') }}" class="inline-block">
               <div class="flex items-center space-x-3">
                   <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                       <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                       </svg>
                   </div>
                   <div>
                       <h1 class="text-xl font-bold text-gray-900">LocalMart</h1>
                       <p class="text-xs text-gray-500">Admin Panel</p>
                   </div>
               </div>
           </a>
       </div>

       <!-- Navigation -->
       <div class="flex-1 overflow-y-auto px-4 py-6">
           <nav>
               <div class="mb-6">
                   <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Main Menu</h3>
                   <ul class="space-y-1">
                       {{-- Dashboard --}}
                       <li>
                           <a href="{{ route('admin.dashboard') }}"
                              class="flex items-center gap-4 px-4 py-3 rounded-xl text-base font-medium
                                     text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200">
                               <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                   <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                   <polyline points="9 22 9 12 15 12 15 22" />
                               </svg>
                               <span>Dashboard</span>
                           </a>
                       </li>
                   </ul>
               </div>

               <div class="mb-6">
                   <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Catalog</h3>
                   <ul class="space-y-1">
                       {{-- Categories --}}
                       <li>
                           <a href="{{ route('admin.categories.index') }}"
                              class="flex items-center gap-4 px-4 py-3 rounded-xl text-base font-medium
                                     bg-blue-50 text-blue-700 border border-blue-200">
                               <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                   <rect x="3" y="3" width="7" height="7" />
                                   <rect x="14" y="3" width="7" height="7" />
                                   <rect x="3" y="14" width="7" height="7" />
                                   <rect x="14" y="14" width="7" height="7" />
                               </svg>
                               <span>Categories</span>
                               <span class="ml-auto bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">New</span>
                           </a>
                       </li>
                       {{-- Products --}}
                       <li>
                           <a href="#"
                              class="flex items-center gap-4 px-4 py-3 rounded-xl text-base font-medium
                                     text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200">
                               <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
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

               <div class="mb-6">
                   <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Orders</h3>
                   <ul class="space-y-1">
                       {{-- Orders --}}
                       <li>
                           <a href="#"
                              class="flex items-center gap-4 px-4 py-3 rounded-xl text-base font-medium
                                     text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200">
                               <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                   <circle cx="9" cy="21" r="1" />
                                   <circle cx="20" cy="21" r="1" />
                                   <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                               </svg>
                               <span>Orders</span>
                               <span class="ml-auto bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full">3</span>
                           </a>
                       </li>
                   </ul>
               </div>

               <div>
                   <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Users</h3>
                   <ul class="space-y-1">
                       {{-- Users --}}
                       <li>
                           <a href="#"
                              class="flex items-center gap-4 px-4 py-3 rounded-xl text-base font-medium
                                     text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200">
                               <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                   <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                               </svg>
                               <span>Users</span>
                           </a>
                       </li>
                   </ul>
               </div>
           </nav>
       </div>

       <!-- User Section -->
       <div class="px-4 py-4 border-t border-gray-200">
           <div class="flex items-center gap-3 px-2">
               <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                   <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                   </svg>
               </div>
               <div class="flex-1">
                   <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                   <p class="text-xs text-gray-500">Administrator</p>
               </div>
               <form method="POST" action="{{ route('logout') }}" class="inline" onsubmit="return confirm('Are you sure you want to logout?')">
                   @csrf
                   <button type="submit" 
                           class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200"
                           title="Logout">
                       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                       </svg>
                       <span>Logout</span>
                   </button>
               </form>
           </div>
       </div>
   </aside>
   <!-- End Sidebar -->
