@extends('layouts.admin')

@section('content')
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            Tailwind Test
        </h2>

        <p class="text-gray-600 mb-6">
            Ila had layout w colors baynin,
            rah Tailwind khdam mzyan ✅
        </p>

        <div class="grid grid-cols-3 gap-4">
            <div class="bg-blue-500 text-white p-4 rounded">
                Card 1
            </div>
            <div class="bg-green-500 text-white p-4 rounded">
                Card 2
            </div>
            <div class="bg-red-500 text-white p-4 rounded">
                Card 3
            </div>
        </div>
    </div>
@endsection
