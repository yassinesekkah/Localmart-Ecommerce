<h2>Nouvelle commande #{{ $order->id }}</h2>

<p>Bonjour {{ $recipient->name ?? 'Cher client' }},</p>

<p>Une nouvelle commande a été passée.</p>

<ul>
    @foreach($order->items as $item)
        <li>{{ $item->product->name }} x {{ $item->quantity }} ({{ $item->price }} dh)</li>
    @endforeach
</ul>

<p>Total: {{ $order->total }} dh</p>
