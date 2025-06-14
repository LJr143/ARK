<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        $auth = Auth::guard('web');

        if ($auth->check()) {
            $user = $auth->user();

            if ($user->status === 'pending') {
                $auth->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('pending-approval');
            }

            if ($user->status === 'rejected') {
                $auth->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('rejected');
            }

            if ($user->status === 'inactive') {
                $auth->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->with('error', 'Your account has been deactivated. Please contact UAP chapter admin.');
            }
        }

        return $next($request);
    }
}
