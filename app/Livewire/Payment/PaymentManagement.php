<?php

namespace App\Livewire\Payment;

use App\Exports\MembersExport;
use App\Imports\MembersImport;
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
    public $showModal = false;
    public $showViewModal = false;
    public $editMode = false;
    public $member_id;

    public $first_name = '';
    public $family_name = '';
    public $middle_name = '';
    public $prc_registration_number = '';
    public $email = '';
    public $mobile = '';
    public $status;
    public $current_chapter;
    public $payment_date;
    public $updated_at;

    public function mount(): void
    {
        $this->payment_date = now()->format('Y-m-d H:i:s');
    }

    public function render()
    {
        $members = User::where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('middle_name', 'like', '%' . $this->search . '%')
            ->orWhere('family_name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('prc_registration_number', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.payment.payment-management', compact('members'));
    }

    public function openModal(): void
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function openEditModal($id): void
    {
        $this->extracted($id);

        $this->editMode = true;
        $this->showModal = true;
    }

    public function openViewModal($id): void
    {
        $this->extracted($id);

        $this->showViewModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->showViewModal = false;
        $this->resetForm();
    }

    public function save(): void
    {
        $rules = $this->rules;

        if ($this->editMode) {
            $rules['email'] = 'required|email|unique:users,email,' . $this->member_id;
            $rules['prc_registration_number'] = 'required|string|max:50|unique:users,prc_registration_number,' . $this->member_id;
        }

        $this->validate($rules);

        $data = [
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'family_name' => $this->family_name,
            'prc_registration_number' => $this->prc_registration_number,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'status' => $this->status,
            'current_chapter' => $this->current_chapter,
        ];

        if ($this->editMode) {
            User::findOrFail($this->member_id)->update($data);
            session()->flash('message', 'Member updated successfully!');
        } else {
            User::create($data);
            session()->flash('message', 'Member added successfully!');
        }

        $this->closeModal();
    }

    public function delete($id): void
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Member deleted successfully!');
    }

    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new MembersExport, 'members.xlsx');
    }

    public function resetForm(): void
    {
        $this->first_name = '';
        $this->middle_name = '';
        $this->family_name = '';
        $this->prc_registration_number = '';
        $this->email = '';
        $this->mobile = '';
        $this->status = '';
        $this->current_chapter = '';
        $this->payment_date = now()->format('Y-m-d H:i:s');
        $this->member_id = null;
        $this->resetValidation();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * @param $id
     * @return void
     */
    public function extracted($id): void
    {
        $member = User::findOrFail($id);
        $this->member_id = $member->id;
        $this->first_name = $member->first_name;
        $this->middle_name = $member->middle_name;
        $this->family_name = $member->family_name;
        $this->prc_registration_number = $member->prc_registration_number;
        $this->email = $member->email;
        $this->mobile = $member->mobile;
        $this->status = $member->status;
        $this->current_chapter = $member->current_chapter;
        $this->payment_date = $member->created_at->format('Y-m-d H:i:s');
        $this->updated_at = $member->updated_at->format('Y-m-d H:i:s');
    }

}
