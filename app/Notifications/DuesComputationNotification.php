<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class DuesComputationNotification extends Notification
{
    use Queueable;

    protected $computation;
    protected $additionalMessage;
    protected $memberId;

    public function __construct(array $computation, string $additionalMessage, int $memberId)
    {
        $this->computation = $computation;
        $this->additionalMessage = $additionalMessage;
        $this->memberId = $memberId;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $mail = (new MailMessage)
            ->subject('Your Dues Computation Details')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your dues computation request has been processed. Below are the details:');

        foreach ($this->computation['dues'] as $due) {
            $mail->line("Fiscal Year: {$due['fiscal_year']}")
                ->line("Amount: ₱" . number_format($due['amount'], 2))
                ->line("Penalty: ₱" . number_format($due['penalty'], 2))
                ->line("Total: ₱" . number_format($due['total'], 2))
                ->line("Due Date: " . ($due['due_date'] ?? 'N/A'))
                ->line("Status: " . ucfirst($due['status']))
                ->line('---');
        }

        $mail->line('Total Amount Owed: ₱' . number_format($this->computation['total_amount'], 2));

        if ($this->computation['total_unpaid'] > 0) {
            $mail->line('Total Unpaid Amount: ₱' . number_format($this->computation['total_unpaid'], 2));
        }

        if ($this->additionalMessage) {
            $mail->line('Additional Message from Admin: ' . $this->additionalMessage);
        }

        return $mail->action('View Details in Dashboard', url('/dashboard'))
            ->line('Please contact support if you have any questions.');
    }
}
