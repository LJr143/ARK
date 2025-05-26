<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MemberAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, $permission = null): Response
    { if (!$this->isAuthenticated()) {
        return $this->redirectToLogin();
    }

        if (!$this->isMember()) {
            abort(403, 'Unauthorized action.');
        }

        $user = Auth::user();

        if ($permission && !$user->can($permission)) {
            abort(403, 'You do not have permission to access this resource.');
        }

        return $next($request);
    }


    /**
     * Check if the user is authenticated.
     */
    protected function isAuthenticated(): bool
    {
        return Auth::check();
    }

    /**
     * Check if the user has the 'member' role.
     */
    protected function isMember(): bool
    {
        return Auth::user()->hasAnyRole('member');
    }

    /**
     * Redirect to the login route with an error message.
     */
    protected function redirectToLogin(): Response
    {
        return redirect()->route('member.login')->withErrors([
            'error' => 'You must be logged in to access this page.',
        ]);
    }
}
