<?php
namespace App\Services;

use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ReceiptService
{
    public function generateReceipt(Payment $payment): array
    {
        try {
            $receiptNumber = 'RCPT-' . strtoupper(uniqid());

            $data = [
                'payment' => $payment,
                'transaction' => $payment->transaction,
                'user' => $payment->user,
                'date' => now()->format('F j, Y'),
                'receipt_number' => $receiptNumber,
            ];

            Log::info('Generating receipt', [
                'payment_id' => $payment->id,
                'receipt_number' => $receiptNumber
            ]);

            // Generate PDF
            $pdf = Pdf::loadView('receipts.payment', $data);

            // Ensure the receipts directory exists
            $receiptsDir = 'receipts';
            if (!Storage::exists($receiptsDir)) {
                Storage::makeDirectory($receiptsDir);
                Log::info('Created receipts directory');
            }

            // Save to storage with proper path
            $filename = "{$receiptsDir}/{$receiptNumber}.pdf";
            $pdfContent = $pdf->output();

            // Save the file
            $saved = Storage::put($filename, $pdfContent);

            if (!$saved) {
                Log::error('Failed to save PDF file', ['filename' => $filename]);
                throw new \Exception('Failed to save receipt PDF');
            }

            // Verify the file exists and get its size
            if (!Storage::exists($filename)) {
                Log::error('PDF file was not created', ['filename' => $filename]);
                throw new \Exception('Receipt PDF was not created');
            }

            $fileSize = Storage::size($filename);
            Log::info('Receipt PDF saved successfully', [
                'filename' => $filename,
                'size' => $fileSize,
                'full_path' => Storage::path($filename)
            ]);

            return [
                'download_url' => route('receipt.download', ['filename' => $receiptNumber]),
                'print_url' => route('receipt.view', ['filename' => $receiptNumber]),
                'filename' => $filename,
                'receipt_number' => $receiptNumber
            ];

        } catch (\Exception $e) {
            Log::error('Error generating receipt', [
                'payment_id' => $payment->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
