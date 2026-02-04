@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">
        Products
    </h1>

    <a href="#"
       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
        + Add Product
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-6 py-3">Image</th>
                <th class="px-6 py-3">Name</th>
                <th class="px-6 py-3">Category</th>
                <th class="px-6 py-3">Price</th>
                <th class="px-6 py-3 text-right">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            {{-- Example row --}}
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div class="w-12 h-12 bg-gray-200 rounded"></div>
                </td>

                <td class="px-6 py-4 font-medium text-gray-800">
                    Product name
                </td>

                <td class="px-6 py-4 text-gray-600">
                    Category name
                </td>

                <td class="px-6 py-4 text-gray-800">
                    199.00 MAD
                </td>

                <td class="px-6 py-4 text-right space-x-2">
                    <a href="#"
                       class="text-indigo-600 hover:underline">
                        Edit
                    </a>

                    <button class="text-red-600 hover:underline">
                        Delete
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
