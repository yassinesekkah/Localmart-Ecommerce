<!-- Navbar -->
<header
  class="sticky top-0 z-40 h-16 bg-navbar border-b border-navbar-line flex items-center px-6 ml-64"
>
  <!-- Left side -->
  <div class="flex items-center gap-3">
    <!-- زر ديال sidebar (اختياري دابا) -->
    <button class="lg:hidden p-2 rounded-md hover:bg-muted-hover">
      <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <line x1="3" y1="6" x2="21" y2="6" />
        <line x1="3" y1="12" x2="21" y2="12" />
        <line x1="3" y1="18" x2="21" y2="18" />
      </svg>
    </button>

    <span class="text-sm text-muted-foreground hidden md:block">
      Dashboard
    </span>
  </div>

  <!-- Right side -->
  <div class="ml-auto flex items-center gap-2">
    <!-- Search -->
    <button
      class="size-9 flex items-center justify-center rounded-full hover:bg-muted-hover"
      title="Search"
    >
      <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8" />
        <path d="m21 21-4.3-4.3" />
      </svg>
    </button>

    <!-- Notifications -->
    <button
      class="size-9 flex items-center justify-center rounded-full hover:bg-muted-hover"
      title="Notifications"
    >
      <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
      </svg>
    </button>

    <!-- Avatar (بلا dropdown دابا) -->
    <img
      src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5"
      alt="User avatar"
      class="w-8 h-8 rounded-full object-cover border"
    />
  </div>
</header>
<!-- End Navbar -->
