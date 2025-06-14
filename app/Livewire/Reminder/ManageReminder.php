<?php

namespace App\Livewire\Reminder;

use App\Models\ComputationRequest;
use App\Models\Reminder;
use App\Models\User;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageReminder extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $activeMainTab = 'recipients';
    public $activeSubTab = 'members';
    public $showAddMemberModal = false;
    public $showMobileMenu = false;
    public $showSendModal = false;
    public $showComputationRequestModal = false;
    public $memberData = [];
    public $requestData = [];
    public $additionalMessage = '';
    public $agreementAccepted = false;
    public $submittingRequest = false;
    public $requestResult = null;

    public $members = [];
    public $reminderDetails = null;
    public $sendingNotification = false;
    public $notificationResults = null;

    protected $paginationTheme = 'tailwind';

    public $reminder;
    public $reminderId;

    public $isEditing = false;
    public $editableFields = [
        'title' => '',
        'description' => '',
        'start_datetime' => '',
        'end_datetime' => '',
        'location' => '',
        'period' => false,
    ];
    public $uploadedFiles = [];
    public $removingAttachmentId = null;
    public $showFileUpload = false;
    public $selectedNotificationMethods = [
        'email' => true,
        'sms' => false,
        'app' => true
    ];

    public $viewRequestModal = 'false';

    public $searchTerm = '';
    public $selectedUsers = [];
    public $availableUsers = [];
    public $showUserSearch = false;

    public function mount(Reminder $reminder)
    {
        if (auth()->user()->hasRole('member')) {
            $this->activeSubTab = 'details';
        }
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

    public function loadAvailableUsers(): void
    {
        // Only load users if reminder is not public
        if ($this->reminder->recipient_type === 'public') {
            $this->availableUsers = collect();
            return;
        }

        $currentMemberIds = $this->members->pluck('id')->toArray();

        $query = User::whereNotIn('id', $currentMemberIds);

        if (!empty($this->searchTerm)) {
            $query->where(function($q) {
                $q->where('first_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('family_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('middle_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('prc_registration_number', 'like', '%' . $this->searchTerm . '%');
            });
        }

        $this->availableUsers = $query->limit(10)->get()->map(function ($user) {
            $nameParts = [
                $user->family_name ?? '',
                $user->middle_name ?? '',
                $user->first_name ?? ''
            ];

            $fullName = trim(implode(' ', array_filter($nameParts)));

            return [
                'id' => $user->id,
                'name' => $fullName ?: $user->name ?? 'Unknown User',
                'email' => $user->email,
                'prc_no' => $user->prc_registration_number ?? 'N/A',
            ];
        });
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

    public function startEditing(): void
    {
        $this->isEditing = true;
        $this->editableFields = [
            'title' => $this->reminder->title,
            'description' => $this->reminder->description,
            'start_datetime' => $this->reminder->start_datetime,
            'end_datetime' => $this->reminder->end_datetime,
            'location' => $this->reminder->location ?? '',
            'period' => (bool)$this->reminder->period,
        ];
    }

    public function cancelEditing(): void
    {
        $this->isEditing = false;
        $this->reset('editableFields');
    }

    public function saveChanges(): void
    {
        $validated = $this->validate([
            'editableFields.title' => 'required|string|max:255',
            'editableFields.description' => 'required|string',
            'editableFields.start_datetime' => 'required|date',
            'editableFields.end_datetime' => 'required|date|after:editableFields.start_datetime',
            'editableFields.location' => 'nullable|string|max:255',
            'editableFields.period' => 'boolean',
        ]);

        $this->reminder->update([
            'title' => $validated['editableFields']['title'],
            'description' => $validated['editableFields']['description'],
            'start_datetime' => $validated['editableFields']['start_datetime'],
            'end_datetime' => $validated['editableFields']['end_datetime'],
            'location' => $validated['editableFields']['location'],
            'period' => $validated['editableFields']['period'],
        ]);

        $this->isEditing = false;
        $this->loadReminderData();
        session()->flash('message', 'Reminder updated successfully!');
    }

    public function updatedUploadedFiles(): void
    {
        $this->validate([
            'uploadedFiles.*' => 'file|max:10240', // 10MB max per file
        ]);
    }

    public function saveFiles(): void
    {
        $this->validate([
            'uploadedFiles.*' => 'file|max:10240',
        ]);

        foreach ($this->uploadedFiles as $file) {
            $path = $file->store('reminder-attachments');

            $this->reminder->attachments()->create([
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        $this->uploadedFiles = [];
        $this->showFileUpload = false;
        $this->loadReminderData();
        session()->flash('message', 'Files uploaded successfully!');
    }

    public function confirmRemoveAttachment($attachmentId): void
    {
        $this->removingAttachmentId = $attachmentId;
    }

    public function removeAttachment(): void
    {
        $attachment = \App\Models\ReminderAttachment::find($this->removingAttachmentId);

        if ($attachment) {
            \Storage::delete($attachment->path);
            $attachment->delete();
            session()->flash('message', 'File deleted successfully!');
        }

        $this->removingAttachmentId = null;
        $this->loadReminderData();
    }

    public function toggleFileUpload(): void
    {
        $this->showFileUpload = !$this->showFileUpload;
        $this->uploadedFiles = [];
    }

    private function loadMembers(): void
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

    public function setMainTab($tab): void
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
        // Check if reminder is public
        if ($this->reminder->recipient_type === 'public') {
            session()->flash('error', 'Cannot add members to public reminders.');
            return;
        }

        $this->showAddMemberModal = true;
        $this->searchTerm = '';
        $this->selectedUsers = [];
        $this->loadAvailableUsers();
    }

    public function updatedSearchTerm(): void
    {
        $this->loadAvailableUsers();
    }

    public function toggleUserSelection($userId): void
    {
        if (in_array($userId, $this->selectedUsers)) {
            $this->selectedUsers = array_filter($this->selectedUsers, fn($id) => $id !== $userId);
        } else {
            $this->selectedUsers[] = $userId;
        }
    }

    public function closeAddMemberModal(): void
    {
        $this->showAddMemberModal = false;
        $this->searchTerm = '';
        $this->selectedUsers = [];
        $this->availableUsers = collect();
    }

    public function removeMember($userId): void
    {
        if ($this->reminder->recipient_type === 'public') {
            session()->flash('error', 'Cannot remove members from public reminders.');
            return;
        }

        try {
            $removed = false;

            switch ($this->reminder->recipient_type) {
                case 'private':
                    $removed = $this->reminder->recipients()
                            ->where('user_id', $userId)
                            ->delete() > 0;
                    break;

                case 'selected':
                default:
                    $this->reminder->customRecipients()->detach($userId);
                    $removed = true;
                    break;
            }

            if ($removed) {
                $this->loadMembers();
                session()->flash('message', 'Member removed successfully!');

                // Log the activity
                $this->logActivity('member_removed', [
                    'user_id' => $userId,
                    'removed_by' => auth()->user()->name
                ]);
            } else {
                session()->flash('error', 'Failed to remove member.');
            }

        } catch (\Exception $e) {
            \Log::error('Failed to remove member from reminder: ' . $e->getMessage());
            session()->flash('error', 'Failed to remove member. Please try again.');
        }
    }

    private function logActivity($action, $data = []): void
    {
        try {
            $activityLog = $this->reminder->activity_log ?? [];

            $activityLog[] = [
                'action' => $action,
                'data' => $data,
                'timestamp' => now()->toISOString(),
                'user' => auth()->user()->name,
                'user_id' => auth()->id()
            ];

            $this->reminder->update(['activity_log' => $activityLog]);
        } catch (\Exception $e) {
            \Log::error('Failed to log activity: ' . $e->getMessage());
        }
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
            $query->where('name', 'superadmin');
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
        if (empty($this->selectedUsers)) {
            session()->flash('error', 'Please select at least one member to add.');
            return;
        }

        // Check if reminder is public
        if ($this->reminder->recipient_type === 'public') {
            session()->flash('error', 'Cannot add members to public reminders.');
            return;
        }

        try {
            $addedCount = 0;

            foreach ($this->selectedUsers as $userId) {
                $user = User::find($userId);
                if (!$user) continue;

                // Check the reminder type and add accordingly
                switch ($this->reminder->recipient_type) {
                    case 'private':
                        // For private reminders, add to recipients table
                        $exists = $this->reminder->recipients()
                            ->where('user_id', $userId)
                            ->exists();

                        if (!$exists) {
                            $this->reminder->recipients()->create([
                                'user_id' => $userId,
                                'added_by' => auth()->id(),
                                'added_at' => now()
                            ]);
                            $addedCount++;
                        }
                        break;

                    case 'selected':
                    default:
                        // For selected reminders, add to custom recipients
                        $exists = $this->reminder->customRecipients()
                            ->where('id', $userId)
                            ->exists();

                        if (!$exists) {
                            $this->reminder->customRecipients()->attach($userId, [
                                'added_by' => auth()->id(),
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                            $addedCount++;
                        }
                        break;
                }
            }

            if ($addedCount > 0) {
                // Reload the members list
                $this->loadMembers();

                // Close modal and show success message
                $this->closeAddMemberModal();

                $memberText = $addedCount === 1 ? 'member' : 'members';
                session()->flash('message', "Successfully added {$addedCount} {$memberText} to the reminder!");

                // Log the activity
                $this->logActivity('members_added', [
                    'count' => $addedCount,
                    'added_by' => auth()->user()->name
                ]);
            } else {
                session()->flash('error', 'No new members were added. They may already be part of this reminder.');
            }

        } catch (\Exception $e) {
            \Log::error('Failed to add members to reminder: ' . $e->getMessage());
            session()->flash('error', 'Failed to add members. Please try again.');
        }
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
