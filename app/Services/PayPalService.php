<?php

namespace App\Services;

use App\Models\Due;
use App\Models\Payment;
use App\Models\Transaction;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Str;
use Throwable;

class PayPalService
{
    protected $paypal;

    /**
     * @throws Throwable
     */
    public function __construct()
    {
        $this->paypal = new PayPalClient;
        $this->paypal->setApiCredentials(config('paypal'));
        $this->paypal->getAccessToken();
    }

    public function createOrder($amount, $userId, $currency = 'PHP', $description = 'Payment', $userEmail = '')
    {
        try {
            $transactionRef = 'TXN_' . Str::random(10) . time();

            $orderData = [
                'intent' => 'CAPTURE',
                'application_context' => [
                    'return_url' => route('paypal.success'),
                    'cancel_url' => route('paypal.cancel'),
                    'brand_name' => config('app.name'),
                    'user_action' => 'PAY_NOW'
                ],
                'purchase_units' => [
                    [
                        'reference_id' => $transactionRef,
                        'description' => $description,
                        'amount' => [
                            'currency_code' => $currency,
                            'value' => number_format($amount, 2, '.', '')
                        ]
                    ]
                ]
            ];

            $order = $this->paypal->createOrder($orderData);

            if (isset($order['id'])) {
                // Create transaction record
                $transaction = Transaction::create([
                    'transaction_reference' => $transactionRef,
                    'external_transaction_id' => $order['id'],
                    'payment_method' => 'paypal',
                    'amount' => $amount,
                    'currency' => $currency,
                    'status' => 'pending',
                    'payer_email' => $userEmail,
                    'description' => $description,
                    'payment_details' => $order,
                    'return_url' => route('paypal.success'),
                    'cancel_url' => route('paypal.cancel')
                ]);

                return [
                    'success' => true,
                    'order_id' => $order['id'],
                    'transaction_id' => $transaction->id,
                    'transaction_reference' => $transactionRef,
                    'approval_url' => $this->getApprovalUrl($order)
                ];
            }

            return ['success' => false, 'message' => 'Failed to create PayPal order'];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function captureOrder($orderId, $userId)
    {
        try {
            $result = $this->paypal->capturePaymentOrder($orderId);

            if (isset($result['status']) && $result['status'] === 'COMPLETED') {
                // Update transaction record
                $transaction = Transaction::where('external_transaction_id', $orderId)->first();
                $due = Due::where('id', $userId)->first();


                if ($transaction) {
                    $transaction->update([
                        'status' => 'completed',
                        'payer_id' => $result['payer']['payer_id'] ?? null,
                        'payment_details' => $result,
                        'completed_at' => now()
                    ]);

                    $due->update([
                        'payment_date' => $transaction->completed_at,
                        'status' => 'paid',
                        'transaction_reference' => $transaction->id,

                    ]);

                    $payment = Payment::create([
                        'user_id' => $userId,
                        'transaction_id' => $transaction->id,
                        'payment_method' => 'paypal',
                        'identification_number' => $result['payer']['payer_id'] ?? $orderId
                    ]);


                    return [
                        'success' => true,
                        'transaction' => $transaction,
                        'paypal_result' => $result
                    ];
                }
            }

            return ['success' => false, 'message' => $result['message'] ?? 'Payment not completed'];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    private function getApprovalUrl($order)
    {
        foreach ($order['links'] as $link) {
            if ($link['rel'] === 'approve') {
                return $link['href'];
            }
        }
        return null;
    }
}
