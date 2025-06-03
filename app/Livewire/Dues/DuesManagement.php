<?php

namespace App\Livewire\Dues;

use App\Exports\PaymentExport;
use App\Models\Due;
use App\Models\Payment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DuesManagement extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $statusFilter = '';
    public $showViewModal = false;
    public $member_id;
    public $dueDetails = [];

    public $payment_date;
    public $updated_at;

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
        $dues = Due::query()
            ->with(['member' => function ($query) {
                $query->select('id', 'first_name', 'family_name', 'middle_name', 'email', 'prc_registration_number');
            }])

            ->where(function ($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->where('id', 'like', $searchTerm)
                    ->orWhere('transaction_reference', 'like', $searchTerm)
                    ->orWhereHas('member', function ($q) use ($searchTerm) {
                        $q->where('first_name', 'like', $searchTerm)
                            ->orWhere('family_name', 'like', $searchTerm)
                            ->orWhere('email', 'like', $searchTerm)
                            ->orWhere('prc_registration_number', 'like', $searchTerm)
                            ->orWhereRaw("CONCAT(first_name, ' ', family_name) LIKE ?", [$searchTerm]);
                    });
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.dues.dues-management', compact('dues'));
    }

    public function openViewModal($id): void
    {
        $this->dueDetails = Due::with(['member', 'fiscalYear'])->findOrFail($id)->toArray();
        $this->showViewModal = true;
    }


    public function closeModal(): void
    {
        $this->showViewModal = false;
        $this->resetForm();
    }


    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new PaymentExport, 'dues.xlsx');
    }

    public function resetForm(): void
    {
        $this->resetPage();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }
}
