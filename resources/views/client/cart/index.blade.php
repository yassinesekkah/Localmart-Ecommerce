@extends('layouts.client')

@section('content')

    <div class="max-w-5xl mx-auto p-6">

        <h1 class="text-2xl font-semibold text-gray-800 mb-6">
            Your Cart
        </h1>

        @if (count($cart) === 0)
            <div class="bg-white p-6 rounded-xl border text-center text-gray-500">
                Your cart is empty.
            </div>
        @else
            <div class="bg-white rounded-xl border overflow-hidden">

                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">Product</th>
                            <th class="px-4 py-3 text-center">Price</th>
                            <th class="px-4 py-3 text-center">Quantity</th>
                            <th class="px-4 py-3 text-center">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach ($cart as $item)
                            <tr>
                                <td class="px-4 py-3 flex items-center gap-3">
                                    <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('assets/images/placeholder.png') }}"
                                        class="w-14 h-14 object-cover rounded">

                                    <span class="font-medium text-gray-800">
                                        {{ $item['name'] }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ number_format($item['price'], 2) }} MAD
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ $item['quantity'] }}
                                </td>

                                <td class="px-4 py-3 text-center font-medium">
                                    {{ number_format($item['price'] * $item['quantity'], 2) }} MAD
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <form action="{{ route('client.cart.remove', $item['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-800 text-sm font-medium"
                                                    onclick="return confirm('Remove this product from cart?')">
                                            Remove
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            {{-- Total --}}
            <div class="flex justify-end mt-6">
                <div class="bg-white border rounded-xl p-4 w-64">
                    <div class="flex justify-between text-sm mb-2">
                        <span>Total</span>
                        <span class="font-semibold">
                            {{ number_format($total, 2) }} MAD
                        </span>
                    </div>

                    <button
                        class="w-full mt-3 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Checkout
                    </button>
                </div>
            </div>
        @endif

    </div>

@endsection
