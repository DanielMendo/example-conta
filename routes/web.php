<?php

use App\Http\Controllers\PDFMaker;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyReceipt;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceiptController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/receipts', [ReceiptController::class, 'index'])->name('receipts.index');
Route::post('/receipts', [ReceiptController::class, 'store'])->name('receipts.store');
Route::get('/receipts/create', [ReceiptController::class, 'create'])->name('receipts.create');
Route::get('/receipts/{receipt_number}', [ReceiptController::class, 'show'])->name('receipts.show');

Route::get('/download-pdf/{id}', [PDFMaker::class, 'downloadPDF'])->name('pdf.download');  
Route::get('/send-pdf/{id}', [PDFMaker::class, 'sendPDF'])->name('pdf.send'); 

Route::get('/receipts/verify/{receipt_number}', [VerifyReceipt::class, '__invoke'])->name('receipts.verify');


require __DIR__.'/auth.php';
