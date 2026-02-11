<h2>Statut de votre commande mis à jour</h2>

<p>Bonjour {{ $order->user->name }},</p>

@if($order->status == 'shipped')
    <p>Bonne nouvelle </p>
    <p>Votre commande a été expédiée.</p>
@elseif($order->status == 'cancelled')
    <p>Nous sommes désolés </p>
    <p>Votre commande a été annulée.</p>
@endif
<p>Command products: </p> </br>
@foreach($order->items as $item)
        <li>{{ $item->product->name }} </li>
    @endforeach
<p><strong>Total:</strong> {{ $order->total }} DH</p>
