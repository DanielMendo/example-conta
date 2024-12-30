<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Receipt') . ' #000' . $receipt->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-900 dark:text-gray-100">
                    <div class="grid gap-4 md:grid-cols-3">
                        <div class="text-white">
                            <p class="font-medium text-xl mb-3">Detalles del recibo</p>
                            <p>Mire los datos del recibo </p>
                            <p>Recibo verficado</p>
                        </div>
                        <div class="md:col-span-2">
                            <div class="grid md:grid-cols-4 gap-10">
                                <div class="col-span-2">
                                    <p class="font-bold text-lg">Código del recibo</p>
                                    <p>{{ $receipt->receipt_number }}</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="font-bold text-lg">Cliente</p>
                                    <p>{{ $receipt->client->full_name }}</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="font-bold text-lg">Contador</p>
                                    <p>{{ $receipt->counter->full_name }}</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="font-bold text-lg">Monto</p>
                                    <p>${{ $receipt->amount }}</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="font-bold text-lg">Método de pago</p>
                                    @switch($receipt->payment_method)
                                        @case('cash')
                                            <p>Efectivo</p>
                                        @break
                                        
                                        @case('cheque')
                                            <p>Cheque</p>
                                        @break
                                        
                                        @case('transfer')
                                            <p>Transferencia</p>
                                        @break
                                    @endswitch
                                </div>
                                <div class="col-span-2">
                                    <p class="font-bold text-lg">Fecha de pago</p>
                                    <p>{{ \Carbon\Carbon::parse($receipt->payment_date)->format('d/m/Y') }}</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="font-bold text-lg">Descripción</p>
                                    <p>{{ $receipt->description }}</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="font-bold text-lg">Estado</p>
                                    @switch($receipt->status)
                                        @case('paid')
                                            <p>Pagado</p>
                                            @break
                                        
                                        @case('pending')
                                            <p>Pendiente</p>
                                            @break
                                        
                                        @case('canceled')
                                            <p>Cancelado</p>
                                            @break  
                                    @endswitch                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 text-right">
                        <a href="{{ route('receipts.index') }}" class="btn">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>