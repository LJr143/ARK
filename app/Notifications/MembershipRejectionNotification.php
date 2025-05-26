<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipRejectionNotification extends Notification
{
    use Queueable;

    public $remarks;

    /**
     * Create a new notification instance.
     */
    public function __construct($remarks)
    {
        $this->remarks = $remarks;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // app/Notifications/MembershipRejectionNotification.php
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your UAP Membership Application Status')
            ->greeting('Dear ' . $notifiable->name . ',')
            ->line('We regret to inform you that your UAP membership application has been rejected.')
            ->line('Reason: ' . $this->remarks)
            ->line('For any questions, please contact our support team at support@example.com')
            ->line('Thank you for your interest in UAP.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
