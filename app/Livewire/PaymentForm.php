<?php

namespace App\Livewire;

use App\Services\PayPalService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentForm extends Component
{
    public $amount = '';
    public $description = '';
    public $email = '';
    public $isProcessing = false;
    public $errorMessage = '';

    protected $rules = [
        'amount' => 'required|numeric|min:1',
        'description' => 'required|string|max:255',
        'email' => 'required|email'
    ];

    public function mount(): void
    {
        // Pre-fill email if user is authenticated
        if (Auth::check()) {
            $this->email = Auth::user()->email;
        }
    }

    public function processPayment()
    {
        $this->validate();

        $this->isProcessing = true;
        $this->errorMessage = '';

        try {
            // Use authenticated user ID or null for guest
            $userId = Auth::id() ?? null;

            $paypalService = new PayPalService();
            $result = $paypalService->createOrder(
                $this->amount,
                $userId,
                'PHP',
                $this->description,
                $this->email
            );

            if ($result['success']) {
                // Store payment info in session for later reference
                session([
                    'paypal_transaction_id' => $result['transaction_id'],
                    'paypal_order_id' => $result['order_id'],
                    'paypal_user_id' => $userId
                ]);

                // Redirect to PayPal
                return redirect($result['approval_url']);
            } else {
                $this->errorMessage = $result['message'];
            }

        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred: ' . $e->getMessage();
        }

        $this->isProcessing = false;
    }

    public function render()
    {
        return view('livewire.payment-form');
    }
}
