
@extends('layouts.client')

@section('title', 'Home')
@section('content')

<x-client.slider />
{{-- <x-client.categories :categories="$categories" /> --}}
<x-client.products :products="$products" />
<!-- Shop Cart -->


@endsection