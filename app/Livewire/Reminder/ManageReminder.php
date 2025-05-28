<?php

namespace App\Livewire\Reminder;

use App\Models\Reminder;
use App\Models\User;
use App\Services\NotificationService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ManageReminder extends Component
{
    use WithPagination;

    public $activeMainTab = 'recipients';
    public $activeSubTab = 'members';
    public $showAddMemberModal = false;
    public $showMobileMenu = false;
    public $showSendModal = false;
    public $members = [];
    public $reminderDetails = null;
    public $sendingNotification = false;
    public $notificationResults = null;

    protected $paginationTheme = 'tailwind';

    public $reminder;
    public $reminderId;

    // Notification method selection
    public $selectedNotificationMethods = [
        'email' => true,
        'sms' => false,
        'app' => true
    ];

    public function mount(Reminder $reminder)
    {
        $this->reminder = $reminder;
        $this->reminderId = $reminder->id;
        $this->loadReminderData();
    }

    private function loadReminderData(): void
    {
        $startDateTime = Carbon::parse($this->reminder->start_datetime);
        $endDateTime = Carbon::parse($this->reminder->end_datetime);
        $createdAt = Carbon::parse($this->reminder->created_at);

        $this->reminderDetails = [
            'id' => $this->reminder->id,
            'reminder_id' => $this->reminder->reminder_id ?? $this->reminder->id,
            'title' => $this->reminder->title,
            'category' => $this->reminder->category->name,
            'recipient_type' => $this->reminder->recipient_type,
            'period' => $this->reminder->period,
            'description' => $this->reminder->description,
            'location' => $this->reminder->location ?? '—',
            'start_date' => [
                'date' => $startDateTime->format('F j, Y'),
                'time' => $startDateTime->format('g:i A'),
                'datetime' => $this->reminder->start_datetime
            ],
            'end_date' => [
                'date' => $endDateTime->format('F j, Y'),
                'time' => $endDateTime->format('g:i A'),
                'datetime' => $this->reminder->end_datetime
            ],
            'status' => $this->reminder->status ?? 'active',
            'activity_log' => $this->getActivityLog(),
            'attachments' => $this->reminder->attachments->map(function ($attachment) {
                return [
                    'id' => $attachment->id,
                    'name' => $attachment->original_name,
                    'path' => $attachment->path,
                    'size' => $this->formatFileSize($attachment->size),
                    'type' => $attachment->mime_type,
                    'icon' => $this->getFileIcon($attachment->mime_type),
                    'color' => $this->getFileColor($attachment->mime_type),
                ];
            })->toArray(),
            'created_at' => $createdAt->format('F j, Y'),
        ];

        $this->loadMembers();
    }

    private function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } else {
            return '1 byte';
        }
    }

    private function getFileIcon($mimeType)
    {
        $icons = [
            'application/pdf' => 'fa-file-pdf',
            'application/msword' => 'fa-file-word',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'fa-file-word',
            'application/vnd.ms-excel' => 'fa-file-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'fa-file-excel',
            'application/vnd.ms-powerpoint' => 'fa-file-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'fa-file-powerpoint',
            'image/jpeg' => 'fa-file-image',
            'image/jpg' => 'fa-file-image',
            'image/png' => 'fa-file-image',
            'image/gif' => 'fa-file-image',
            'text/plain' => 'fa-file-alt',
            'application/zip' => 'fa-file-archive',
        ];

        return $icons[$mimeType] ?? 'fa-file';
    }

    private function getFileColor($mimeType)
    {
        $colors = [
            'application/pdf' => 'red',
            'application/msword' => 'blue',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'blue',
            'application/vnd.ms-excel' => 'green',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'green',
            'application/vnd.ms-powerpoint' => 'orange',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'orange',
            'image/jpeg' => 'purple',
            'image/jpg' => 'purple',
            'image/png' => 'purple',
            'image/gif' => 'purple',
            'text/plain' => 'gray',
            'application/zip' => 'yellow',
            'default' => 'gray'
        ];

        return $colors[$mimeType] ?? $colors['default'];
    }

    private function getActivityLog()
    {
        return $this->reminder->activity_log ?? [];
    }

    private function loadMembers()
    {
        $this->members = collect();

        try {
            switch ($this->reminder->recipient_type) {
                case 'public':
                    $this->members = User::all();
                    break;

                case 'private':
                    if (auth()->id() === $this->reminder->user_id) {
                        $this->members = $this->reminder->recipients()->with('user')->get();
                    }
                    break;

                case 'selected':
                default:
                    $this->members = $this->reminder->customRecipients()->get();
                    break;
            }

            $this->members = $this->members->map(function ($user) {
                $userModel = ($user instanceof \App\Models\User) ? $user : $user->user;

                if (!$userModel) {
                    return null;
                }

                $nameParts = [
                    $userModel->family_name ?? '',
                    $userModel->middle_name ?? '',
                    $userModel->first_name ?? ''
                ];

                $fullName = trim(implode(' ', array_filter($nameParts)));

                return [
                    'id' => $userModel->id,
                    'name' => $fullName ?: $userModel->name ?? 'Unknown User',
                    'prc_no' => $userModel->prc_registration_number ?? 'N/A',
                    'email' => $userModel->email,
                    'phone' => $userModel->phone ?? $userModel->mobile ?? 'N/A',
                    'payment_status' => $userModel->payment_status ?? 'unpaid',
                    'date_added' => optional($user->pivot->created_at ?? $userModel->created_at)->format('Y-m-d h:i A') ?? 'N/A',
                    'notification_methods' => $userModel->notification_methods ?? '{"email":true,"app":true}'
                ];
            })->filter();

        } catch (\Exception $e) {
            \Log::error('Failed to load members: ' . $e->getMessage());
            $this->members = collect();
        }
    }

    public function setMainTab($tab)
    {
        $this->activeMainTab = $tab;
        $this->showMobileMenu = false;
        $this->resetPage();
    }

    public function setSubTab($tab): void
    {
        $this->activeSubTab = $tab;
        $this->resetPage();
    }

    public function toggleMobileMenu(): void
    {
        $this->showMobileMenu = !$this->showMobileMenu;
    }

    public function openAddMemberModal(): void
    {
        $this->showAddMemberModal = true;
    }

    public function closeAddMemberModal(): void
    {
        $this->showAddMemberModal = false;
    }

    public function openSendModal(): void
    {
        $this->showSendModal = true;
        $this->notificationResults = null;
    }

    public function closeSendModal(): void
    {
        $this->showSendModal = false;
        $this->notificationResults = null;
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
                    'name' => $recipient->name ?? 'NO NAME',
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
            \Log::info('Total notifications sent: ' . $totalSent);

            if ($totalSent > 0) {
                session()->flash('message', "Reminder sent successfully to {$totalSent} recipients!");
                $this->dispatch('notification-sent', [
                    'type' => 'success',
                    'message' => "Notifications sent successfully!"
                ]);
            } else {
                session()->flash('error', 'No notifications were sent. Please check your settings and try again.');
            }

        } catch (\Exception $e) {
            \Log::error('Failed to send reminder notifications: ' . $e->getMessage());
            \Log::error('Exception trace: ' . $e->getTraceAsString());
            session()->flash('error', 'Failed to send notifications: ' . $e->getMessage());

            $this->notificationResults = [
                'error' => true,
                'message' => $e->getMessage()
            ];
        } finally {
            $this->sendingNotification = false;
        }
    }

    private function getRecipientsWithOverrideSettings()
    {
        \Log::info('Original members count: ' . $this->members->count());

        return $this->members->map(function ($memberData) {
            \Log::info('Processing member: ', $memberData);

            $user = User::find($memberData['id']);
            if ($user) {
                // Debug: Log original notification methods
                \Log::info('Original user notification methods: ' . $user->notification_methods);

                // Override notification methods with selected methods
                $user->notification_methods = json_encode($this->selectedNotificationMethods);

                // Debug: Log overridden notification methods
                \Log::info('Overridden user notification methods: ' . $user->notification_methods);

                return $user;
            } else {
                \Log::warning('User not found for ID: ' . $memberData['id']);
            }
            return null;
        })->filter();
    }

    public function addMember(): void
    {
        $this->closeAddMemberModal();
        session()->flash('message', 'Member added successfully!');
    }

    public function toggleArchive(): void
    {
        $this->reminder->update([
            'status' => $this->reminder->status === 'archived' ? 'upcoming' : 'archived'
        ]);

        $this->loadReminderData();

        $action = $this->reminder->status === 'archived' ? 'archived' : 'unarchived';
        session()->flash('message', "Reminder {$action} successfully!");
    }

    public function getPaymentStatusBadgeClass($status): string
    {
        return match ($status) {
            'paid' => 'bg-green-100 text-green-800',
            'unpaid' => 'bg-gray-100 text-gray-800',
            'overdue' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function render()
    {
        return view('livewire.reminder.manage-reminder');
    }
}
