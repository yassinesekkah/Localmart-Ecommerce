<div>


    @if (session()->has('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-2">
            {{ session('success') }}
        </div>
    @endif
    
<form wire:submit.prevent="add" method="POST" class="inline-block" onclick="event.stopPropagation()">
    @csrf
    <button type="submit"
        class="flex items-center gap-1 px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md">
        <svg class="w-6 h-6 texy-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4
                            M7 13L5.4 5
                            M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17
                            m0 0a2 2 0 100 4 2 2 0 000-4
                            zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
    </button>
</form>
</div>