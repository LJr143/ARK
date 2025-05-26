<?php

namespace App\Http\Controllers\Admin;

use App\Models\UAPMembers;
use App\Models\User;
use App\Notifications\MembershipCredentialsNotification;
use App\Notifications\MembershipRejectionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MembershipApprovalController
{
    public function pendingApplications()
    {
        $applications = User::where('status', 'pending')->whereNot('id', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ark.admin.membership.pending', compact('applications'));
    }

    public function approveApplication($id)
    {
        $application = User::findOrFail($id);
        $password = Str::random(10);

        $user = User::firstOrCreate(
            ['email' => $application->email],
            [
                'name' => $application->first_name . ' ' . $application->family_name,
                'password' => bcrypt($password),
                'is_approved' => true,
            ]
        );

        // Send directly without notification
        Mail::send('emails.membership.credentials', [
            'user' => $user,
            'password' => $password
        ], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Your UAP Membership Account Credentials');
        });

        $application->update(['status' => 'approved', 'user_id' => $user->id]);

        return redirect()->back()->with('success', 'Application approved and credentials sent.');
    }

    public function rejectApplication(Request $request, $id)
    {
        $application = User::findOrFail($id);

        // Find or create user (since we need to send email)
        $user = User::firstOrCreate(
            ['email' => $application->email],
            [
                'name' => $application->first_name . ' ' . $application->family_name,
                'password' => bcrypt(Str::random(24)), // Temporary password
                'is_approved' => false,
            ]
        );

        $application->update([
            'status' => 'rejected',
            'remarks' => $request->remarks,
            'user_id' => $user->id, // Link to user
        ]);

        // Send rejection notification
        try {
            $user->notify(new MembershipRejectionNotification($request->remarks));
        } catch (\Exception $e) {
            \Log::error('Failed to send rejection email', [
                'error' => $e->getMessage(),
                'application_id' => $id
            ]);
        }

        return redirect()->back()
            ->with('success', 'Application rejected and notification sent.');
    }
}
