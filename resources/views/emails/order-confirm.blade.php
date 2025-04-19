<!-- resources/views/emails/order-confirmation.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Rendelés Megerősítése</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .order-details { margin: 20px 0; }
        .footer { margin-top: 20px; font-size: 0.9em; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Rendelés Megerősítése</h1>
            <p>Köszönjük rendelését!</p>
        </div>
        
        <div class="content">
            <p>Kedves {{ $order->customer_name }},</p>
            <p>Rendelését rögzíterttük, és megkezdtük az előkészítését!</p>
            
            <div class="order-details">
                <h3>Rendelés száma: #{{ $order->order_number }}</h3>
                <p><strong>Dátum:</strong> {{ $order->created_at->format('F j, Y') }}</p>
                <p><strong>Összeg:</strong> {{ $order->total_amount }}</p>
                <p><strong>Fizetési Módszer</strong> {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</p>
            </div>
            
            <h4>Megrendelt termékek:</h4>
            <table width="100%" cellpadding="5" cellspacing="0" border="0">
                @foreach($order->cart_items as $item)
                <tr>
                    <td>{{ $item['name'] }} × {{ $item['quantity'] }}</td>
                    <td align="right">{{ $item['total'] }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td><strong>Összesen</strong></td>
                    <td align="right"><strong>{{ $order->total_amount }}</strong></td>
                </tr>
            </table>
            
            <h4>Szállítási cím</h4>
            <p>{{ nl2br($order->shipping_address) }}</p>
        </div>
        
        <div class="footer">
            <p>Kérdés esetén keressen minket az info@honaphire.net email címen. Erra az emailre kérjük ne válaszoljon.</p>
            <p>© {{ date('Y') }} Hónap Híre Médiacsoport. Minden Jog fenntartva!</p>
        </div>
    </div>
</body>
</html>