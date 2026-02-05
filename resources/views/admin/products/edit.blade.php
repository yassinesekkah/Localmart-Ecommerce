@extends('layouts.admin')

@section('content')
    <div class="flex flex-col items-center">

        <h1 class="text-2xl font-semibold text-gray-800 mb-2 pt-4">
            Edit Product
        </h1>

        <x-admin.product-form
            :product="$product"
            :categories="$categories"
            :action="route('seller.products.update', $product)"
            method="PUT"
            button="Update Product"
        />
    </div>
@endsection