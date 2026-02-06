@props([
    'product' => null,
    'categories',
    'action',
    'method' => 'POST',
    'button' => 'Save',
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data"
    class="bg-white rounded-xl  shadow-sm w-full max-w-2xl space-y-6 pb-6">

    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    {{-- Name --}}
    <div class="">
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Product name
        </label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
            class="w-full rounded-lg border-gray-300">
    </div>

    {{-- Category --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Category
        </label>
        <select name="category_id" class="w-full rounded-lg border-gray-300">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Price --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Price (MAD)
        </label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}"
            class="w-full rounded-lg border-gray-300">
    </div>
    {{--Quantity--}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Quantity (stock)
        </label>

        <input type="number" name="quantity" min="0" value="{{ old('quantity', $product->quantity ?? 0) }}"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
    </div>
    {{-- Description --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Description
        </label>
        <textarea name="description" class="w-full rounded-lg border-gray-300">
        {{ old('description', $product->description ?? '') }}
    </textarea>
    </div>

    {{-- Current image --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Product image
        </label>

        @if ($product && $product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded">
        @endif

        {{-- Image --}}
        <input type="file" name="image">
    </div>

    <div class="flex justify-end gap-3 pt-4">

        {{-- Cancel --}}
        <a href="{{ route('seller.products.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium
              rounded-md border border-gray-300 text-gray-700
              hover:bg-gray-100 hover:border-gray-400
              transition-colors duration-200">
            Cancel
        </a>

        {{-- Submit --}}
        <button type="submit"
            class="inline-flex items-center px-4 py-2 text-sm font-medium
               rounded-md bg-indigo-600 text-white
               hover:bg-indigo-700
               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1
               transition-colors duration-200">
            {{ $button }}
        </button>

    </div>

</form>
