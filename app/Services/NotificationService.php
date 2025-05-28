<?php

namespace App\Services;

use App\Models\User;
use App\Models\Reminder;
use App\Events\ReminderNotificationSent;
use App\Mail\ReminderNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class NotificationService
{
    private $philSmsConfig;

    public function __construct()
    {
        $this->philSmsConfig = [
            'token' => config('services.philsms.token'),
            'sender_id' => config('services.philsms.sender_id'),
            'base_url' => config('services.philsms.base_url', 'https://app.philsms.com/api/v3'),
        ];
    }

    public function sendReminderNotifications(Reminder $reminder, array $recipients = null): array
    {
        $recipients = collect($recipients ?: $this->getRecipients($reminder))
            ->map(fn($r) => is_array($r) ? new User($r) : $r)
            ->all();

        $results = [
            'email' => ['sent' => 0, 'failed' => 0, 'errors' => []],
            'sms' => ['sent' => 0, 'failed' => 0, 'errors' => []],
            'app' => ['sent' => 0, 'failed' => 0, 'errors' => []],
        ];

        Log::info('NotificationService - Total recipients: ' . count($recipients));

        // Get notification methods from the reminder instead of recipients
        $methods = $this->parseNotificationMethods($reminder);

        foreach ($recipients as $index => $recipient) {
            if (!$this->isValidRecipient($recipient)) {
                Log::warning("Skipping invalid recipient at index {$index}", ['data' => $recipient]);
                continue;
            }

            Log::info("Processing recipient #{$index} ({$recipient->id})", [
                'email' => $recipient->email,
                'phone' => $recipient->phone ?? $recipient->mobile,
            ]);

            // EMAIL
            if ($methods['email'] && $recipient->email) {
                try {
                    $this->sendEmailNotification($reminder, $recipient);
                    $results['email']['sent']++;
                } catch (\Exception $e) {
                    $this->logFailure($results['email'], $recipient->email, $e, 'Email');
                }
            }

            // SMS
            $hasPhone = $this->hasValidPhone($recipient);
            if ($methods['sms'] && $hasPhone) {
                try {
                    $this->sendSmsNotification($reminder, $recipient);
                    $results['sms']['sent']++;
                } catch (\Exception $e) {
                    $this->logFailure($results['sms'], $recipient->phone ?? $recipient->mobile, $e, 'SMS');
                }
            }

            // APP
            if ($methods['app']) {
                try {
                    $this->sendAppNotification($reminder, $recipient);
                    $results['app']['sent']++;
                } catch (\Exception $e) {
                    $this->logFailure($results['app'], $recipient->id, $e, 'App');
                }
            }
        }

        Log::info('NotificationService - Final results:', $results);

        $this->logNotificationActivity($reminder, $results);

        return $results;
    }

    private function isValidRecipient($recipient): bool
    {
        return is_object($recipient) && $recipient instanceof User;
    }

    private function logFailure(array &$resultArray, $identifier, \Exception $e, string $type): void
    {
        $resultArray['failed']++;
        $resultArray['errors'][] = "Failed to send {$type} to {$identifier}: " . $e->getMessage();
        Log::error("{$type} notification failed", [
            'identifier' => $identifier,
            'error' => $e->getMessage(),
        ]);
    }

    private function sendEmailNotification(Reminder $reminder, User $recipient)
    {
        Mail::to($recipient->email)->send(new ReminderNotification($reminder, $recipient));
    }

    private function sendSmsNotification(Reminder $reminder, User $recipient): array
    {
        $phone = $this->formatPhoneNumber($recipient->phone ?? $recipient->mobile);

        $response = Http::retry(3, 500) // Retry 3 times with 500ms delay
        ->timeout(10) // 10-second timeout
        ->withHeaders([
            'Authorization' => 'Bearer ' . config('services.textbee.api_key'),
            'Accept' => 'application/json',
        ])->post(config('services.textbee.base_url') . '/send', [
            'sender_id' => config('services.textbee.sender_id'),
            'mobile_number' => $phone,
            'message' => $this->buildSmsMessage($reminder),
        ]);

        $responseData = $response->json();

        if ($response->failed()) {
            Log::error("TextBee SMS Failed", [
                'error' => $responseData['message'] ?? $response->body(),
                'phone' => $phone,
            ]);
            throw new \Exception("TextBee Error: " . ($responseData['message'] ?? "Unknown error"));
        }

        Log::info("SMS Sent via TextBee", [
            'reminder_id' => $reminder->id,
            'recipient' => $recipient->id,
            'response' => $responseData,
        ]);

        return $responseData;
    }

    private function sendAppNotification(Reminder $reminder, User $recipient)
    {
        $data = [
            'id' => uniqid(),
            'type' => 'reminder',
            'title' => 'Reminder: ' . $reminder->title,
            'message' => $this->buildAppMessage($reminder),
            'reminder_id' => $reminder->id,
            'created_at' => now()->toISOString(),
            'read_at' => null,
            'data' => [
                'reminder' => [
                    'id' => $reminder->id,
                    'title' => $reminder->title,
                    'start_datetime' => $reminder->start_datetime,
                    'location' => $reminder->location,
                    'category' => $reminder->category->name ?? 'General',
                ]
            ]
        ];

        $recipient->notifications()->create([
            'id' => $data['id'],
            'type' => 'App\Notifications\ReminderNotification',
            'notifiable_type' => User::class,
            'notifiable_id' => $recipient->id,
            'data' => json_encode($data['data']),
            'created_at' => now(),
        ]);

        event(new ReminderNotificationSent($recipient, $data));
    }

    private function parseNotificationMethods(Reminder $reminder): array
    {
        $defaults = ['email' => false, 'sms' => false, 'app' => false];

        if (empty($reminder->notification_methods)) {
            return $defaults;
        }

        try {
            $methods = $reminder->notification_methods;

            // Decode if it's a string (JSON)
            if (is_string($methods)) {
                $methods = json_decode($methods, true);
            }

            // Ensure it's still an array
            if (!is_array($methods)) {
                throw new \Exception("notification_methods is not an array after decoding.");
            }

            return array_merge($defaults, $methods);
        } catch (\Exception $e) {
            Log::error('Failed to parse notification methods', [
                'reminder_id' => $reminder->id,
                'methods' => $reminder->notification_methods,
                'error' => $e->getMessage()
            ]);
            return $defaults;
        }
    }

    private function getRecipients(Reminder $reminder)
    {
        return match ($reminder->recipient_type) {
            'public' => User::all(),
            'private' => collect([$reminder->user]),
            'custom' => $reminder->customRecipients()->get()->map(fn($r) => $r instanceof User ? $r : $r->user)->filter(),
            default => collect(),
        };
    }

    private function hasValidPhone($recipient): bool
    {
        $phone = $recipient->phone ?? $recipient->mobile;
        return !empty($phone) && strlen(preg_replace('/\D/', '', $phone)) >= 10;
    }

    private function formatPhoneNumber($number)
    {
        // Add logic to sanitize/format if needed
        return $number;
    }

    private function buildSmsMessage(Reminder $reminder): string
    {
        return "Reminder: {$reminder->title} on {$reminder->start_datetime->format('M d, Y h:i A')} at {$reminder->location}.";
    }

    private function buildAppMessage(Reminder $reminder): string
    {
        return "Don't forget: {$reminder->title} starts on " . Carbon::parse($reminder->start_datetime)->format('F j, Y h:i A');
    }

    private function logNotificationActivity(Reminder $reminder, array $results)
    {
        Log::info("Reminder notification results for Reminder ID {$reminder->id}", $results);
    }
}
