<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 50px;
            width: 18cm;
            height: 29.7cm;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .company-info {
            margin-bottom: 20px
        }

        .company-info h1 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .company-info p {
            font-size: 14px;
            color: #666;
        }

        .receipt-title h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .receipt-title p {
            font-size: 14px;
            color: #666;
        }

        .customer-info {
            margin-bottom: 20px;
        }

        .customer-info h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .payment-details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .payment-details th,
        .payment-details td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .payment-details th {
            background-color: #f2f2f2;
            color: #333;
        }

        .payment-details td {
            color: #555;
        }

        .payment-details td.total {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .payment-details h3 {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 70px;
        }

        .footer p {
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <header class="header">
            <div class="company-info">
                <h1>Despacho Contable</h1>
                <p>{{$receipt->counter->full_name}}</p>
                <p>{{$receipt->counter->address}}</p>
                <p>{{$receipt->counter->phone}}</p>
            </div>
            <div class="receipt-title">
                <h2>Recibo de Pago</h2>
                <p>Fecha: <span id="date">{{ \Carbon\Carbon::parse($receipt->payment_date)->format('d/m/Y') }}</span></p>
                <p>Recibo <span id="receipt-id">#000{{ $receipt->id }}</span></p>
            </div>
        </header>

        <section class="customer-info">
            <h3>Información del Cliente</h3>
            <p><strong>Nombre:</strong> {{ $receipt->client->full_name }}</p>
            <p><strong>Dirección:</strong> {{ $receipt->client->address }}</p>
            <p><strong>Teléfono:</strong>  {{ $receipt->client->phone }}</p>
        </section>

        <section class="payment-details">
            <h3>Detalles del Pago</h3>
            <table>
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Método de Pago</th>
                        <th>Estado</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $receipt->description }}</td>
                        <td>
                            @switch($receipt->payment_method)
                                @case('cash')
                                    Efectivo
                                @break
                                
                                @case('cheque')
                                    Cheque
                                @break
                                
                                @case('transfer')
                                    Transferencia
                                @break
                            @endswitch
                        </td>
                        <td>
                            @switch($receipt->status)
                                @case('paid')
                                    Pagado
                                @break
                                
                                @case('pending')
                                    Pendiente
                                @break
                                
                                @case('canceled')
                                    Cancelado
                                @break
                            @endswitch
                        </td>
                        <td>${{ $receipt->amount }}</td>
                    </tr>
                    <tr>
                        <td class="total" colspan="3">Total</td>
                        <td>${{ $receipt->amount }}</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <footer class="footer">
            <img src="data:image/png;base64, {{!! base64_encode(QrCode::format('png')->size(180)->generate($url)) !!}}" alt="QR Code">
            <p>Gracias por su pago</p>
            <p>Este recibo es válido solo con sello y firma.</p>
        </footer>
    </div>
</body>

</html>
