<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\CardException;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('stripe.stripe_secret'));
    }

    public function showPaymentForm()
    {
        return view('payment.form');
    }

    public function createPaymentIntent(Request $request)
    {
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Convert to cents
                'currency' => 'php',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'user_id' => auth()->id() ?? 'guest',
                    'order_id' => $request->order_id ?? null,
                ],
            ]);

            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handlePaymentSuccess(Request $request)
    {
        $paymentIntentId = $request->payment_intent;

        // Debug: Log the payment intent ID
        \Log::info('Payment Intent ID: ' . $paymentIntentId);

        if (!$paymentIntentId) {
            return redirect()->route('payment.form')
                ->with('error', 'No payment intent ID provided.');
        }

        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            // Debug: Log the payment status
            \Log::info('Payment Status: ' . $paymentIntent->status);

            if ($paymentIntent->status === 'succeeded') {
                // Handle successful payment
                // Save to database, send confirmation email, etc.

                return view('payment.success')->with('success', 'Payment successful!');
            } else {
                return redirect()->route('payment.form')
                    ->with('error', 'Payment was not successful. Status: ' . $paymentIntent->status);
            }
        } catch (\Exception $e) {
            // Debug: Log the actual error
            \Log::error('Payment verification error: ' . $e->getMessage());

            return redirect()->route('payment.form')
                ->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }

    public function paymentSuccess()
    {
        return view('payment.success');
    }
}
