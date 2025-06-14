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

    protected $receiptService;

    public function boot()
    {
        $this->receiptService = app(ReceiptService::class);
    }

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
            \DB::beginTransaction();

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

            \DB::commit();

            $this->recentPayment = $payment->load(['transaction', 'user']);

            session()->flash('message', 'Walk-in payment recorded successfully.');
            $this->resetComputation();
        } catch (Exception $e) {
            \DB::rollBack();
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

    public function viewReceipt($paymentId = null)
    {
        try {
            $paymentId = $paymentId ?? ($this->recentPayment ? $this->recentPayment->id : null);

            if (!$paymentId) {
                session()->flash('error', 'No payment found to generate receipt.');
                return;
            }

            // Open receipt in new window/tab
            $this->dispatch('open-receipt', route('receipt.show', $paymentId));

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to generate receipt: ' . $e->getMessage());
        }
    }

    /**
     * Download receipt as PDF
     */
    public function downloadReceipt($paymentId = null)
    {
        try {
            $paymentId = $paymentId ?? ($this->recentPayment ? $this->recentPayment->id : null);

            if (!$paymentId) {
                session()->flash('error', 'No payment found to download receipt.');
                return;
            }

            // Redirect to download route
            return redirect()->route('receipt.download', $paymentId);

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to download receipt: ' . $e->getMessage());
        }
    }

    /**
     * Print receipt
     */
    public function printReceipt($paymentId = null)
    {
        try {
            $paymentId = $paymentId ?? ($this->recentPayment ? $this->recentPayment->id : null);

            if (!$paymentId) {
                session()->flash('error', 'No payment found to print receipt.');
                return;
            }

            // Generate print-friendly HTML and dispatch event to open and print
            $printUrl = route('receipt.print', $paymentId);
            $this->dispatch('open-print-receipt', ['url' => $printUrl]);

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to print receipt: ' . $e->getMessage());
        }
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
            $payment = Payment::with(['transaction', 'user'])->find($paymentId);

            if (!$payment) {
                session()->flash('error', 'Payment not found.');
                return;
            }

            $this->recentPayment = $payment;
            session()->flash('message', 'Payment completed successfully.');

            // Dispatch event to show receipt options
            $this->dispatch('payment-completed', [
                'payment_id' => $payment->id,
                'payment_method' => $payment->payment_method
            ]);

        } catch (\Exception $e) {
            session()->flash('error', 'Error processing payment success: ' . $e->getMessage());
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
