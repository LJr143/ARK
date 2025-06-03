<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class CustomNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $title;
    protected $message;
    protected $type;
    protected $priority;
    protected $data;
    protected $userId;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        string $title,
        string $message,
        string $type = 'default',
        string $priority = 'normal',
        array $data = [],
        int $userId
    ) {
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
        $this->priority = $priority;
        $this->data = $data;
        $this->userId = $userId;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type,
            'priority' => $this->priority,
            'timestamp' => now(),
            ...$this->data
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'notification' => [
                'id' => $this->id,
                'title' => $this->title,
                'message' => $this->message,
                'type' => $this->type,
                'priority' => $this->priority,
                'data' => [
                    'title' => $this->title,
                    'message' => $this->message,
                    'type' => $this->type,
                    'priority' => $this->priority,
                    ...$this->data
                ],
                'created_at' => now(),
                'read_at' => null
            ]
        ]);
    }

    /**
     * Get the broadcast channel name.
     */
    public function broadcastOn(): array
    {
        return ['user.' . $this->userId];
    }

    /**
     * Get the broadcast event name.
     */
    public function broadcastType(): string
    {
        return 'notification.created';
    }
}
