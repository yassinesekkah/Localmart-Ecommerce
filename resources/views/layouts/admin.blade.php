<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LocalMart Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black-400">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <x-admin.sidebar/>

        {{-- Main --}}
        <div class="flex-1 flex flex-col">

            {{-- Navbar --}}
            <x-admin.navbar/>

            {{-- Page Content --}}
            <main class="flex-1 pl-64 pt-3">
                @yield('content')
            </main>

        </div>
    </div>
</body>

</html>
