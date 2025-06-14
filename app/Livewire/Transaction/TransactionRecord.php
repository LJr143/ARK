<?php

namespace App\Livewire\Transaction;

use AllowDynamicProperties;
use App\Exports\MembersExport;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class TransactionRecord extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $statusFilter = '';
    public $showModal = false;
    public $showViewModal = false;
    public $payment_date;
    public $updated_at;
    public $transactionDetails = [];
    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function mount(): void
    {
        $this->payment_date = now()->format('Y-m-d H:i:s');
    }

    public function render()
    {
        $transactions = Transaction::query()
            ->when($this->search, function($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->where(function($q) use ($searchTerm) {
                    $q->where('id', 'like', $searchTerm)
                        ->orWhere('transaction_reference', 'like', $searchTerm)
                        ->orWhere('external_transaction_id', 'like', $searchTerm)
                        ->orWhere('payment_method', 'like', $searchTerm)
                        ->orWhere('amount', 'like', $searchTerm)
                        ->orWhere('status', 'like', $searchTerm);
                });
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.transaction.transaction-record', compact('transactions'));
    }


    public function openViewModal($id): void
    {
        $this->transactionDetails = Transaction::find($id)->toArray();
        $this->transactionDetails['payment_date'] = $this->transactionDetails->dues->payment_date ?? '';

        $this->showViewModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->showViewModal = false;
    }

    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new MembersExport, 'members.xlsx');
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
