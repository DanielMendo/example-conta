<?php

namespace App\Exports;

use App\Models\Receipt;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReceiptsExport implements FromView
{
    public array $selected;

    public function __construct(array $selected)
    {
        $this->selected = $selected;
    }

    public function view(): View
    {
        $receipts = empty($this->selected) ? Receipt::all() : Receipt::whereIn('id', $this->selected)->get();

        return view('exports.template', [
            'receipts' => $receipts
        ]);
    }
}
