<div class="w-full overflow-x-auto">
    <div class="grid grid-cols-6 gap-4 mb-2">
        <div class="search col-span-3">
                <label class="input-group bg-gray-800 focus:border-gray-900 focus:ring-gray-900 focus:ring">
                <span class="input-group-text ">
                    <span class="icon-[tabler--search] size-6"></span>
                </span>
                <input type="search" wire:model.live="search" id="search" class="input grow" placeholder="Search" />
            </label>
        </div>

        <div class="options col-span-3 flex items-center justify-end gap-4">
            <button class="btn btn-accent" wire:click="resetFilters" id="reset">
                <span class="icon-[tabler--refresh] size-6"></span>
            </button>
            <button type="button" class="btn btn-warning" id="filter" wire:click="toggleFilters">
                <span class="icon-[tabler--filter] size-6"></span>
                Filtrar
            </button>
            <button type="button" class="btn btn-error" wire:click="deleteSelected" id="destroy">
                <span class="icon-[tabler--trash] size-6"></span>
                Eliminar {{ count($selected) == 0 ? '' : '(' . count($selected) . ')' }}
            </button>
            <button type="button" class="btn btn-success" wire:click="exportExcel">
                <span class="icon-[tabler--download] size-6"></span>
                Exportar {{ count($selected) == 0 ? '' : '(' . count($selected) . ')' }}
            </button>
        </div>

    </div>

    <!-- Filtro (Oculto por defecto) -->
    <div class="bg-gray-800 p-4 {{ $showFilters ? '' : 'hidden' }}" id="filter-container">
        <div class="grid grid-cols-4 gap-4">
            <div>
                <label for="client" class="block text-white">Cliente</label>
                <select id="client" wire:model.live="client" class="input bg-gray-800 w-full focus:border-gray-900 focus:ring focus:ring-gray-900">
                    <option selected value="">Todos</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="counter" class="block text-white">Contador</label>
                <select id="counter" wire:model.live="counter" class="input bg-gray-800 w-full focus:border-gray-900 focus:ring focus:ring-gray-900">
                    <option value="">Todos</option>
                    @foreach($counters as $counter)
                        <option value="{{ $counter->id }}">{{ $counter->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="status" class="block text-white">Estado</label>
                <select id="status" wire:model.live="status" class="input bg-gray-800 w-full focus:border-gray-900 focus:ring focus:ring-gray-900">
                    <option value="">Todos</option>
                    <option value="paid">Pagado</option>
                    <option value="pending">Pendiente</option>
                    <option value="canceled">Cancelado</option>
                </select>
            </div>
            <div>
                <label for="payment_method" class="block text-white">Método de Pago</label>
                <select id="payment_method" wire:model.live="payment_method" class="input bg-gray-800 w-full focus:border-gray-900 focus:ring focus:ring-gray-900">
                    <option value="">Todos</option>
                    <option value="cash">Efectivo</option>
                    <option value="transfer">Tarjeta de Crédito</option>
                    <option value="cheque">PayPal</option>
                </select>
            </div>
        </div>
    </div>


    <table class="table mt-6">
        <thead>
            <tr>
                <th></th>
                <th wire:click="sortBy('client.name')" class="cursor-pointer">
                    <div class="flex gap-1 items-center">
                        Cliente
                        @if ($sortField !== 'client.name')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                            @elseif ($sortDirection === 'asc')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                </svg>
                            @elseif ($sortDirection === 'desc')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>                            
                        @endif
                    </div>
                </th>
                <th wire:click="sortBy('description')" class="cursor-pointer">
                    <div class="flex gap-1 items-center">
                        Descripción
                        @if ($sortField !== 'description')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                            @elseif ($sortDirection === 'asc')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                </svg>
                            @elseif ($sortDirection === 'desc')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>                            
                        @endif
                    </div>
                </th>
                <th wire:click="sortBy('amount')" class="cursor-pointer">
                    <div class="flex gap-1 items-center">
                        Cantidad
                        @if ($sortField !== 'amount')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                            @elseif ($sortDirection === 'asc')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                </svg>
                            @elseif ($sortDirection === 'desc')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>                            
                        @endif
                    </div>
                </th>
                <th wire:click="sortBy('status')" class="cursor-pointer">
                    <div class="flex gap-1 items-center">
                        Estado
                        @if ($sortField !== 'status')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                            @elseif ($sortDirection === 'asc')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                </svg>
                            @elseif ($sortDirection === 'desc')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>                            
                        @endif
                    </div>
                </th>
                <th wire:click="sortBy('payment_date')" class="cursor-pointer">
                    <div class="flex gap-1 items-center">
                        Fecha
                        @if ($sortField !== 'payment_date')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                            @elseif ($sortDirection === 'asc')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                </svg>
                            @elseif ($sortDirection === 'desc')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>                            
                        @endif
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receipts as $receipt)
                <tr>
                    <td class="text-nowrap">
                        <input type="checkbox" wire:model.live="selected" value="{{$receipt->id}}" class="checkbox checkbox-secondary bg-gray-800">
                    </td>
                    <td class="text-nowrap">{{ strtoupper($receipt->client->full_name) }}</td>
                    <td class="text-nowrap">{{ strtoupper(Str::words($receipt->description, 3, '')) }}</td>
                    <td>$ {{ $receipt->amount }}</td>
                    <td>
                        @switch($receipt->status)
                        @case('paid')
                            <span class="badge badge-soft badge-success text-xs">Pagado</span>
                            @break

                        @case('pending')
                            <span class="badge badge-soft badge-warning text-xs">Pendiente</span>
                            @break
                        
                        @case('canceled')
                            <span class="badge badge-soft badge-danger text-xs">Cancelado</span>
                            @break  
                        @endswitch
                    </td>
                    <td class="text-nowrap">
                        {{ \Carbon\Carbon::parse($receipt->payment_date)->format('d/m/Y') }}</td>
                    <td>
                        <a class="btn btn-circle btn-text btn-sm"
                            aria-label="Action button" href="{{ route('receipts.show', $receipt->receipt_number) }}"><span
                                class="icon-[tabler--eye] size-5"></span></a>
                        <a class="btn btn-circle btn-text btn-sm"
                            aria-label="Action button" href="{{ route('pdf.download', $receipt->id) }}"><span
                                class="icon-[tabler--download] size-5"></span></a>
                        <a class="btn btn-circle btn-text btn-sm"
                            aria-label="Action button" href="{{ route('pdf.send', $receipt->id) }}"><span
                                class="icon-[tabler--send] size-5"></span></a>
                        @if ($receipt->status == 'pending')
                            <button type="button" wire:click="updateState({{ $receipt->id }})" class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                <span class="icon-[tabler--check] size-5"><span>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-5 pagination">
        {{ $receipts->links() }}
    </div>
</div>
