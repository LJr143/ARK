<?php

namespace App\Livewire\Reminder;

use App\Models\Reminder;
use App\Models\ReminderCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class CreateReminder extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $categories;

    public $title;
    public $category;
    public $location;
    public $has_period_covered = false;
    public $period_from;
    public $period_to;
    public $reminder_start;
    public $reminder_end;
    public $description;
    public $attachments = [];

    public $reminder_id;
    public $recipient_type = 'public';
    public $selected_recipients = [];
    public $recipientSearch = '';
    public $recipientSearchResults = [];

    public $notification_methods = [
        'email' => false,
        'sms' => false,
        'app' => true
    ];

    protected $rules = [
        'title' => 'required|string|max:255',
        'category' => 'required|exists:reminder_categories,id',
        'location' => 'required|string|max:255',
        'period_from' => 'nullable|required_if:has_period_covered,true|date|before_or_equal:period_to',
        'period_to' => 'nullable|required_if:has_period_covered,true|date|after_or_equal:period_from',
        'reminder_start' => 'required|date|before_or_equal:reminder_end|after_or_equal:now',
        'reminder_end' => 'required|date|after_or_equal:reminder_start',
        'description' => 'nullable|string',
        'attachments.*' => 'file|max:10240',
        'recipient_type' => 'required|in:public,private,custom',
        'selected_recipients' => 'required_if:recipient_type,custom|array',
        'selected_recipients.*' => 'exists:users,id',
        'notification_methods' => 'required|array',
        'notification_methods.email' => 'boolean',
        'notification_methods.sms' => 'boolean',
        'notification_methods.app' => 'boolean',
    ];

    protected $messages = [
        'period_from.required_if' => 'The from date is required when period covered is checked',
        'period_to.required_if' => 'The to date is required when period covered is checked',
        'reminder_start.before_or_equal' => 'Start date must be before or equal to end date',
        'reminder_end.after_or_equal' => 'End date must be after or equal to start date',
    ];

    public function mount(): void
    {
        $this->categories = ReminderCategory::all();
        $this->reminder_id = $this->generateReminderId();
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function updatedAttachments(): void
    {
        $this->validate([
            'attachments.*' => 'file|max:10240',
        ]);
    }

    public function removeAttachment($index): void
    {
        array_splice($this->attachments, $index, 1);
    }

    public function updatedRecipientSearch($value): void
    {
        if (strlen($value) > 2) {
            $this->recipientSearchResults = \App\Models\User::where('first_name', 'like', '%'.$value.'%')
                ->orWhere('email', 'like', '%'.$value.'%')
                ->limit(5)
                ->get();
        } else {
            $this->recipientSearchResults = [];
        }
    }

    public function toggleRecipient($userId): void
    {
        if (in_array($userId, $this->selected_recipients)) {
            $this->selected_recipients = array_diff($this->selected_recipients, [$userId]);
        } else {
            $this->selected_recipients[] = $userId;
        }
        $this->recipientSearch = '';
        $this->recipientSearchResults = [];
    }

    public function updatedHasPeriodCovered($value): void
    {
        if (!$value) {
            $this->reset(['period_from', 'period_to']);
        }
    }

    public function proceedToStep2(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|exists:reminder_categories,id',
            'location' => 'required|string|max:255',
            'reminder_start' => 'required|date|before_or_equal:reminder_end',
            'reminder_end' => 'required|date|after_or_equal:reminder_start',
        ]);

        $this->currentStep = 2;
    }

    public function saveReminder()
    {
        $validatedData = $this->validate();

        $reminder = Reminder::create([
            'title' => $this->title,
            'reminder_id' => $this->reminder_id,
            'category_id' => $this->category,
            'location' => $this->location,
            'period_from' => $this->has_period_covered ? $this->period_from : null,
            'period_to' => $this->has_period_covered ? $this->period_to : null,
            'start_datetime' => $this->reminder_start,
            'end_datetime' => $this->reminder_end,
            'description' => $this->description,
            'status' => 'upcoming',
            'recipient_type' => $this->recipient_type,
            'notification_methods' => json_encode(array_filter($this->notification_methods)),
        ]);

        if ($this->recipient_type === 'custom') {
            $reminder->customRecipients()->sync($this->selected_recipients);
        }

        // Handle file uploads
        if ($this->attachments) {
            foreach ($this->attachments as $attachment) {
                $path = $attachment->store('reminder-attachments', 'public');

                $reminder->attachments()->create([
                    'original_name' => $attachment->getClientOriginalName(),
                    'path' => $path,
                    'mime_type' => $attachment->getMimeType(),
                    'size' => $attachment->getSize(),
                ]);
            }
        }

        $this->dispatchNotifications($reminder);
        notify()->success('Reminder created successfully!');
        return redirect()->route('reminders.index');
    }

    protected function dispatchNotifications($reminder): void
    {
        if ($this->notification_methods['app']) {
           //TODO: FOR APP NOTIFICATION
        }

        if ($this->notification_methods['email']) {
           //TODO: FOR EMAIL NOTIFICATION
        }

        if ($this->notification_methods['sms']) {
            //TODO: FOR SMS NOTIFICATION
        }
    }


    public function backToStep1()
    {
        $this->currentStep = 1;
    }

    private function generateReminderId()
    {
        // Generate a unique reminder ID (e.g., REM-2023-0001)
        $prefix = 'REM-' . date('Y') . '-';
        $lastReminder = Reminder::where('reminder_id', 'like', $prefix . '%')
            ->orderBy('reminder_id', 'desc')
            ->first();

        if ($lastReminder) {
            $lastNumber = (int) str_replace($prefix, '', $lastReminder->reminder_id);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . $newNumber;
    }

    public function resetForm(): void
    {
        $this->currentStep = 1;
        $this->title = null;
        $this->category = null;
        $this->location = null;
        $this->has_period_covered = false;
        $this->period_from = null;
        $this->period_to = null;
        $this->reminder_start = null;
        $this->reminder_end = null;
        $this->description = null;
        $this->attachments = [];

        $this->recipient_type = 'public';
        $this->selected_recipients = [];
        $this->recipientSearch = '';
        $this->recipientSearchResults = [];
        $this->notification_methods = [
            'email' => false,
            'sms' => false,
            'app' => true
        ];
    }


    public function render()
    {
        return view('livewire.reminder.create-reminder', [
            'categories' => $this->categories
        ]);
    }
}
