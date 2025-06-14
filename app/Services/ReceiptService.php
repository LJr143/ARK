<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Due;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;

class ReceiptService
{
    /**
     * Generate receipt for a payment
     */
    public function generateReceipt($paymentId)
    {
        $payment = Payment::with(['user', 'transaction'])->find($paymentId);

        if (!$payment) {
            throw new \Exception('Payment not found');
        }

        $transaction = $payment->transaction;
        $user = $payment->user;

        // Get dues paid in this transaction
        $dues = Due::where('transaction_reference', $transaction->transaction_reference)->get();

        $receiptData = [
            'receipt_number' => $this->generateReceiptNumber($transaction),
            'payment' => $payment,
            'transaction' => $transaction,
            'user' => $user,
            'dues' => $dues,
            'generated_at' => now(),
            'company_info' => $this->getCompanyInfo(),
        ];

        return $this->createPdfReceipt($receiptData);
    }

    /**
     * Generate receipt by transaction reference
     */
    public function generateReceiptByTransaction($transactionReference)
    {
        $transaction = Transaction::where('transaction_reference', $transactionReference)->first();

        if (!$transaction) {
            throw new \Exception('Transaction not found');
        }

        $payment = Payment::where('transaction_id', $transaction->id)->with('user')->first();

        if (!$payment) {
            throw new \Exception('Payment record not found');
        }

        return $this->generateReceipt($payment->id);
    }

    /**
     * Create PDF receipt
     */
    private function createPdfReceipt($data)
    {
        $pdf = Pdf::loadView('receipts.payment-receipt', $data);
        $pdf->setPaper('A4', 'portrait');

        $filename = 'receipt-' . $data['receipt_number'] . '.pdf';

        return [
            'pdf' => $pdf,
            'filename' => $filename,
            'data' => $data
        ];
    }

    /**
     * Generate unique receipt number
     */
    private function generateReceiptNumber($transaction)
    {
        $prefix = 'REC';
        $date = Carbon::parse($transaction->completed_at ?? $transaction->created_at)->format('Ymd');
        $sequence = str_pad($transaction->id, 4, '0', STR_PAD_LEFT);

        return $prefix . '-' . $date . '-' . $sequence;
    }

    /**
     * Get company information for receipt
     */
    private function getCompanyInfo()
    {
        return [
            'name' => config('app.name', 'Your Organization'),
            'address' => config('receipt.company_address', '123 Main Street, City, Country'),
            'phone' => config('receipt.company_phone', '+1234567890'),
            'email' => config('receipt.company_email', 'info@company.com'),
            'website' => config('app.url', 'www.company.com'),
            'logo' => config('receipt.company_logo', null), // Path to logo
        ];
    }

    /**
     * Save receipt to storage and return path
     */
    public function saveReceipt($paymentId, $disk = 'public')
    {
        $receiptData = $this->generateReceipt($paymentId);
        $pdf = $receiptData['pdf'];
        $filename = $receiptData['filename'];

        $path = 'receipts/' . date('Y/m/') . $filename;
        Storage::disk($disk)->put($path, $pdf->output());

        return Storage::disk($disk)->url($path);
    }

    /**
     * Stream receipt for download
     */
    public function downloadReceipt($paymentId)
    {
        $receiptData = $this->generateReceipt($paymentId);
        return $receiptData['pdf']->download($receiptData['filename']);
    }

    /**
     * Stream receipt for inline viewing
     */
    public function viewReceipt($paymentId)
    {
        $receiptData = $this->generateReceipt($paymentId);
        return $receiptData['pdf']->stream($receiptData['filename']);
    }

    /**
     * Generate receipt HTML for preview/screenshot
     */
    public function generateReceiptHtml($paymentId)
    {
        $payment = Payment::with(['user', 'transaction'])->find($paymentId);

        if (!$payment) {
            throw new \Exception('Payment not found');
        }

        $transaction = $payment->transaction;
        $user = $payment->user;
        $dues = Due::where('transaction_reference', $transaction->transaction_reference)->get();

        $receiptData = [
            'receipt_number' => $this->generateReceiptNumber($transaction),
            'payment' => $payment,
            'transaction' => $transaction,
            'user' => $user,
            'dues' => $dues,
            'generated_at' => now(),
            'company_info' => $this->getCompanyInfo(),
        ];

        return view('receipts.payment-receipt-html', $receiptData)->render();
    }

    /**
     * Check if receipt exists for a payment
     */
    public function receiptExists($paymentId)
    {
        $payment = Payment::find($paymentId);
        return $payment && $payment->transaction && $payment->transaction->status === 'completed';
    }

    /**
     * Get receipt summary for listing
     */
    public function getReceiptSummary($paymentId)
    {
        $payment = Payment::with(['user', 'transaction'])->find($paymentId);

        if (!$payment) {
            return null;
        }

        $transaction = $payment->transaction;
        $dues = Due::where('transaction_reference', $transaction->transaction_reference)->get();

        return [
            'receipt_number' => $this->generateReceiptNumber($transaction),
            'payment_id' => $payment->id,
            'transaction_reference' => $transaction->transaction_reference,
            'amount' => $transaction->amount,
            'currency' => $transaction->currency,
            'payment_method' => $transaction->payment_method,
            'payer_name' => $payment->user->first_name . ' ' . $payment->user->family_name,
            'payer_email' => $payment->user->email,
            'payment_date' => $transaction->completed_at ?? $transaction->created_at,
            'dues_count' => $dues->count(),
            'status' => $transaction->status,
        ];
    }
}
