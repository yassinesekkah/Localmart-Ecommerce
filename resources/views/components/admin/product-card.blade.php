@props(['product', 'role'])

<div class="bg-white rounded-lg border border-gray-200 shadow-sm
           hover:shadow-md transition overflow-hidden">

    <div class="flex flex-col bg-neutral-primary-soft p-3 ">

        <!-- Image -->
        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/category/category-1.jpg') }}"
            alt="{{ $product->name }}" class="w-full h-32 object-cover rounded-md mb-2" />

        <!-- Content -->
        <div class="flex flex-col flex-1">

            <!-- Category -->
            <span
                class="inline-block w-fit mb-1 px-2 py-0.5 text-xs font-medium
                       text-indigo-700 bg-indigo-50 rounded">
                {{ $product->category->name }}
            </span>

            <!-- Title -->
            <h5 class="text-sm font-semibold text-gray-800 mb-1 truncate">
                {{ $product->name }}
            </h5>

            <!-- Description -->
            <p class="text-xs text-gray-500 mb-2 line-clamp-2">
                {{ $product->description }}
            </p>

            <!-- Price -->
            <div class="mb-2">
                <span class="text-base font-bold text-indigo-600">
                    {{ number_format($product->price, 2) }} MAD
                </span>
            </div>

            <!-- Actions -->
            <div class="flex gap-2 mt-auto">
                @if($role === 'seller')
                {{-- Edit --}}
                <a href="{{ route('seller.products.edit', $product) }}"
                    class="flex-1 text-xs font-medium text-white
                            bg-emerald-600 hover:bg-emerald-500
                            rounded px-2 py-1.5 transition text-center">
                    Modifier
                </a>
                @endif
                {{-- Delete --}}
                <form action="{{ route('seller.products.destroy', $product) }}" method="POST" class="flex-1"
                    onsubmit="return confirm('Are you sure you want to delete this product?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="w-full text-xs font-medium text-white
                   bg-red-600 hover:bg-red-500
                   rounded px-2 py-1.5 transition">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
