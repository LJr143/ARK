<?php

namespace App\Livewire\Dashboard;

use AllowDynamicProperties;
use App\Models\ComputationRequest;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Support\Str;
use Livewire\Component;

#[AllowDynamicProperties] class AdminDashboard extends Component
{
    public $startDate;
    public $endDate;
    public $paidDues = 0;
    public $unpaidDues = 0;
    public $totalDues = 0;
    public $paidMembers = 0;
    public $unpaidMembers = 0;
    public $totalMembers = 0;

    public $showComputationRequestModal = false;
    public $memberData = [];
    public $requestData = [];
    public $additionalMessage = '';
    public $agreementAccepted = false;
    public $submittingRequest = false;
    public $requestResult = null;

    public $showAllData = false;
    public $currentUser;
    public $isAdmin = false;

    public function mount(): void
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
        $this->currentUser = auth()->user();
        $this->isAdmin = $this->currentUser->hasRole(['admin', 'superadmin']);
        $this->loadData();
        // Dispatch initial data after mount
        $this->dispatchDataUpdate();
    }

    public function filterByDate(): void
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $this->loadData();
        $this->dispatchDataUpdate();
    }

    public function updatedStartDate(): void
    {
        if ($this->startDate && $this->endDate) {
            $this->loadData();
            $this->dispatchDataUpdate();
        }
    }

    public function updatedEndDate(): void
    {
        if ($this->startDate && $this->endDate) {
            $this->loadData();
            $this->dispatchDataUpdate();
        }
    }

    private function loadData(): void
    {
        $currentFiscalYear = \App\Models\FiscalYear::current()->first();

        if (!$currentFiscalYear) {
            $this->paidDues = 0;
            $this->unpaidDues = 0;
            $this->totalDues = 0;
            $this->paidMembers = 0;
            $this->unpaidMembers = 0;
            $this->totalMembers = 0;
            return;
        }

        $baseDuesQuery = \App\Models\Due::where('fiscal_year_id', $currentFiscalYear->id);

        if (!$this->isAdmin || !$this->showAllData) {
            $baseDuesQuery->where('member_id', $this->currentUser->id);
        }

        $paidDuesQuery = clone $baseDuesQuery;
        $paidDues = $paidDuesQuery->whereIn('status', ['paid', 'partial'])
            ->whereBetween('payment_date', [$this->startDate, $this->endDate])
            ->get();

        $this->paidMembers = $paidDues->groupBy('member_id')->count();
        $this->paidDues = $paidDues->sum(function($due) {
            return $due->amount + $due->penalty_amount;
        });


        $unpaidDuesQuery = clone $baseDuesQuery;
        $unpaidDues = $unpaidDuesQuery->where('status', 'unpaid')
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->get();

        $this->unpaidMembers = $unpaidDues->groupBy('member_id')->count();
        $this->unpaidDues = $unpaidDues->sum(function($due) {
            return $due->amount + $due->penalty_amount;
        });

        $allDues = $paidDues->merge($unpaidDues);
        $this->totalMembers = $allDues->groupBy('member_id')->count();
        $this->totalDues = $this->paidDues + $this->unpaidDues;
    }

    public function toggleDataView(): void
    {
        $this->showAllData = !$this->showAllData;
        $this->loadData();
        $this->dispatchDataUpdate();
    }

    private function dispatchDataUpdate(): void
    {
        $this->dispatch('dataUpdated', [
            'paidDues' => $this->paidDues,
            'unpaidDues' => $this->unpaidDues,
            'paidMembers' => $this->paidMembers,
            'unpaidMembers' => $this->unpaidMembers,
            'totalMembers' => $this->totalMembers,
            'totalDues' => $this->totalDues
        ]);
    }
    public function openComputationModal(): void
    {
        $this->memberData = $this->loadMemberData();
        $this->showComputationRequestModal = true;
        $this->resetComputationForm();
    }
    public function closeComputationModal(): void
    {
        $this->showComputationRequestModal = false;
        $this->resetComputationForm();
    }

    public function submitComputationRequest(): void
    {
        $this->validate([
            'agreementAccepted' => 'required|accepted',
            'memberData.prc_registration_number' => 'required|exists:users,prc_registration_number',
            'memberData.email' => 'required|email',
            'additionalMessage' => 'nullable|string|max:1000',
        ]);

        $this->submittingRequest = true;
        $this->requestResult = null;
        $reference_number = 'REQ-' . now()->format('Ymd') . '-' . substr(Str::uuid(), 0, 8);

        try {
            $result = $this->processComputationRequest($reference_number);

            $this->requestResult = [
                'error' => false,
                'message' => 'Your computation breakdown request has been submitted successfully.',
                'reference_number' => $reference_number
            ];

            // Optional: Send confirmation email/notification
            $this->sendConfirmationNotification();

        } catch (\Exception $e) {
            $this->requestResult = [
                'error' => true,
                'message' => 'Failed to submit request. Please try again.'
            ];

            // Log the error
            \Log::error('Computation request submission failed: ' . $e->getMessage());
        }

        $this->submittingRequest = false;
        $this->closeComputationModal();
    }

    private function resetComputationForm(): void
    {
        $this->additionalMessage = '';
        $this->agreementAccepted = false;
        $this->submittingRequest = false;
        $this->requestResult = null;
    }

    private function loadMemberData()
    {
        $memberId = auth()->user()->id;
        if ($memberId) {
            $member = User::find($memberId);
            return $member->toArray();
        }
    }

    private function processComputationRequest($reference_number): true
    {
        ComputationRequest::create([
            'reference_number' => $reference_number,
            'member_id' => $this->memberData['id'] ?? null,
            'message' => $this->additionalMessage,
            'status' => 'pending',
        ]);

        return true;
    }

    private function sendConfirmationNotification(): void
    {
        try {
            // Send notification to administrators
            $this->notifyAdminsOfComputationRequest();

        } catch (\Exception $e) {
            \Log::error('Failed to send computation request notifications: ' . $e->getMessage());
        }
    }

    private function notifyAdminsOfComputationRequest(): void
    {
        $admins = \App\Models\User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['superadmin', 'admin']);
        })->get();

        // Ensure all required fields exist with fallbacks
        $notificationData = [
            'computation_request_id' => $this->requestResult['reference_number'] ?? 'N/A',
            'member_data' => [
                'name' => $this->memberData['first_name'] . ' ' . ($this->memberData['last_name'] ?? ''),
                'email' => $this->memberData['email'] ?? 'Unknown',
                'prc_number' => $this->memberData['prc_registration_number'] ?? 'N/A',
                'chapter' => $this->memberData['current_chapter'] ?? 'Unknown',
            ],
            'additional_message' => $this->additionalMessage ?? 'None provided',
            'submitted_at' => now()->toISOString(),
        ];

        foreach ($admins as $admin) {
            try {
                $notification = new \App\Notifications\CustomNotification(
                    'New Computation Breakdown Request',
                    $this->buildAdminNotificationMessage($notificationData['member_data']),
                    'computation_request',
                    'high',
                    $notificationData,
                    $admin->id
                );
                $admin->notify($notification);
            } catch (\Exception $e) {
                \Log::error('Failed to send admin notification for computation request', [
                    'admin_id' => $admin->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }
    }

    private function buildAdminNotificationMessage(array $memberData): string
    {
        $memberName = $memberData['name'] ?? 'Unknown Member';
        $prcNumber = $memberData['prc_number'] ?? 'N/A';

        $message = "A new computation breakdown request has been submitted by {$memberName} (PRC# {$prcNumber}).";

        if (!empty($this->additionalMessage)) {
            $message .= "\n\nAdditional Message: " . $this->additionalMessage;
        }

        $message .= "\n\nPlease review and process this request in the admin panel.";

        return $message;
    }

    public function sendReminder(): void
    {
        $this->sendingNotification = true;
        $this->notificationResults = null;

        try {
            $notificationService = new NotificationService();
            $recipients = $this->getRecipientsWithOverrideSettings();

            \Log::info('Sending reminder to ' . $recipients->count() . ' recipients');
            \Log::info('Selected notification methods: ', $this->selectedNotificationMethods);

            // Debug: Log recipient details with full user model
            foreach ($recipients as $index => $recipient) {
                \Log::info("Recipient {$index} full details: ", [
                    'id' => $recipient->id ?? 'NO ID',
                    'middle_name' => $recipient->middle_name ?? 'NO MIDDLE NAME',
                    'first_name' => $recipient->first_name ?? 'NO FIRST NAME',
                    'family_name' => $recipient->family_name ?? 'NO FAMILY NAME',
                    'email' => $recipient->email ?? 'NO EMAIL',
                    'phone' => $recipient->phone ?? 'NO PHONE',
                    'mobile' => $recipient->mobile ?? 'NO MOBILE',
                    'notification_methods' => $recipient->notification_methods ?? 'NO METHODS SET',
                    'class' => get_class($recipient)
                ]);
            }

            // Debug: Log the reminder details being sent
            \Log::info('Reminder details: ', [
                'id' => $this->reminder->id,
                'title' => $this->reminder->title,
                'description' => $this->reminder->description,
                'start_datetime' => $this->reminder->start_datetime,
                'end_datetime' => $this->reminder->end_datetime,
            ]);

            // Convert Collection to array and log what's being passed
            $recipientsArray = $recipients->toArray();
            \Log::info('Recipients array being passed to service: ', $recipientsArray);

            $results = $notificationService->sendReminderNotifications($this->reminder, $recipientsArray);

            \Log::info('Notification results: ', $results);
            $this->notificationResults = $results;

            // Refresh activity log
            $this->reminder->refresh();
            $this->loadReminderData();

            $totalSent = $results['email']['sent'] + $results['sms']['sent'] + $results['app']['sent'];
            $totalAttempted = $recipients->count() * count(array_filter($this->selectedNotificationMethods));

            if ($totalSent > 0) {
                $message = "Reminder sent successfully to {$totalSent} recipients";
                if ($totalSent < $totalAttempted) {
                    $message .= " (some notifications may not have been delivered)";
                }
                session()->flash('message', $message);
                $this->dispatch('notification-sent', [
                    'type' => 'success',
                    'message' => $message
                ]);
            } else {
                session()->flash('error', 'No notifications were sent. Please check your settings and try again.');
            }

        } catch (\Exception $e) {
            \Log::error('Failed to send reminder notifications: ' . $e->getMessage());
            \Log::error('Exception trace: ' . $e->getTraceAsString());

            $errorMessage = 'Failed to send notifications: ' . $e->getMessage();
            session()->flash('error', $errorMessage);

            $this->notificationResults = [
                'error' => true,
                'message' => $errorMessage,
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ];

            $this->dispatch('notify-error', message: $errorMessage);
        } finally {
            $this->sendingNotification = false;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.admin-dashboard');
    }
}
