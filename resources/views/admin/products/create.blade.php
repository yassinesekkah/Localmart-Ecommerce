@extends('layouts.admin')

@section('content')
    <div class="flex flex-col items-center">

        <h1 class="text-2xl font-semibold text-gray-800 mb-6 pt-4">
            Create Product
        </h1>

        <x-admin.product-form
    :categories="$categories"
    :action="route('seller.products.store')"
    button="Create Product"
/>
    </div>
@endsection
