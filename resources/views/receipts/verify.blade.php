<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-12 text-gray-900 dark:text-gray-100">
                                <div class="grid gap-4 md:grid-cols-3">
                                    <div class="text-white">
                                        <p class="font-medium text-xl mb-3">Detalles del recibo</p>
                                        <p>Mire los datos del recibo </p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="grid md:grid-cols-4 gap-10">
                                            <div class="col-span-2">
                                                <p>Código del recibo</p>
                                                <p>{{ $receipt->receipt_number }}</p>
                                            </div>
                                            <div class="col-span-2">
                                                <p>Cliente</p>
                                                <p>{{ $receipt->client->full_name }}</p>
                                            </div>
                                            <div class="col-span-2">
                                                <p>Contador</p>
                                                <p>{{ $receipt->counter->full_name }}</p>
                                            </div>
                                            <div class="col-span-2">
                                                <p>Monto</p>
                                                <p>${{ $receipt->amount }}</p>
                                            </div>
                                            <div class="col-span-2">
                                                <p>Método de pago</p>
                                                <p>{{ $receipt->payment_method == 'cash' ? 'Efectivo' : 'Cheque' }}</p>
                                            </div>
                                            <div class="col-span-2">
                                                <p>Fecha de pago</p>
                                                <p>{{ \Carbon\Carbon::parse($receipt->payment_date)->format('d/m/Y') }}</p>
                                            </div>
                                            <div class="col-span-2">
                                                <p>Descripción</p>
                                                <p>{{ $receipt->description }}</p>
                                            </div>
                                            <div class="col-span-2">
                                                <p>Estado</p>
                                                <p>{{ strtoupper($receipt->status) == 'paid' ? 'Pagado' : 'Pendiente' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-soft alert-secondary flex items-start gap-4 mt-15">
                                    <span class="icon-[tabler--check] size-6 text-green-700"></span>
                                    <div class="flex flex-col gap-1 text-white">
                                      <h5 class="text-lg font-semibold">Recibo verificado</h5>
                                      <p>El recibo ha sido verficado y se garantiza que es correcto.</p>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="../node_modules/flyonui/flyonui.js"></script>
    </body>
</html>
