<?php

namespace App\Livewire\Payment;

use App\Exports\MembersExport;
use App\Exports\PaymentExport;
use App\Imports\MembersImport;
use App\Models\ComputationRequest;
use App\Models\Payment;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PaymentManagement extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $statusFilter = '';
    public $showViewModal = false;
    public $member_id;
    public $paymentDetails = [];

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
        $payments = Payment::query()
            ->with(['user' => function ($query) {
                $query->select('id', 'first_name', 'family_name', 'middle_name', 'email', 'prc_registration_number');
            }, 'transaction.dues.fiscalYear'])

            ->where(function ($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->where('id', 'like', $searchTerm)
                    ->orWhere('payment_method', 'like', $searchTerm)
                    ->orWhere('identification_number', 'like', $searchTerm)
                    ->orWhereHas('user', function ($q) use ($searchTerm) {
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

        return view('livewire.payment.payment-management', compact('payments'));
    }

    public function openViewModal($id): void
    {
        $this->paymentDetails = Payment::with(['user', 'transaction'])->findOrFail($id)->toArray();
        $this->showViewModal = true;
    }


    public function closeModal(): void
    {
        $this->showViewModal = false;
        $this->resetForm();
    }


    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new PaymentExport, 'payments.xlsx');
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
