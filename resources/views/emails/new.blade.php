<h2>Nouvelle commande #{{ $order->id }}</h2>

<p>Bonjour {{ $recipient->name ?? 'Cher client' }},</p>

<div class="order-info">
    <h3>Informations de la commande</h3>
    <p><strong>Numéro de commande:</strong> #{{ $order->id ?? 'N/A' }}</p>
    <p><strong>Date:</strong> {{ optional($order->created_at)->format('d/m/Y H:i') ?? now()->format('d/m/Y H:i') }}</p>
    <p><strong>Client:</strong> {{ $order->user->name ?? 'Client' }}</p>
    <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
    <p><strong>Total:</strong> {{ number_format($order->total ?? 0, 2, ',', ' ') }} MAD</p>
    <p><strong>Méthode de paiement:</strong> 
        @if($order->payment_method == 'delivery')
            <span style="color: #10b981; font-weight: bold;">Paiement à la livraison</span>
        @elseif($order->payment_method == 'receipt')
            <span style="color: #3b82f6; font-weight: bold;">Paiement en ligne</span>
        @else
            <span style="color: #6b7280;">Non spécifiée</span>
        @endif
    </p>
</div>

<p>Une nouvelle commande a été passée.</p>

<ul>
    @foreach($order->items as $item)
        <li>{{ $item->product->name }} x {{ $item->quantity }} ({{ $item->price }} dh)</li>
    @endforeach
</ul>

<p>Total: {{ $order->total }} dh</p>
