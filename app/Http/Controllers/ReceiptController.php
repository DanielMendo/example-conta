<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Counter;
use App\Models\Receipt;
use App\Mail\ReceiptMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class ReceiptController extends Controller
{
    public function index()
    {
        $receipts = Receipt::all();
        return view('receipts.index', compact('receipts'));
    }
    
    public function create() {
        $code = Str::uuid();
        $clients = Client::all();
        $counters = Counter::all();
        
        return view('receipts.create', compact('code', 'clients', 'counters'));
    }

    public function show($receipt_number)
    {
        $receipt = Receipt::where('receipt_number', $receipt_number)->first();
        return view('receipts.show', compact('receipt'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receipt_number' => 'required|string|max:255|unique:receipts',
            'client_id' => 'required|exists:clients,id',
            'counter_id' => 'required|exists:counters,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'payment_date' => 'required|date',
            'description' => 'nullable|string',
            'status' => 'required|string|in:paid,pending,canceled',
        ]);

            $receipt = Receipt::create([
            'receipt_number' => $request->input('receipt_number'),
            'client_id' => $request->input('client_id'),
            'counter_id' => $request->input('counter_id'),
            'amount' => $request->input('amount'),
            'payment_method' => $request->input('payment_method'),
            'payment_date' => $request->input('payment_date'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);

        if($request->input('action') == 'send') {
            $url = route('receipts.verify', $receipt->receipt_number);
            $pdf = Pdf::loadView('templates.template', compact('receipt', 'url'));

            Mail::to($receipt->client->email)->send(new ReceiptMail($receipt, $pdf));

            return redirect()->route('receipts.index')->with('success', 'Recibo creado y enviado exitosamente');
        }

        return redirect()->route('receipts.index')->with('success', 'Recibo creado exitosamente');
    }
}
