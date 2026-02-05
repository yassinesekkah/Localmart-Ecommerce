@props(['products'])
@extends('layouts.client')
@section('title', 'Products')

@section('content')

<x-client.products :products="$products" />
<x-client.categories :categories="$categories" />
@endsection
