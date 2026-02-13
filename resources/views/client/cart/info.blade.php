@extends('layouts.client')

@section('content')
<div class="max-w-6xl mx-auto py-10 grid grid-cols-1 md:grid-cols-2 gap-10">

    {{-- Delivery Info --}}
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4">Delivery Information</h2>
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong class="block mb-2">Please fix these errors:</strong>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <form action="{{ route('client.checkout.storeInfo') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm mb-1">Full Name</label>
                <input type="text" name="full_name" value="{{ old('full_name', $checkoutInfo['full_name'] ?? '') }}" class="w-full border rounded-lg p-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $checkoutInfo['phone'] ?? '') }}" class="w-full border rounded-lg p-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Address</label>
                <input type="text" name="address" value="{{ old('address', $checkoutInfo['address'] ?? '') }}" class="w-full border rounded-lg p-2">
            </div>

            <div class="mb-6">
                <label class="block text-sm mb-1">City</label>
                <input type="text" name="city" value="{{ old('city', $checkoutInfo['city'] ?? '') }}" class="w-full border rounded-lg p-2">
            </div>

            <button type="submit" class="bg-black text-white px-6 py-3 rounded-lg">
                Continue
            </button>
        </form>
    </div>

    {{-- Cart Summary --}}
    <div class="bg-gray-50 p-6 rounded-xl">
        <h2 class="text-xl font-semibold mb-4">Your Cart</h2>

        @php $total = 0; @endphp

        @foreach ($cart as $item)
        @php
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
        @endphp

        <div class="flex justify-between mb-3">
            <div>
                <p class="font-medium">{{ $item['name'] }}</p>
                <p class="text-sm text-gray-500">
                    Qty: {{ $item['quantity'] }}
                </p>
            </div>
            <span>{{ $subtotal }} DH</span>
        </div>
        @endforeach

        <hr class="my-4">

        <div class="flex justify-between font-semibold text-lg">
            <span>Total</span>
            <span>{{ $total }} DH</span>
        </div>
    </div>

</div>
@endsection