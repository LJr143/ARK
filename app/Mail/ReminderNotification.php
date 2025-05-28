<?php

namespace App\Mail;

use App\Models\Reminder;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class ReminderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $reminder;
    public $recipient;

    public function __construct(Reminder $reminder, User $recipient)
    {
        $this->reminder = $reminder;
        $this->recipient = $recipient;
    }

    public function build()
    {
        $startDate = Carbon::parse($this->reminder->start_datetime);
        $subject = 'Reminder: ' . $this->reminder->title;

        return $this->subject($subject)
            ->view('emails.reminder-notification')
            ->with([
                'recipientName' => $this->recipient->first_name ?? $this->recipient->name,
                'reminderTitle' => $this->reminder->title,
                'reminderDescription' => $this->reminder->description,
                'startDateTime' => $startDate->format('F j, Y \a\t g:i A'),
                'endDateTime' => $this->reminder->end_datetime ? Carbon::parse($this->reminder->end_datetime)->format('F j, Y \a\t g:i A') : null,
                'location' => $this->reminder->location,
                'category' => $this->reminder->category->name ?? 'General',
                'attachments' => $this->reminder->attachments ?? collect()
            ]);
    }
}
