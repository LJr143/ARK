<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class RoleRedirectService
{
    public function redirectBasedOnRole($user): \Illuminate\Http\RedirectResponse
    {

        if ($user->hasRole('superadmin')) {
            return redirect()->route('admin.dashboard');
        }
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        if ($user->hasAnyRole('member')) {
            return redirect()->route('member.dashboard');
        }

        Auth::logout();
        return redirect()->route('member.login')->withErrors(['error' => 'No valid role assigned.']);
    }
}
