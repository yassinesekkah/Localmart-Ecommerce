@extends('layouts.admin')

@section('content')
    <div class="p-4">
        <div class="flex items-center justify-end mb-6 pr-3">
            @if($role === 'seller')
            <a href="{{ route('seller.products.create')}}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                + Add Product
            </a>
            @endif
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <x-admin.product-card :product="$product" :role="$role"/>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
@endsection
