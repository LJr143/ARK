<?php

namespace App\Livewire\Dues;

use App\Models\Due;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use App\Services\FiscalYearService;
use App\Services\PayPalService;
use App\Services\ReceiptService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class ComputeDuesPayment extends Component
{
    public $search = '';
    public $members = [];
    public $selectedMember = null;
    public $unpaidComputation = null;
    public $showModal = false;

    public $recentPayment = null;

    protected $listeners = [
        'payment-completed' => 'handlePaymentCompleted'
    ];


    public function render()
    {
        if ($this->search) {
            $this->members = User::where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('family_name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('prc_registration_number', 'like', '%' . $this->search . '%')
                ->select('id', 'first_name', 'middle_name', 'family_name', 'email', 'prc_registration_number')
                ->get();
        } else {
            $this->members = [];
        }

        return view('livewire.compute-dues-payment');
    }

    /**
     * @throws Exception
     */
    public function selectMember($memberId)
    {
        $this->selectedMember = User::find($memberId);
        if (!$this->selectedMember) {
            session()->flash('error', 'Member not found.');
            return;
        }
        $this->computeUnpaidDues();
    }

    /**
     * Compute unpaid dues for the selected member.
     *
     * @throws Exception
     */
    public function computeUnpaidDues()
    {
        if (!$this->selectedMember) {
            session()->flash('error', 'No member selected.');
            return;
        }

        $this->unpaidComputation = app(FiscalYearService::class)->generateComputation(null, $this->selectedMember->id, true);

        if (!$this->unpaidComputation) {
            session()->flash('error', 'No unpaid dues found for this member.');
        }
    }

    public function initiateWalkInPayment(): void
    {
        if (!$this->unpaidComputation || $this->unpaidComputation['total_unpaid'] <= 0) {
            session()->flash('error', 'No unpaid dues to process.');
            return;
        }

        try {
            DB::beginTransaction();

            $now = now();
            $transactionReference = 'WALKIN-' . Str::uuid();
            $duesIds = array_column($this->unpaidComputation['dues'], 'id');

            // Create a Transaction record
            $transaction = Transaction::create([
                'transaction_reference' => $transactionReference,
                'payment_method' => 'walk-in',
                'amount' => $this->unpaidComputation['total_unpaid'],
                'currency' => 'PHP',
                'status' => 'completed',
                'payer_id' => $this->selectedMember->id,
                'payer_email' => $this->selectedMember->email,
                'description' => 'Walk-in payment for membership dues: ' . implode(', ', $duesIds),
                'completed_at' => $now,
            ]);

            // Update Dues with transaction_reference and status
            Due::whereIn('id', $duesIds)->update([
                'status' => 'paid',
                'payment_date' => $now,
                'transaction_reference' => $transactionReference,
            ]);

            // Create a Payment record
            $payment = Payment::create([
                'user_id' => $this->selectedMember->id,
                'transaction_id' => $transaction->id,
                'payment_method' => 'walk-in',
                'identification_number' => $this->selectedMember->id,
            ]);

            DB::commit();

            // Set the recent payment and handle success directly
            $this->recentPayment = $payment->load(['transaction', 'user']);

            // Call the success handler directly instead of dispatching an event
            $this->handlePaymentSuccess($payment->id);

            session()->flash('message', 'Walk-in payment recorded successfully.');
            $this->resetComputation();

        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to process walk-in payment: ' . $e->getMessage());
        }
    }

    public function initiatePayPalPayment(): void
    {
        if (!$this->unpaidComputation || $this->unpaidComputation['total_unpaid'] <= 0) {
            session()->flash('error', 'No unpaid dues to process.');
            return;
        }

        try {
            $amount = $this->unpaidComputation['total_unpaid'];
            $userId = $this->selectedMember->id;
            $userEmail = $this->selectedMember->email;

            $response = app(PayPalService::class)->createOrder(
                $amount,
                $userId,
                'PHP',
                'Membership Dues Payment',
                $userEmail
            );

            if ($response['success'] && !empty($response['approval_url'])) {
                session()->put([
                    'pending_payment_due_ids' => array_map('intval', array_column($this->unpaidComputation['dues'], 'id')),
                    'pending_payment_transaction_id' => $response['transaction_id'],
                ]);

                $this->dispatch('redirect-to-paypal', $response['approval_url']);
                return;
            }

            session()->flash('error', $response['message'] ?? 'Something went wrong.');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to initiate PayPal payment: ' . $e->getMessage());
        }
    }

    public function downloadReceipt($paymentId)
    {
        $payment = Payment::with(['transaction', 'user'])->findOrFail($paymentId);
        $receiptService = app(ReceiptService::class);
        $receipt = $receiptService->generateReceipt($payment);

        return response()->download(storage_path("app/{$receipt['filename']}"))->deleteFileAfterSend();
    }

    public function viewReceipt($paymentId)
    {
        $payment = Payment::with(['transaction', 'user'])->findOrFail($paymentId);
        $receiptService = app(ReceiptService::class);
        $receipt = $receiptService->generateReceipt($payment);

        return response()->file(storage_path("app/{$receipt['filename']}"));
    }


    public function resetModal()
    {
        $this->reset(['search', 'members', 'selectedMember', 'unpaidComputation', 'showModal']);
    }

    private function resetComputation()
    {
        $this->unpaidComputation = null;
        $this->selectedMember = null;
        $this->search = '';
        $this->members = [];
    }

    /**
     * Handle payment success callback
     */
    public function handlePaymentSuccess($paymentId): void
    {
        try {
            // Debug logging
            \Log::info('handlePaymentSuccess called', [
                'paymentId' => $paymentId,
                'type' => gettype($paymentId),
                'is_array' => is_array($paymentId)
            ]);

            // Handle different parameter formats
            if (is_array($paymentId)) {
                $actualPaymentId = $paymentId['payment_id'] ?? $paymentId['paymentId'] ?? $paymentId[0] ?? null;
            } else {
                $actualPaymentId = $paymentId;
            }

            if (!$actualPaymentId) {
                \Log::error('No valid payment ID found', ['original' => $paymentId]);
                session()->flash('error', 'Invalid payment ID provided.');
                return;
            }

            $payment = Payment::with(['transaction', 'user'])->find($actualPaymentId);

            if (!$payment) {
                \Log::error('Payment not found in database', ['paymentId' => $actualPaymentId]);
                session()->flash('error', 'Payment not found.');
                return;
            }

            $this->recentPayment = $payment;
            session()->flash('message', 'Payment completed successfully.');

            // Generate receipt
            $receiptService = app(ReceiptService::class);
            $receipt = $receiptService->generateReceipt($payment);

            // Instead of dispatching, just set a property to show the receipt section
            $this->dispatch('open-receipt', $receipt['filename']);

        } catch (\Exception $e) {
            \Log::error('Error in handlePaymentSuccess', [
                'error' => $e->getMessage(),
                'paymentId' => $paymentId
            ]);
            session()->flash('error', 'Error processing payment success: ' . $e->getMessage());
        }
    }
    public function handlePaymentCompleted($data): void
    {
        \Log::info('handlePaymentCompleted called', ['data' => $data]);

        if (is_array($data)) {
            $paymentId = $data['payment_id'] ?? $data['paymentId'] ?? null;
        } else {
            $paymentId = $data;
        }

        if ($paymentId) {
            $this->handlePaymentSuccess($paymentId);
        }
    }
    public function debugPayment(): void
    {
        if ($this->recentPayment) {
            \Log::info('Recent payment exists', [
                'id' => $this->recentPayment->id,
                'user_id' => $this->recentPayment->user_id,
                'transaction_id' => $this->recentPayment->transaction_id
            ]);
        } else {
            \Log::info('No recent payment found');
        }

        // Also check the last payment in the database
        $lastPayment = Payment::latest()->first();
        if ($lastPayment) {
            \Log::info('Last payment in DB', [
                'id' => $lastPayment->id,
                'created_at' => $lastPayment->created_at
            ]);
        }
    }


    /**
     * Get recent payment details for display
     */
    public function getRecentPaymentDetails(): ?array
    {
        if (!$this->recentPayment) {
            return null;
        }

        return [
            'id' => $this->recentPayment->id,
            'amount' => $this->recentPayment->transaction->amount ?? 0,
            'method' => $this->recentPayment->payment_method,
            'date' => $this->recentPayment->created_at,
            'reference' => $this->recentPayment->transaction->transaction_reference ?? null,
        ];
    }
}
