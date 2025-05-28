<?php

namespace App\Livewire\Reminder;

use Livewire\Component;
use App\Models\Reminder;
use Livewire\WithPagination;

class ReminderIndex extends Component
{
    use WithPagination;

    public $filter = 'all_reminders';
    public $search = '';
    public $perPage = 10;

    protected $queryString = [
        'filter' => ['except' => 'all_reminders'],
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount(): void
    {
        // Initialize component - you can add any setup logic here
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function fetchReminders()
    {
        $query = Reminder::query()
            ->orderBy('created_at', 'desc');

        // Enhanced search functionality
        if ($this->search) {
            $query->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('start_datetime', 'like', '%' . $this->search . '%')
                    ->orWhere('end_datetime', 'like', '%' . $this->search . '%');
            });
        }

        // Status filter
        if ($this->filter === 'upcoming_reminders') {
            $query->where('status', 'upcoming');
        } elseif ($this->filter === 'ended_reminders') {
            $query->where('status', 'ended');
        } elseif ($this->filter === 'archived_reminders') {
            $query->where('status', 'archived');
        }

        return $this->perPage === 'all'
            ? $query->get()
            : $query->paginate($this->perPage);
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.reminder.reminder-index', [
            'reminders' => $this->fetchReminders(),
        ]);
    }
}
