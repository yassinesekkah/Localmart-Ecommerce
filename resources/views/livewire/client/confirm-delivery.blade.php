<div>

    {{-- Shipped → Show confirm button --}}
    @if ($order->status === 'shipped')

        <button
            wire:click="confirm"
            wire:loading.attr="disabled"
            class="inline-flex items-center justify-center
                   px-4 py-2 text-sm font-medium rounded-lg
                   bg-green-600 text-white
                   hover:bg-green-700 transition
                   disabled:opacity-50">

            {{-- Normal state --}}
            <span wire:loading.remove>
                Confirmer réception
            </span>

            {{-- Loading state --}}
            <span wire:loading>
                Confirmation...
            </span>

        </button>

    @endif

</div>

