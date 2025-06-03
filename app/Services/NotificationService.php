<?php

namespace App\Services;

use App\Models\User;
use App\Models\Reminder;
use App\Events\ReminderNotificationSent;
use App\Mail\ReminderNotification;
use App\Notifications\CustomNotification;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class NotificationService
{
    private $textBeeConfig;

    public function __construct()
    {
        $this->textBeeConfig = [
            'api_key' => config('services.textbee.api_key'),
            'device_id' => config('services.textbee.device_id'),
            'base_url' => config('services.textbee.base_url', 'https://api.textbee.dev/api/v1/gateway/devices'),
        ];
    }

    public function sendReminderNotifications(Reminder $reminder, array $recipients = null): array
    {
        $recipients = collect($recipients ?: $this->getRecipients($reminder))
            ->map(function($r) {
                if ($r instanceof User) {
                    return $r;
                }
                if (is_array($r) && isset($r['user']) && $r['user'] instanceof User) {
                    return $r['user'];
                }
                return User::find(is_array($r) ? ($r['id'] ?? null) : $r);
            })
            ->filter()
            ->all();

        $results = [
            'email' => ['sent' => 0, 'failed' => 0, 'errors' => []],
            'sms' => ['sent' => 0, 'failed' => 0, 'errors' => []],
            'app' => ['sent' => 0, 'failed' => 0, 'errors' => []],
        ];

        Log::info('NotificationService - Total recipients: ' . count($recipients));

        $methods = $this->parseNotificationMethods($reminder);
        Log::info('Selected notification methods: ', $methods);

        foreach ($recipients as $index => $recipient) {
            if (!$this->isValidRecipient($recipient)) {
                Log::warning("Skipping invalid recipient at index {$index}", ['data' => $recipient]);
                continue;
            }

            Log::info("Processing recipient #{$index} ({$recipient->id})", [
                'email' => $recipient->email,
                'id' => $recipient->id,
                'phone' => $recipient->phone ?? $recipient->mobile,
            ]);

            // EMAIL
            if ($methods['email'] && $recipient->email) {
                try {
                    $this->sendEmailNotification($reminder, $recipient);
                    $results['email']['sent']++;
                    Log::info("Email sent to {$recipient->email}");
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
                    Log::info("SMS sent to { $recipient->mobile }");
                } catch (\Exception $e) {
                    $this->logFailure($results['sms'], $recipient->phone ?? $recipient->mobile, $e, 'SMS');
                }
            }

            // APP
            if ($methods['app']) {
                try {
                    $success = $this->sendAppNotification($reminder, $recipient);
                    if ($success) {
                        $results['app']['sent']++;
                    } else {
                        $results['app']['failed']++;
                        $results['app']['errors'][] = "App notification failed for user {$recipient->id}";
                    }
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

    private function sendEmailNotification(Reminder $reminder, User $recipient): void
    {
        Mail::to($recipient->email)->send(new ReminderNotification($reminder, $recipient));
    }

    private function sendSmsNotification(Reminder $reminder, User $recipient): array
    {
        $phone = $this->formatPhoneNumber($recipient->phone ?? $recipient->mobile);

        try {
            $client = new Client();
            $response = $client->post("{$this->textBeeConfig['base_url']}/{$this->textBeeConfig['device_id']}/send-sms", [
                'headers' => [
                    'x-api-key' => $this->textBeeConfig['api_key'],
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'recipients' => [$phone],
                    'message' => $this->buildSmsMessage($reminder),
                ],
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);

            Log::info("SMS Sent via TextBee", [
                'reminder_id' => $reminder->id,
                'recipient' => $recipient->id,
                'phone' => $phone,
                'response' => $responseData,
            ]);

            return $responseData;
        } catch (RequestException $e) {
            $errorMessage = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : $e->getMessage();
            Log::error("TextBee SMS Failed", [
                'reminder_id' => $reminder->id,
                'phone' => $phone,
                'error' => $errorMessage,
            ]);
            throw new \Exception("TextBee Error: " . $errorMessage);
        }
    }

    private function sendAppNotification(Reminder $reminder, User $recipient)
    {
        try {
            $categoryName = optional($reminder->category)->name ?? 'General';

            $notificationData = [
                'reminder_id' => $reminder->id,
                'reminder' => [
                    'id' => $reminder->id,
                    'title' => $reminder->title,
                    'start_datetime' => $reminder->start_datetime->toISOString(),
                    'location' => $reminder->location ?? 'Not specified',
                    'category' => $categoryName,
                ]
            ];

            $notification = new CustomNotification(
                'Reminder: ' . $reminder->title,
                $this->buildAppMessage($reminder),
                'reminder',
                'normal',
                $notificationData,
                $recipient->id,
            );

            if ($recipient) {
                $recipient->notify($notification);
                return true;
            } else {
                Log::warning('Notification recipient is null. Notification not sent.', [
                    'reminder_id' => $reminder->id
                ]);
                return false;
            }

            return true; // Return true on success
        } catch (\Exception $e) {
            Log::error('App notification creation failed', [
                'recipient_id' => $recipient?->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e; // Re-throw to be caught by the outer try-catch
        }
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

    private function logNotificationActivity(Reminder $reminder, array $results): void
    {
        Log::info("Reminder notification results for Reminder ID {$reminder->id}", $results);
    }
}
