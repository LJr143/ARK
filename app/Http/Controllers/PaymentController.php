<?php

namespace App\Http\Controllers;

use App\Models\ComputationRequestReply;
use App\Services\PayPalService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Due;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        try {
            $orderId = $request->input('token');
            $transactionId = Session::get('pending_payment_transaction_id');
            $dueIds = Session::get('pending_payment_due_ids', []);

            if (!$orderId || !$transactionId || empty($dueIds)) {
                return redirect()->route('request.history')
                    ->with('error', 'Invalid payment session. Please contact support.');
            }

            DB::transaction(function () use ($orderId, $transactionId, $dueIds) {
                $paypalService = new PayPalService();
                $result = $paypalService->captureOrder($orderId, auth()->id());

                if ($result['success']) {
                    // Get the transaction to get the transaction_reference
                    $transaction = Transaction::find($transactionId);

                    if (!$transaction) {
                        throw new \Exception('Transaction record not found');
                    }

                    // Get the computation reply
                    $reply = ComputationRequestReply::whereHas('computationRequest', function($q) {
                        $q->where('member_id', auth()->id());
                    })
                        ->whereJsonContains('computation_data->dues', function($query) use ($dueIds) {
                            $query->whereIn('id', $dueIds);
                        })
                        ->latest()
                        ->first();

                    // Update dues with transaction reference and mark as paid
                    Due::whereIn('id', $dueIds)
                        ->where('member_id', auth()->id())
                        ->update([
                            'status' => 'paid',
                            'payment_date' => now(),
                            'transaction_reference' => $transaction->transaction_reference
                        ]);

                    // Update computation_data if reply exists
                    if ($reply && $reply->computation_data) {
                        $computationData = $reply->computation_data;

                        // Update status and transaction reference for each due in computation_data
                        foreach ($computationData['dues'] as &$due) {
                            if (in_array($due['id'], $dueIds)) {
                                $due['status'] = 'paid';
                                $due['transaction_reference'] = $transaction->transaction_reference;
                            }
                        }

                        $reply->update(['computation_data' => $computationData]);
                    }

                    // Clear session
                    Session::forget(['pending_payment_due_ids', 'pending_payment_transaction_id']);
                } else {
                    throw new \Exception($result['message'] ?? 'Payment capture failed');
                }
            });

            return redirect()->route('request.history')
                ->with('success', 'Payment completed successfully!');

        } catch (\Exception $e) {
            return redirect()->route('request.history')
                ->with('error', 'Payment processing error: ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        Session::forget(['pending_payment_due_ids', 'pending_payment_transaction_id']);
        return redirect()->route('request.history')
            ->with('info', 'Payment was cancelled.');
    }
}
