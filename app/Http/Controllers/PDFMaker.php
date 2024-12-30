<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Mail\ReceiptMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class PDFMaker extends Controller
{
    public function downloadPDF($id)
    {
        $receipt = Receipt::findOrFail($id);
        
        $url = route('receipts.verify', $receipt->receipt_number);
        $pdf = Pdf::loadView('templates.template', compact('receipt', 'url'));

        return $pdf->download('recibo.pdf');
    }

    public function sendPDF($id)
    {
        $receipt = Receipt::findOrFail($id);
        
        $url = route('receipts.verify', $receipt->receipt_number);
        $pdf = Pdf::loadView('templates.template', compact('receipt', 'url'))->output();

        Mail::to($receipt->client->email)->send(new ReceiptMail($receipt, $pdf));

        return redirect()->route('receipts.index')->with('success', 'Recibo enviado exitosamente a ' . $receipt->client->email);
    }
}
