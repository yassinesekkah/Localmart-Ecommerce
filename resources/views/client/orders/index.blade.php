@extends('layouts.client')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Historique des commandes</h1>

    @if($orders->isEmpty())
        <p>Vous n'avez aucune commande pour le moment.</p>
    @else
        <div class="grid gap-4"> 

            @foreach($orders as $order)
                <div class="border p-4 rounded shadow-sm">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Commande #{{ $order->id }}</span>
                        <span class="text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>

                    <div class="mb-2">
                        @foreach($order->items as $item)
                            <div class="flex justify-between">
                                <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                                <span>{{ number_format($item->price, 2) }} MAD</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-right font-bold">
                        Total: {{ number_format($order->total, 2) }} MAD
                    </div>

                    <div class="text-right mt-1">
                        Statut: 
                        @if($order->status == 'pending')
                            <span class="text-yellow-500 font-semibold">En attente</span>
                        @elseif($order->status == 'completed')
                            <span class="text-green-600 font-semibold">Livrée</span>
                        @elseif($order->status == 'canceled')
                            <span class="text-red-600 font-semibold">Annulée</span>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    @endif
</div>
@endsection
