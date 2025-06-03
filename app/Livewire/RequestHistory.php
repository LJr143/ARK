<?php

namespace App\Livewire;

use App\Models\ComputationRequest;
use App\Models\Due;
use App\Services\PayPalService;
use Livewire\Component;
use Livewire\WithPagination;

class RequestHistory extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $showDetails = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function render()
    {
        $requests = ComputationRequest::with(['replies' => function($query) {
            $query->with('admin')->orderBy('replied_at', 'desc');
        }])
            ->where('member_id', auth()->id())
            ->when($this->search, function($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->where(function($q) use ($searchTerm) {
                    $q->where('reference_number', 'like', $searchTerm)
                        ->orWhere('status', 'like', $searchTerm)
                        ->orWhere('notes', 'like', $searchTerm);
                });
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.request-history', compact('requests'));
    }

    public function toggleDetails($requestId): void
    {
        if (isset($this->showDetails[$requestId])) {
            unset($this->showDetails[$requestId]);
        } else {
            $this->showDetails[$requestId] = true;
        }
    }

    public function initiatePaypalPayment($dueIds, $totalAmount, $description): array
    {
        try {
            // Validate due IDs
            $dues = Due::whereIn('id', $dueIds)
                ->where('member_id', auth()->id())
                ->where('status', 'unpaid')
                ->get();

            if ($dues->isEmpty()) {
                return ['success' => false, 'message' => 'No valid unpaid dues selected.'];
            }

            // Verify total amount
            $calculatedTotal = $dues->sum(function ($due) {
                return $due->amount + ($due->penalty_amount ?? 0);
            });


            if (abs($calculatedTotal - $totalAmount) > 0.00001) {
                return ['success' => false, 'message' => 'Total amount mismatch. Please try again.'];
            }

            $user = auth()->user();
            $paypalService = app(PayPalService::class);

            $result = $paypalService->createOrder(
                $totalAmount,
                $user->id,
                'PHP',
                $description,
                $user->email
            );

            if ($result['success']) {
                // Store payment data in session
                session()->put([
                    'pending_payment_due_ids' => array_map('intval', $dueIds),
                    'pending_payment_transaction_id' => $result['transaction_id'],
                ]);

                return [
                    'success' => true,
                    'approval_url' => $result['approval_url'],
                ];
            }

            return ['success' => false, 'message' => $result['message']];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Failed to initiate payment: ' . $e->getMessage()];
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->resetPage();
    }
}
