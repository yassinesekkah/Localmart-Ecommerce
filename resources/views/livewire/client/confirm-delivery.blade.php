<div>

    @if ($order->status === 'shipped')

        <button wire:click="confirm" wire:loading.attr="disabled"
            class="px-4 py-2 text-sm font-medium rounded-lg
                   bg-green-600 text-white
                   hover:bg-green-700 transition">

            <span wire:loading.remove>
                Confirmer réception
            </span>

            <span wire:loading>
                Confirmation...
            </span>

        </button>
        @elseif($order->status === 'pending')

    @elseif ($order->status === 'delivered')
        @if ($showThankYou)
            <span class="text-sm text-green-600 font-medium">
                Thank you for your order 🙌
            </span>
        @endif

    @endif

</div>
