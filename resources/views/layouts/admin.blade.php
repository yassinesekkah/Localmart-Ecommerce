<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LocalMart Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black-400">

    <div x-data="{ open: false}" class="flex min-h-screen">

        {{-- Sidebar --}}
        <div  :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="
            fixed inset-y-0  z-40
            w-64 bg-gray-800 text-white p-4
            transform transition-transform duration-300
            lg:static lg:translate-x-0 lg:z-auto
        "
        > <x-admin.sidebar/></div>
       

        {{-- Main --}}
        <div class="flex-1 flex flex-col">

            {{-- Navbar --}}
            <x-admin.navbar/>

            {{-- Page Content --}}
            <main class="sm:pl-auto pt-3">
                @yield('content')
            </main>

        </div>
    </div>
</body>

</html>
