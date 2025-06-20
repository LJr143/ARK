<?php
namespace App\Services;

use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ReceiptService
{
    public function generateReceipt(Payment $payment): array
    {
        $data = [
            'payment' => $payment,
            'transaction' => $payment->transaction,
            'user' => $payment->user,
            'date' => now()->format('F j, Y'),
            'receipt_number' => 'RCPT-' . strtoupper(uniqid()),
        ];

        $pdf = Pdf::loadView('receipts.payment', $data);

        // Save to storage
        $filename = "receipts/{$data['receipt_number']}.pdf";
        Storage::put($filename, $pdf->output());

        return [
            'download_url' => route('receipt.download', $filename),
            'print_url' => route('receipt.view', $filename),
            'filename' => $filename
        ];
    }
}
