@extends('layouts.admin')

@section('content')
    <div class="pt-2 pb-8">

        <div class="max-w-3xl mx-auto space-y-6">

            {{-- Header --}}
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold">
                        Ship Order #{{ $order->id }}
                    </h1>
                    <p class="text-sm text-gray-500">
                        Review order details before shipping
                    </p>
                </div>

                <a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:underline">
                    ← Return to Orders
                </a>
            </div>

            {{-- Customer Info Card --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="font-semibold mb-3 text-gray-800">
                    Shipping Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Full Name</p>
                        <p class="font-medium">{{ $order->full_name }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Phone</p>
                        <p class="font-medium">{{ $order->phone }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Address</p>
                        <p class="font-medium">{{ $order->address }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">City</p>
                        <p class="font-medium">{{ $order->city }}</p>
                    </div>
                </div>
            </div>

            {{-- Products Card --}}
            <div class="bg-white rounded-2xl shadow overflow-hidden">

                <div class="p-6 border-b">
                    <h2 class="font-semibold text-gray-800">
                        Order Items
                    </h2>
                </div>

                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-left">
                        <tr>
                            <th class="p-4">Product</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Quantity</th>
                            <th class="p-4">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($order->items as $item)
                            <tr class="border-t">

                                {{-- Product Info --}}
                                <td class="p-4">
                                    <div class="flex items-center gap-4">

                                        {{-- Product Image --}}
                                        @if ($item->product && $item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                class="w-14 h-14 rounded-lg object-cover">
                                        @else
                                            <div class="w-14 h-14 bg-gray-200 rounded-lg"></div>
                                        @endif

                                        <div>
                                            <p class="font-medium">
                                                {{ $item->product->name ?? 'Product deleted' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                ID: {{ $item->product_id }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                {{-- Price --}}
                                <td class="p-4">
                                    {{ number_format($item->price, 2) }} DH
                                </td>

                                {{-- Quantity --}}
                                <td class="p-4 font-medium">
                                    {{ $item->quantity }}
                                </td>

                                {{-- Subtotal --}}
                                <td class="p-4 font-semibold">
                                    {{ number_format($item->price * $item->quantity, 2) }} DH
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                    {{-- Total --}}
                    <tfoot class="bg-gray-50 border-t">
                        <tr>
                            <td colspan="3" class="p-4 text-right font-semibold">
                                Total Paid
                            </td>
                            <td class="p-4 font-bold text-lg">
                                {{ number_format($order->total, 2) }} DH
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3">

                {{-- Return button --}}
                <a href="{{ route('orders.index') }}"
                    class="px-5 py-2 bg-gray-200 rounded-lg text-sm font-medium hover:bg-gray-300 transition">
                    Cancel
                </a>

                {{-- Confirm Shipping --}}
                <form method="POST" action="{{ route('seller.orders.ship', $order) }}">
                    @csrf
                    @method('PATCH')

                    <button
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                        Confirm Shipping
                    </button>
                </form>

            </div>

        </div>

    </div>
@endsection
