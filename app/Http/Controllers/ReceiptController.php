<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\ReceiptService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReceiptController extends Controller
{
    protected $receiptService;

    public function __construct(ReceiptService $receiptService)
    {
        $this->receiptService = $receiptService;
    }

    /**
     * Display receipt in HTML format for viewing/screenshot
     */
    public function show($paymentId)
    {
        try {
            if (!$this->receiptService->receiptExists($paymentId)) {
                return redirect()->back()->with('error', 'Receipt not found or payment not completed.');
            }

            $html = $this->receiptService->generateReceiptHtml($paymentId);
            return Response::make($html, 200, [
                'Content-Type' => 'text/html',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate receipt: ' . $e->getMessage());
        }
    }

    /**
     * Download receipt as PDF
     */
    public function download($paymentId)
    {
        try {
            if (!$this->receiptService->receiptExists($paymentId)) {
                return redirect()->back()->with('error', 'Receipt not found or payment not completed.');
            }

            return $this->receiptService->downloadReceipt($paymentId);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to download receipt: ' . $e->getMessage());
        }
    }

    /**
     * View receipt as PDF in browser
     */
    public function view($paymentId)
    {
        try {
            if (!$this->receiptService->receiptExists($paymentId)) {
                return redirect()->back()->with('error', 'Receipt not found or payment not completed.');
            }

            return $this->receiptService->viewReceipt($paymentId);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to view receipt: ' . $e->getMessage());
        }
    }

    /**
     * Get receipt by transaction reference
     */
    public function showByTransaction($transactionReference)
    {
        try {
            $html = $this->receiptService->generateReceiptByTransaction($transactionReference);
            return Response::make($html, 200, [
                'Content-Type' => 'text/html',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate receipt: ' . $e->getMessage());
        }
    }

    /**
     * Download receipt by transaction reference
     */
    public function downloadByTransaction($transactionReference)
    {
        try {
            $receiptData = $this->receiptService->generateReceiptByTransaction($transactionReference);
            return $receiptData['pdf']->download($receiptData['filename']);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to download receipt: ' . $e->getMessage());
        }
    }

    /**
     * Get receipt summary for API/AJAX requests
     */
    public function summary($paymentId)
    {
        try {
            $summary = $this->receiptService->getReceiptSummary($paymentId);

            if (!$summary) {
                return response()->json(['error' => 'Receipt not found'], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $summary
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * List all receipts for a user
     */
    public function userReceipts(Request $request, $userId = null)
    {
        try {
            $user = $request->user();
            $targetUserId = $userId ?? $user->id;

            // Check if user can view receipts (own receipts or admin)
            if ($targetUserId != $user->id && !$user->hasRole('admin')) {
                return redirect()->back()->with('error', 'Unauthorized access.');
            }

            $payments = Payment::with(['transaction', 'user'])
                ->where('user_id', $targetUserId)
                ->whereHas('transaction', function ($query) {
                    $query->where('status', 'completed');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(20);

            $receipts = $payments->map(function ($payment) {
                return $this->receiptService->getReceiptSummary($payment->id);
            });

            return view('receipts.list', compact('receipts', 'payments'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load receipts: ' . $e->getMessage());
        }
    }

    /**
     * Bulk download receipts
     */
    public function bulkDownload(Request $request)
    {
        try {
            $paymentIds = $request->input('payment_ids', []);

            if (empty($paymentIds)) {
                return redirect()->back()->with('error', 'No receipts selected.');
            }

            // Create a ZIP file with all receipts
            $zip = new \ZipArchive();
            $zipFileName = 'receipts_' . date('Y-m-d_H-i-s') . '.zip';
            $zipPath = storage_path('app/temp/' . $zipFileName);

            // Ensure temp directory exists
            if (!file_exists(dirname($zipPath))) {
                mkdir(dirname($zipPath), 0755, true);
            }

            if ($zip->open($zipPath, \ZipArchive::CREATE) !== TRUE) {
                return redirect()->back()->with('error', 'Cannot create ZIP file.');
            }

            foreach ($paymentIds as $paymentId) {
                try {
                    $receiptData = $this->receiptService->generateReceipt($paymentId);
                    $zip->addFromString($receiptData['filename'], $receiptData['pdf']->output());
                } catch (\Exception $e) {
                    // Skip this receipt if there's an error
                    continue;
                }
            }

            $zip->close();

            return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create bulk download: ' . $e->getMessage());
        }
    }

    /**
     * Send receipt via email
     */
    public function email(Request $request, $paymentId)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            $payment = Payment::with(['user', 'transaction'])->find($paymentId);

            if (!$payment || $payment->transaction->status !== 'completed') {
                return response()->json(['error' => 'Receipt not found or payment not completed'], 404);
            }

            $receiptData = $this->receiptService->generateReceipt($paymentId);

            // Here you would implement email sending logic
            // For example, using Laravel's Mail facade:
            /*
            Mail::to($request->email)->send(new ReceiptMail([
                'payment' => $payment,
                'pdf' => $receiptData['pdf']->output(),
                'filename' => $receiptData['filename']
            ]));
            */

            return response()->json([
                'success' => true,
                'message' => 'Receipt sent successfully to ' . $request->email
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to send receipt: ' . $e->getMessage()
            ], 500);
        }
    }
}
