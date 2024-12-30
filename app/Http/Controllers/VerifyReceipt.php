<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;

class VerifyReceipt extends Controller
{
    public function __invoke($receipt_number)
    {
        $receipt = Receipt::where('receipt_number', $receipt_number)->first();
        if (!$receipt) {
            abort(404);
        }

        return view('receipts.verify', compact('receipt'));
    }
}
