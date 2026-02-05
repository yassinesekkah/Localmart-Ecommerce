@extends('layouts.admin')

@section('content')
    <div class="p-4 sm:p-6 space-y-6">

        {{-- Page title --}}
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
            <p class="text-sm text-gray-500 mt-1">
                Overview of your application
            </p>
        </div>

        {{-- Stats cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- Users --}}
            @if ($role === 'admin')
                <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <p class="text-xs uppercase text-gray-400">Total Users</p>
                    <h3 class="mt-2 text-2xl font-semibold text-gray-800">
                        {{ $usersCount }}
                    </h3>
                </div>
            @endif
            
                {{-- Products --}}
                <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <p class="text-xs uppercase text-gray-400">Products</p>
                    <h3 class="mt-2 text-2xl font-semibold text-gray-800">
                        {{ $productsCount }}
                    </h3>
                </div>

                {{-- Orders --}}
                <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <p class="text-xs uppercase text-gray-400">Orders</p>
                    <h3 class="mt-2 text-2xl font-semibold text-gray-800">
                        --
                    </h3>
                </div>

                {{-- Revenue --}}
                <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <p class="text-xs uppercase text-gray-400">Revenue</p>
                    <h3 class="mt-2 text-2xl font-semibold text-gray-800">
                        --
                    </h3>
                </div>
           

        </div>

        {{-- Content grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Left block --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-sm font-medium text-gray-700 mb-4">
                    Activity
                </h2>

                <div class="h-56 flex items-center justify-center text-sm text-gray-400">
                    Activity chart coming soon
                </div>
            </div>

            {{-- Right block --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-sm font-medium text-gray-700 mb-4">
                    Statistics
                </h2>

                <div class="h-56 flex items-center justify-center text-sm text-gray-400">
                    Statistics chart coming soon
                </div>
            </div>

        </div>

    </div>
@endsection
