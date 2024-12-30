<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo Enviado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Recibo de Pago</h2>
    </div>

    <div class="content">
        <p>Estimado/a {{ $receipt->client->name }},</p>

        <p>Gracias por su pago. Adjuntamos el recibo correspondiente a su transacción.</p>

        <p><strong>Detalles del Recibo:</strong></p>
        <ul>
            <li><strong>Código:</strong> {{ $receipt->receipt_number }}</li>
            <li><strong>Cliente:</strong> {{ $receipt->client->full_name }}</li>
            <li><strong>Contador:</strong> {{ $receipt->counter->full_name }}</li>
            <li><strong>Monto:</strong> ${{ number_format($receipt->amount, 2) }} MXN</li>
            @switch($receipt->payment_method)
                @case('cash')
                    <li><strong>Método de Pago:</strong> Efectivo</li>
                @break
                
                @case('cheque')
                    <li><strong>Método de Pago:</strong> Cheque</li>
                @break
                
                @case('transfer')
                    <li><strong>Método de Pago:</strong> Transferencia</li>
                @break
            @endswitch
            <li><strong>Fecha de Pago:</strong> {{ \Carbon\Carbon::parse($receipt->payment_date)->format('d/m/Y') }}</li>
            @switch($receipt->status)
                @case('paid')
                    <li><strong>Estado:</strong> Pagado</li>
                @break
                
                @case('pending')
                    <li><strong>Estado:</strong> Pendiente</li>
                @break
                
                @case('canceled')
                    <li><strong>Estado:</strong> Cancelado</li>
                @break
            @endswitch
        </ul>

        <p>Si tiene alguna duda, no dude en ponerse en contacto con nosotros.</p>

        <p>Saludos cordiales,</p>
        <p><strong>Despacho Contable</strong></p>
    </div>

    <div class="footer">
        <p>Este es un correo automático, por favor no lo responda.</p>
    </div>
</body>
</html>
