<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\CustomNotification;
use Illuminate\Support\Facades\Log;

class ComputationRequestNotificationService
{
    public function notifyAdminsOfNewRequest(array $memberData, string $additionalMessage = '', string $referenceNumber = null)
    {
        try {
            $admins = $this->getAdminUsers();

            $notificationData = [
                'computation_request_id' => $referenceNumber,
                'member_data' => $memberData,
                'additional_message' => $additionalMessage,
                'submitted_at' => now()->toISOString(),
                'type' => 'computation_request'
            ];

            $successCount = 0;
            $failCount = 0;

            foreach ($admins as $admin) {
                try {
                    $this->sendAdminNotification($admin, $memberData, $additionalMessage, $notificationData);
                    $successCount++;
                } catch (\Exception $e) {
                    $failCount++;
                    Log::error('Failed to send computation request notification to admin', [
                        'admin_id' => $admin->id,
                        'admin_email' => $admin->email,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            Log::info('Computation request admin notifications sent', [
                'success_count' => $successCount,
                'fail_count' => $failCount,
                'reference_number' => $referenceNumber
            ]);

            return [
                'success' => $successCount,
                'failed' => $failCount,
                'total_admins' => count($admins)
            ];

        } catch (\Exception $e) {
            Log::error('Failed to process computation request admin notifications', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function sendMemberConfirmation(array $memberData, string $referenceNumber, string $additionalMessage = '')
    {
        try {
            // Find the member user if they exist in the system
            $member = User::where('email', $memberData['email'])->first();

            if (!$member) {
                Log::info('Member not found in system for confirmation email', [
                    'email' => $memberData['email'],
                    'reference_number' => $referenceNumber
                ]);
                return false;
            }

            $notificationData = [
                'computation_request_id' => $referenceNumber,
                'member_data' => $memberData,
                'additional_message' => $additionalMessage,
                'submitted_at' => now()->toISOString(),
                'type' => 'computation_request_confirmation'
            ];

            $notification = new CustomNotification(
                'Computation Request Confirmation',
                $this->buildMemberConfirmationMessage($memberData['name'], $referenceNumber),
                'computation_request_confirmation',
                'normal',
                $notificationData,
                $member->id,
            );

            $member->notify($notification);

            Log::info('Computation request confirmation sent to member', [
                'member_id' => $member->id,
                'reference_number' => $referenceNumber
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('Failed to send computation request confirmation to member', [
                'member_email' => $memberData['email'] ?? 'unknown',
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    private function getAdminUsers()
    {
        return User::where('role', 'admin')
            ->orWhere('is_admin', true)
            ->get();

        // Alternative for role-based systems:
        // return User::whereHas('roles', function($query) {
        //     $query->where('name', 'admin');
        // })->get();
    }

    private function sendAdminNotification(User $admin, array $memberData, string $additionalMessage, array $notificationData)
    {
        $notification = new CustomNotification(
            'New Computation Breakdown Request',
            $this->buildAdminNotificationMessage($memberData, $additionalMessage),
            'computation_request',
            'high', // High priority for admin notifications
            $notificationData,
            $admin->id,
        );

        $admin->notify($notification);
    }

    private function buildAdminNotificationMessage(array $memberData, string $additionalMessage = '')
    {
        $memberName = $memberData['name'];
        $prcNumber = $memberData['prc_number'] ?? 'N/A';
        $chapter = $memberData['chapter'] ?? 'N/A';

        $message = "A new computation breakdown request has been submitted.\n\n";
        $message .= "Member Details:\n";
        $message .= "• Name: {$memberName}\n";
        $message .= "• PRC#: {$prcNumber}\n";
        $message .= "• Chapter: {$chapter}\n";
        $message .= "• Email: {$memberData['email']}\n";

        if (!empty($additionalMessage)) {
            $message .= "\nAdditional Message:\n" . $additionalMessage;
        }

        $message .= "\n\nPlease review and process this request in the admin panel.";

        return $message;
    }

    private function buildMemberConfirmationMessage(string $memberName, string $referenceNumber)
    {
        return "Dear {$memberName},\n\n" .
            "Your computation breakdown request has been successfully submitted.\n\n" .
            "Reference Number: {$referenceNumber}\n\n" .
            "We will process your request and get back to you soon.\n\n" .
            "Thank you for your patience.";
    }
}
