@extends('layouts.client')
@props(['category', 'order'])

@section('content')
    <div class="max-w-2xl mx-auto py-20 text-center">

        <div class="bg-white p-8 rounded-xl shadow">
            <h1 class="text-3xl font-bold text-green-600 mb-4">
                Thank you for your order 🎉
            </h1>

            <p class="text-gray-700 mb-6">
                Your order has been placed successfully.
            </p>

            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                <p class="text-sm text-gray-600">Order ID</p>
                <p class="text-lg font-semibold">#{{ $order->id }}</p>
                <p class="text-sm text-gray-600 mt-2">
                    Status: <span class="font-medium">{{ $order->status }}</span>
                </p>
            </div>

            <div class="flex justify-center gap-4">
                {{-- <a href="{{ route('client.orders.index') }}"
                   class="px-6 py-3 bg-black text-white rounded-lg">
                    My Orders
                </a> --}}
                @if ($category)
                    <a href="{{ route('client.categorieProducts', $category->id) }}"
                        class="px-6 py-3 bg-gray-200 rounded-lg">
                        Continue shopping
                    </a>
                @else
                    <a href="{{ route('client.dashboard') }}"
                        class="px-6 py-3 bg-gray-200 rounded-lg">
                        Continue shopping
                    </a>
                @endif
            </div>
        </div>

    </div>
@endsection
