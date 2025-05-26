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

    private function loadData(): void
    {
        // Replace with your actual data loading logic
        // Example:
        // $this->paidDues = Payment::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('amount');
        // $this->paidMembers = Payment::whereBetween('created_at', [$this->startDate, $this->endDate])->count();

        // Placeholder values for demonstration
        $this->paidDues = 0;
        $this->unpaidDues = 0;
        $this->totalDues = 0;
        $this->paidMembers = 0;
        $this->unpaidMembers = 0;
        $this->totalMembers = 0;
    }

    public function render()
    {
        return view('livewire.dashboard.admin-dashboard');
    }
}
