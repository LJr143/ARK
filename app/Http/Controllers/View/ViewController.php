<?php

namespace App\Http\Controllers\View;

class ViewController
{

    public function MemberDashboard()
    {
        return view('ark.member.pages.dashboard');
    }

    public function AdminDashboard()
    {
        return view('ark.admin.dashboard');
    }

    public function MemberRegistration()
    {
        return view('ark.member.pages.registration.membership-registration');
    }

    public function ManageReminder($reminder)
    {
        return view('ark.admin.reminders.manage-reminder', compact('reminder'));
    }

    public function payment()
    {
        return view('ark.admin.payment.index');
    }

    public function transactions()
    {
        return view ('ark.admin.Transaction.index');
    }

    public function accountSettings()
    {
        return view('ark.settings.profile-settings');
    }

    public function computationalRequest()
    {
        return view('ark.admin.request.index');
    }
}
