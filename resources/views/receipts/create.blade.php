<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Receipt') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-20 text-gray-900 dark:text-gray-100">
                    <div class="grid gap-4 md:grid-cols-3">
                        <div class="text-white">
                            <p class="font-medium text-xl mb-3">Detalles del recibo</p>
                            <p>Llene todos los campos</p>
                        </div>
                        <div class="md:col-span-2">
                            <form action="{{ route('receipts.store') }}" method="POST">
                                @csrf
                                <div class="grid md:grid-cols-4 gap-10 ">
                                    <div class="col-span-2">
                                        <label for="receipt_number">Código del recibo</label>
                                        <input type="text" value="{{ $code }}" name="receipt_number"
                                            id="receipt_number"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-900">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="client_id">Cliente</label>
                                        <select name="client_id" id="client_id"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-900">
                                            <option disabled selected>Seleccione un cliente</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>                                          
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="counter_id">Contador</label>
                                        <select name="counter_id" id="counter_id"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-900">
                                            <option disabled selected>Seleccione un contador</option>
                                            @foreach ($counters as $counter)
                                                <option value="{{ $counter->id }}">{{ $counter->name }}</option>                                          
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="amount">Monto</label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-1/4 text-lg">$</span>
                                            <input type="number" name="amount" id="amount" 
                                                   class="h-10 border mt-1 rounded px-4 pl-10 pr-14 w-full bg-gray-900" 
                                                   placeholder="389.99">
                                            <span class="absolute right-4 top-1/4 text-base">MXN</span>
                                        </div>
                                    </div>  
                                    <div class="col-span-2">
                                        <label for="payment_method">Método de pago</label>
                                        <select name="payment_method" id="payment_method"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-900">
                                            <option disabled selected>Seleccione un método</option>
                                            <option value="cash">Efectivo</option>
                                            <option value="cheque">Cheque</option>
                                            <option value="transfer">Transferencia</option>
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="payment_date">Fecha de pago</label>
                                        <input type="date" name="payment_date" id="payment_date"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-900">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="description">Descripción</label>
                                        <input type="text" name="description" id="description"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-900" placeholder="Mes Enero 2024">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="status">Estado</label>
                                        <select name="status" id="status"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-900">
                                            <option disabled selected>Seleccione un estado</option>
                                            <option value="paid">Pagado</option>
                                            <option value="pending">Pendiente</option>
                                            <option value="canceled">Cancelado</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-4 text-right">
                                        <div class="inline-flex items-end gap-4">
                                            <button type="button"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                                aria-haspopup="dialog" aria-expanded="false" aria-controls="basic-modal"
                                                data-overlay="#basic-modal">Guardar</button>
                                            <div id="basic-modal" class="overlay modal overlay-open:opacity-100 hidden"
                                                role="dialog" tabindex="-1">
                                                <div class="modal-dialog overlay-open:opacity-100">
                                                    <div class="modal-content bg-gray-700">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title text-white">Enviar por correo</h3>
                                                            <button type="button"
                                                                class="btn btn-text btn-circle btn-sm absolute end-3 top-3"
                                                                aria-label="Close" data-overlay="#basic-modal">
                                                                <span class="icon-[tabler--x] size-4"></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            ¿Desea enviar el recibo por correo a la siguiente dirección?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Solo guardar</button>
                                                            <button type="submit" name="action" value="send" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Enviar por correo</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
