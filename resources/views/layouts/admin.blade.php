<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LocalMart Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div x-data="{ open: false }" class="flex min-h-screen">

        <!-- Overlay on mobile -->
        <div x-show="open" @click="open = false" x-transition.opacity class="fixed inset-0 bg-black/50 z-30 lg:hidden">
        </div>

        <!-- Sidebar wrapper -->
        <div :class="open ? 'translate-x-0' : '-translate-x-full'"
            class="
        fixed top-0 left-0 z-40
        w-64 h-screen
        bg-white
        transform transition-transform duration-300
        lg:translate-x-0
    ">
            <x-admin.sidebar />
        </div>

        <!-- Main -->
        <div class="flex-1 flex flex-col lg:ml-64">

            <!-- Navbar -->
            <x-admin.navbar />

            <!-- Page Content -->
            <main class="p-4">
                @yield('content')
            </main>

        </div>

    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>


</html>
