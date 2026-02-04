@extends('layouts.admin')

@section('content')
    <div>
        <div class="flex items-center justify-end mb-6 pr-3">
            <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                + Add Product
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <x-admin.product-card />
            <x-admin.product-card />
            <x-admin.product-card />
            <x-admin.product-card />
        </div>
    </div>
@endsection
