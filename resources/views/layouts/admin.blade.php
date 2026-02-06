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
        <div :class="{'hidden': !open, 'block': open}" class="bg-gray-800 text-white w-64 h-screen p-4 lg:block lg:static"
        > <x-admin.sidebar/></div>
       

        {{-- Main --}}
        <div class="flex-1 flex flex-col">

            {{-- Navbar --}}
            <x-admin.navbar/>

            {{-- Page Content --}}
            <main class="sm:pl-auto lg:pl-64 pt-3">
                @yield('content')
            </main>

        </div>
    </div>
</body>

</html>
