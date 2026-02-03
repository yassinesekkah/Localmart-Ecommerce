<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <x-client.head />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased ">

    <x-client.navbar />
    <!-- Page Content -->
    <main class="overflow-hidden bg-slate-600">
        @yield('content')
        
    </main>
    <x-client.slider/>
    <x-client.categories/>
    <x-client.products/>
    <x-client.footer />
</body>

</html>