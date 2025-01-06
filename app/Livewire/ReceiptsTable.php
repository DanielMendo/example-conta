<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Counter;
use App\Models\Receipt;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\ReceiptsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReceiptsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $selected = [];
    public $client = '';
    public $counter = '';
    public $status = '';
    public $payment_method = '';
    public $showFilters = false;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';


    public function updateState($receiptId)
    {
        Receipt::find($receiptId)->update([
            'status' => 'paid'
        ]);
    }

    public function sortBy($column) 
    {
        $this->sortField = $column;

        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedClient($value)
    {
        if ($value === '') {
            $this->client = null;
        }
    }

    public function updatedCounter($value)
    {
        if ($value === '') {
            $this->counter = null;
        }
    }

    public function updatedStatus($value)
    {
        if ($value === '') {
            $this->status = null;
        }
    }

    public function updatedPayment_method($value)
    {
        if ($value === '') {
            $this->payment_method = null;
        }
    }

    public function deleteSelected()
    {
        Receipt::destroy($this->selected);
        $this->selected = [];
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->client = '';
        $this->counter = '';
        $this->status = '';
        $this->payment_method = '';
        $this->selected = [];
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function exportExcel() {
        return Excel::download(new ReceiptsExport($this->selected), 'receipts.xlsx');
    }

    public function render()
{
    $clients = Client::all();
    $counters = Counter::all();

    $receipts = Receipt::query();

    if (!empty($this->search)) {
        $receipts->whereHas('client', function($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('counter', function($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orWhere('description', 'like', '%' . $this->search . '%')
        ->orderBy('description', 'asc');
    }

    if (!empty($this->client)) {
        $receipts->whereHas('client', function($query) {
            $query->where('id', $this->client);
        });
    }

    if (!empty($this->counter)) {
        $receipts->whereHas('counter', function($query) {
            $query->where('id', $this->counter);
        });
    }

    if (!empty($this->status)) {
        $receipts->where('status', $this->status);
    }

    if (!empty($this->payment_method)) {
        $receipts->where('payment_method', $this->payment_method);
    }

    if ($this->sortField === 'client.name') {
        $receipts->join('clients', 'receipts.client_id', '=', 'clients.id')
                    ->orderBy('clients.name', $this->sortDirection)
                    ->select('receipts.*');
    } else {
        $receipts->orderBy($this->sortField, $this->sortDirection);
    }

    $receipts = $receipts->paginate(10);

    return view('livewire.receipts-table', [
        'receipts' => $receipts,
        'clients' => $clients,
        'counters' => $counters
    ]);
}
}
