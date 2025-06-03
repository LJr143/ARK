<?php

namespace App\Livewire\Request;

use App\Models\ComputationRequest;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ComputationalRequest extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showModal = false;
    public $showViewModal = false;
    public $member_id;

    public function mount(): void
    {

    }

    public function render()
    {
        $requests = ComputationRequest::query()
            ->with(['member' => function($query) {
                $query->select('id', 'first_name', 'family_name', 'email', 'prc_registration_number');
            }])
            ->where(function($query) {
                $searchTerm = '%' . $this->search . '%';

                $query->where('id', 'like', $searchTerm)
                    ->orWhere('reference_number', 'like', $searchTerm)
                    ->orWhere('status', 'like', $searchTerm)
                    ->orWhereHas('member', function($q) use ($searchTerm) {
                        $q->where('first_name', 'like', $searchTerm)
                            ->orWhere('family_name', 'like', $searchTerm)
                            ->orWhere('email', 'like', $searchTerm)
                            ->orWhere('prc_registration_number', 'like', $searchTerm)
                            ->orWhereRaw("CONCAT(first_name, ' ', family_name) LIKE ?", [$searchTerm]);
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.request.computational-request', compact('requests'));
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

    public function updatingSearch(): void
    {
        $this->resetPage();
    }


}
