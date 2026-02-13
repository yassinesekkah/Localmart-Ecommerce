@extends('layouts.client')

@section('content')
<div class="max-w-lg mx-auto py-10">
    <h1 class="text-2xl font-bold mb-4">Stripe Checkout Test</h1>

    <form action="{{ route('stripe.checkout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-500">
            Pay Now
        </button>
    </form>
</div>
@endsection