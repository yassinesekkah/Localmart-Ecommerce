<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Local Mart') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="h-screen w-screen overflow-hidden">

    <div class="flex h-full">

        <!-- Left side: Image -->
<div class="w-1/2 relative h-screen flex items-center justify-center">
    
    <img src="{{ asset('assets/images/auth/auth.png') }}" 
         alt="Background"
         class="w-45  object-cover object-center">

</div>


        <!-- Right side: Form -->
        <div class="w-1/2 bg-[#235338] flex items-center justify-center">
            
                {{ $slot }}
            
        </div>

    </div>

</body>

</html>
