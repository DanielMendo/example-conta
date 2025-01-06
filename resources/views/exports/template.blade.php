<table>
    <thead>
        <tr>
            <th style="font-weight: bold;">Cliente</th>
            <th style="font-weight: bold;">Concepto</th>
            <th style="font-weight: bold;">Monto</th>
            <th style="font-weight: bold;">Estado</th>
            <th style="font-weight: bold;">Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($receipts as $receipt)
            <tr>
                <td>{{ strtoupper($receipt->client->full_name) }}</td>
                <td>{{ strtoupper($receipt->description) }}</td>
                <td >$ {{ number_format($receipt->amount, 2) }}</td>
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
                <td>
                    {{ \Carbon\Carbon::parse($receipt->payment_date)->format('d/m/Y') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
