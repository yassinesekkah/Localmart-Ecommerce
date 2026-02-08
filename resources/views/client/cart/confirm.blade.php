@extends('layouts.client')

@section('content')
    <div class="max-w-6xl mx-auto py-10 grid grid-cols-1 md:grid-cols-2 gap-10">

        {{-- Shipping Info --}}
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>

            <div class="space-y-2 text-sm">
                <p><strong>Name: </strong> {{ $checkoutInfo['full_name'] }} </p>
                <p><strong>Phone: </strong>{{ $checkoutInfo['phone'] }} </p>
                <p><strong>Address: </strong>{{ $checkoutInfo['address'] }}</p>
                <p><strong>City: </strong>{{ $checkoutInfo['city'] }}</p>
            </div>

            <a href="{{ route('client.checkout.info') }}" class="inline-block mt-4 text-sm text-blue-600 hover:underline">
                Edit information
            </a>
        </div>

        {{-- Cart Summary --}}
        <div class="bg-gray-50 p-6 rounded-xl">
            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
            @php $total = 0; @endphp
            @foreach ($cart as $item)
                @php
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                @endphp

                <div class="flex justify-between mb-3">
                    <div>
                        <p class="font-medium">{{ $item['name'] }}</p>
                        <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                    </div>
                    <div>
                        <p>{{ $subtotal }} DH</p>
                    </div>
                </div>
            @endforeach
            <hr class="my-4">

            <div class="flex justify-between font-semibold text-lg mb-6">
                <span>Total</span>
                <span>{{ $total }}</span>
            </div>

            {{-- Confirm Order --}}
            <form action="{{ route('client.checkout.placeOrder') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800">
                    Confirm Order
                </button>
            </form>
        </div>
    </div>
@endsection
