<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class AdminDashboard extends Component
{
    public $startDate;
    public $endDate;
    public $paidDues = 0;
    public $unpaidDues = 0;
    public $totalDues = 0;
    public $paidMembers = 0;
    public $unpaidMembers = 0;
    public $totalMembers = 0;

    public function mount(): void
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
        $this->loadData();
    }

    public function filterByDate(): void
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $this->loadData();
    }

    public function updatedStartDate()
    {
        $this->dispatch('dataUpdated');
    }

    public function updatedEndDate()
    {
        $this->dispatch('dataUpdated');
    }

    private function loadData(): void
    {
        // Replace with your actual data loading logic
        // Example:
        // $this->paidDues = Payment::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('amount');
        // $this->paidMembers = Payment::whereBetween('created_at', [$this->startDate, $this->endDate])->count();

        // Placeholder values for demonstration
        $this->paidDues = 10;
        $this->unpaidDues = 100;
        $this->totalDues = 1000;
        $this->paidMembers = 1;
        $this->unpaidMembers = 9;
        $this->totalMembers = 10;
    }

    public function render()
    {
        return view('livewire.dashboard.admin-dashboard');
    }
}
