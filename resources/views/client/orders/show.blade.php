@extends('layouts.client')

@section('content')
    <div class="container mx-auto p-8 ">

        {{-- Header --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                {{-- Left Section --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Commande
                    </p>

                    <h1 class="text-3xl font-bold text-gray-900 mt-1">
                        #{{ $order->id }}
                    </h1>

                    <p class="text-sm text-gray-500 mt-2">
                        Passée le {{ $order->created_at->format('d/m/Y à H:i') }}
                    </p>

                </div>

                {{-- Right Section --}}
                <div class="flex items-center gap-4">

                    {{-- Status Badge --}}
                    @php
                        $statusStyles = [
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'shipped' => 'bg-blue-100 text-blue-700',
                            'delivered' => 'bg-green-100 text-green-700',
                            'cancelled' => 'bg-red-100 text-red-700',
                        ];
                    @endphp

                    <span
                        class="px-4 py-2 rounded-full text-sm font-medium 
                         {{ $statusStyles[$order->status] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <main class="grid grid-cols-1  lg:grid-cols-4  gap-6 space-y-4">

            {{-- Products --}}
            <div class="lg:col-span-3 bg-white rounded-2xl shadow-sm border border-gray-100">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">
                        Articles commandés
                    </h2>

                    <span class="text-sm text-gray-500">
                        {{ $order->items->count() }} produit(s)
                    </span>
                </div>

                {{-- Items --}}
                <div class="divide-y divide-gray-100">

                    @foreach ($order->items as $item)
                        <div class="flex items-center justify-between px-6 py-5 hover:bg-gray-50 transition">

                            {{-- Left Section --}}
                            <div class="flex items-center gap-4">

                                {{-- Image --}}
                                @if ($item->product && $item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                        class="w-20 h-20 object-cover rounded-xl border border-gray-100 shadow-sm">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded-xl"></div>
                                @endif

                                {{-- Info --}}
                                <div>
                                    <p class="font-medium text-gray-800 text-base">
                                        {{ $item->product->name ?? 'Produit supprimé' }}
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Prix unitaire : {{ number_format($item->price, 2) }} MAD
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Quantité : {{ $item->quantity }}
                                    </p>
                                </div>
                            </div>

                            {{-- Right Section --}}
                            <div class="text-right">
                                <p class="text-sm text-gray-500">
                                    Sous-total
                                </p>

                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    {{ number_format($item->price * $item->quantity, 2) }} MAD
                                </p>
                            </div>

                        </div>
                    @endforeach

                </div>

                {{-- Total Section --}}
                <div class="px-6 py-6 bg-gray-50 border-t border-gray-100 flex justify-between items-center">

                    <div>
                        <p class="text-sm text-gray-500">
                            Total payé
                        </p>
                        <p class="text-xl font-bold text-gray-900">
                            {{ number_format($order->total, 2) }} MAD
                        </p>
                    </div>

                    <livewire:client.confirm-delivery :order="$order" :showThankYou="true" />
                </div>

            </div>

            {{-- Shipping Info --}}
            <div class="lg:col-span-1 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                {{-- Title --}}
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-lg font-semibold text-gray-800">
                        Informations de livraison
                    </h2>

                    <span class="text-xs px-3 py-1 bg-gray-100 rounded-full text-gray-600">
                        Livraison
                    </span>
                </div>

                {{-- Info List --}}
                <div class="space-y-4 text-sm">

                    {{-- Nom --}}
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-lg">
                            👤
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Nom complet</p>
                            <p class="font-medium text-gray-800">
                                {{ $order->full_name }}
                            </p>
                        </div>
                    </div>

                    {{-- Téléphone --}}
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-lg">
                            📞
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Téléphone</p>
                            <p class="font-medium text-gray-800">
                                {{ $order->phone }}
                            </p>
                        </div>
                    </div>

                    {{-- Adresse --}}
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-lg">
                            📍
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Adresse</p>
                            <p class="font-medium text-gray-800">
                                {{ $order->address }}
                            </p>
                        </div>
                    </div>

                    {{-- Ville --}}
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-lg">
                            🏙️
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Ville</p>
                            <p class="font-medium text-gray-800">
                                {{ $order->city }}
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </main>
        {{-- Back Button --}}
        <div class="mt-6">
            <a href="{{ route('client.orders.index') }}"
                class="inline-block px-5 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition text-sm font-medium">
                ← Retour aux commandes
            </a>
        </div>

    </div>
@endsection
