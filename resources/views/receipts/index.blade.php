<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Receipts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="alert alert-success mb-4 alertOriginal">
                            <div class="flex">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-sm text-gray-800 dark:text-gray-200">
                                        {{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="w-full overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Contador</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipts as $receipt)
                                    <tr>
                                        <td class="text-nowrap">{{ strtoupper($receipt->client->full_name) }}</td>
                                        <td class="text-nowrap">{{ strtoupper($receipt->counter->full_name) }}</td>
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
