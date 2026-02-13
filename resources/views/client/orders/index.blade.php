@extends('layouts.client')

@section('content')
    <div class="container mx-auto p-8">

        <h1 class="text-2xl font-bold mb-6">
            Historique des commandes
        </h1>

        @if ($orders->isEmpty())
            <p>Vous n'avez aucune commande pour le moment.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 space-4">

                @foreach ($orders as $order)
                    @php
                        $firstItem = $order->items->first();
                        $firstProduct = $firstItem?->product;
                    @endphp

                    <div class="bg-white rounded-xl shadow p-5 flex items-center justify-between">

                        {{-- Left Section --}}
                        <div class="flex items-center gap-4">

                            {{-- Product Image --}}
                            @if ($firstProduct && $firstProduct->image)
                                <img src="{{ asset('storage/' . $firstProduct->image) }}"
                                    class="w-20 h-20 object-cover rounded-lg">
                            @else
                                <div class="w-20 h-20 bg-gray-200 rounded-lg"></div>
                            @endif

                            {{-- Order Info --}}
                            <div>
                                <p class="font-semibold text-lg">
                                    Commande #{{ $order->id }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </p>

                                <p class="text-sm mt-1">
                                    {{ $order->items->count() }} produit(s)
                                </p>

                                <p class="font-medium mt-1">
                                    Total: {{ number_format($order->total, 2) }} MAD
                                </p>
                            </div>

                        </div>

                        {{-- Right Section --}}
                        <div class="flex flex-col items-end gap-3">

                            {{-- Status --}}
                            @php
                                $statusStyles = [
                                    'pending' => 'bg-yellow-50 text-yellow-600 border border-yellow-200',
                                    'shipped' => 'bg-blue-50 text-blue-600 border border-blue-200',
                                    'delivered' => 'bg-green-50 text-green-600 border border-green-200',
                                    'cancelled' => 'bg-red-50 text-red-600 border border-red-200',
                                ];
                            @endphp

                            <span
                                class="px-2.5 py-1 text-xs font-medium rounded-full 
                                      {{ $statusStyles[$order->status] ?? 'bg-gray-100 text-gray-600 border border-gray-200' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                            <div class="flex gap-3">

                                {{-- Details Button --}}
                                <a href="{{ route('client.orders.show', $order) }}"
                                    class="inline-flex items-center justify-center
                                            px-4 py-2 text-sm font-medium
                                            rounded-lg border border-gray-300
                                            bg-white text-gray-800
                                            hover:bg-gray-100 transition">
                                    Voir détails
                                </a>

                                <livewire:client.confirm-delivery :order="$order" :key="'confirm-'.$order->id"/> 

                            </div>


                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
