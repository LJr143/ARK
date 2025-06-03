<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        $auth = Auth::guard();

        if ($auth->check()) {
            $user = $auth->user();

            if ($user->status === 'pending') {
                $auth->logout();  // Use the guard's logout method
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('pending-approval');
            }

            if ($user->status === 'rejected') {
                $auth->logout();  // Use the guard's logout method
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('rejected');
            }
        }

        return $next($request);
    }
}
