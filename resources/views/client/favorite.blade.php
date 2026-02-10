@extends('layouts.client')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Favorites</h2>

         <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach ($products as $product)
                <div class="border border-gray-300 rounded-lg p-4 card-product relative group">
                    <div class="relative mb-4">
                        <span
                            class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded font-semibold">Sale</span>
                                    <livewire:product-favorites :product="$product"  />

                        <div class="w-full h-48 rounded mb-3 flex items-center justify-center bg-cover bg-center"
                            style="background-image: url('{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x300/e5e7eb/1f2937?text=No+Image' }}');">
                            @if (empty($product->image))
                                <span class="text-yellow-600">Aucune image</span>
                            @endif
                        </div>
                        <div
                            class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 opacity-0 invisible card-product-action transition-all duration-300">
                            <!-- Quick View Button -->
                            <button onclick="openQuickViewModal({{ $product->id }})"
                                class="w-9 h-9 bg-white shadow-lg rounded-lg hover:bg-green-600 hover:text-white transition flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <a href="#"
                            class="text-sm text-gray-500 hover:text-green-600">{{ $product->category->name ?? 'Category' }}</a>
                        <h3 class="font-medium truncate">
                            <a href="#" class="hover:text-green-600">{{ $product->name }}</a>
                        </h3>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500">{{ $product->likes->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between pt-2">
                            <div>
                                <span class="font-semibold text-gray-900">{{ $product->price }} MAD</span>
                            </div>
                            {{--lbutton dyal add rah katzid l product fel panier bghiti tbadel design mat7ayedch route--}}
                            <form action="{{ route('client.cart.add', $product->id) }}" method="POST" class="inline">
                                @csrf

                                <button type="submit"
                                    class="px-3 py-1.5 bg-green-600 text-white text-sm rounded-lg
                                     hover:bg-green-700 transition flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection