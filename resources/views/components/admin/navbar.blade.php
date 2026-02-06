<!-- Navbar -->
<header
  class="sticky top-0 z-40 h-16 bg-white border-b border-gray-200 flex items-center px-6 lg:ml-64"
>
  <!-- Left side -->
  <div class="flex items-center gap-3">
    <!-- Menu mobile -->
    <button  @click="open =! open" class="lg:hidden p-2 rounded-md hover:bg-gray-100">
      <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <line x1="3" y1="6" x2="21" y2="6" />
        <line x1="3" y1="12" x2="21" y2="12" />
        <line x1="3" y1="18" x2="21" y2="18" />
      </svg>
    </button>

    <span class="text-sm text-gray-600 hidden md:block">
      Dashboard
    </span>
  </div>

  <!-- Right side -->
  <div class="ml-auto flex items-center gap-2">
    <!-- Notifications -->
    <button
      class="size-9 flex items-center justify-center rounded-full hover:bg-gray-100 relative"
      title="Notifications"
    >
      <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
      </svg>
      <!-- Notification badge -->
      <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
    </button>
  </div>
</header>
<!-- End Navbar -->
