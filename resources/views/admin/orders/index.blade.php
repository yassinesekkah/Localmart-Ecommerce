@extends('layouts.admin')

@section('content')
    <div class="p-6">

        <h1 class="text-2xl font-semibold mb-6">Orders</h1>

        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">Client</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Date</th>
                        @if (auth()->user()->hasRole('seller'))
                            <th class="p-3">Actions</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-t">
                            <td class="p-3 font-medium">#{{ $order->id }}</td>
                            <td class="p-3">{{ $order->full_name }}</td>
                            <td class="p-3">{{ $order->total }} DH</td>

                            {{-- Status badge --}}
                            <td class="p-3">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-medium
                                    @if ($order->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($order->status === 'shipped') bg-blue-100 text-blue-700
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-700
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="p-3">{{ $order->created_at->format('d M Y') }}</td>

                            {{-- Actions --}}
                            @if (auth()->user()->hasRole('seller'))
                                <td class="p-3 flex gap-2">

                                    {{-- Ship --}}
                                    @if ($order->status === 'pending')
                                        <a href="{{ route('seller.orders.ship', $order) }}"
                                            class="px-3 py-1 text-xs bg-blue-600 text-white rounded">
                                            Ship
                                        </a>
                                    @endif

                                    {{-- Awaiting confirmation --}}
                                    @if ($order->status === 'shipped')
                                        <div
                                            class="px-3 py-1 text-xs rounded-full 
                                                    bg-yellow-50 text-yellow-700 
                                                    border border-yellow-200 
                                                    font-medium flex items-center">
                                            Awaiting client confirmation
                                        </div>
                                    @endif

                                    {{-- Cancel --}}
                                    @if ($order->status === 'pending')
                                        <form method="POST" action="{{ route('seller.orders.cancel', $order) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="px-3 py-1 text-xs bg-red-600 text-white rounded">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Delivered --}}
                                    @if ($order->status === 'delivered')
                                        <span
                                            class="px-3 py-1 text-xs rounded-full 
                                                    bg-green-50 text-green-700 
                                                    border border-green-200 
                                                    font-medium">
                                            Order completed
                                        </span>
                                    @endif
                                    
                                    {{-- Canceled --}}
                                    @if ($order->status === 'canceled')
                                        <span
                                            class="px-3 py-1 text-xs rounded-full 
                                                    bg-gray-100 text-gray-600 
                                                    border border-gray-200 
                                                    font-medium">
                                            Order closed
                                        </span>
                                    @endif

                                </td>
                            @endif
                        </tr>
                    @endforeach

                    @if ($orders->isEmpty())
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500">
                                No orders found
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
