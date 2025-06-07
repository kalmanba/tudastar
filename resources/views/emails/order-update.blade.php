<!-- resources/views/emails/order-update.blade.php -->
<!DOCTYPE html>
<html>
<head>
<title>{{ $subjectLine }}</title>
</head>
<body>
    <h2>A #{{ $order->order_number }} számú rendeléssel kapcsolatos frissítés</h2>
    
    @if($data['type'] === 'pickup')
        <p>Rendelésedet ezen a napon átveheted: <strong>{{ $data['date'] }}</strong></p>
        <p></p>
    @elseif($data['type'] === 'tracking')
        <p>A rendelésedet postáztuk!</p>
        <p>Csomagkövetési szám: <strong>{{ $data['tracking_number'] }}</strong></p>
    @endif
    
    <p>Rendelés részletei:</p>
    <ul>
        @foreach($order->cart_items as $item)
            <li>{{ $item['name'] }}: {{ $item['price'] }} Ft × {{ $item['quantity'] }}</li>
        @endforeach
    </ul>
    
    <p>Köszönjük hogy rendeleseddel támogatod a Tudástárat.</p>
    <p>Kérjük erre az emailre ne válaszolj! Kérdés esetén keress minket emailben a <a href="mailto:ttstore@honaphire.net">ttstore@honaphire.net</a> címen</p>
</body>
</html>