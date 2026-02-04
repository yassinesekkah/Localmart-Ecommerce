@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Category Details</h1>
        <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Back to Categories
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 gap-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $category->name }}</h2>
                
                <div class="space-y-3">
                    <div>
                        <span class="font-semibold text-gray-700">Slug:</span>
                        <span class="text-gray-600">{{ $category->slug }}</span>
                    </div>
                    
                    <div>
                        <span class="font-semibold text-gray-700">Created At:</span>
                        <span class="text-gray-600">{{ $category->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    
                    <div>
                        <span class="font-semibold text-gray-700">Updated At:</span>
                        <span class="text-gray-600">{{ $category->updated_at->format('M d, Y H:i') }}</span>
                    </div>
                    
                    @if($category->description)
                        <div>
                            <span class="font-semibold text-gray-700">Description:</span>
                            <p class="text-gray-600 mt-1">{{ $category->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
