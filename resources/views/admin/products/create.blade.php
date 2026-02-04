@extends('layouts.admin')

@section('content')
<div class="flex flex-col items-center">

    <h1 class="text-2xl font-semibold text-gray-800 mb-6 pt-4">
        Create Product
    </h1>

    <div class="bg-white rounded-xl p-6 shadow-sm w-full max-w-2xl"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">

            @csrf

            {{-- Product name --}}
            <div class="pb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Product name
                </label>
                <input type="text" name="name"
                       class="w-full rounded-lg  border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="Ex: iPhone 15 Pro">
            </div>

            {{-- Category --}}
            <div class="pb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Category
                </label>
                <select name="category_id"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Price --}}
            <div class="pb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Price (MAD)
                </label>
                <input type="number" step="0.01" name="price"
                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="199.00">
            </div>

            {{-- Description --}}
            <div class="pb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <textarea name="description" rows="4"
                          class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                          placeholder="Product description..."></textarea>
            </div>

            {{-- Image --}}
            <div class="pb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Product image
                </label>
                <input type="file" name="image"
                       class="block w-full text-sm text-gray-600
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:bg-indigo-50 file:text-indigo-700
                              hover:file:bg-indigo-100">
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-4">
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white
                               hover:bg-indigo-700 transition">
                    Save product
                </button>

                <a href="{{ route('seller.products.index') }}"
                   class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700
                          hover:bg-gray-50 transition">
                    Cancel
                </a>
            </div>

        </form>
    </div>
    </div>
@endsection
