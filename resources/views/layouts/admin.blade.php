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
            fixed inset-y-0 left-0 z-40
            w-64 bg-white
            transform transition-transform duration-300
            lg:static lg:translate-x-0 lg:z-auto
        ">
            <x-admin.sidebar />
        </div>

        <!-- Main -->
        <div class="flex-1 flex flex-col">

            <!-- Navbar -->
            <x-admin.navbar />

            <!-- Page Content -->
            <main class="p-4">
                @yield('content')
            </main>

        </div>

    </div>

</body>


</html>
