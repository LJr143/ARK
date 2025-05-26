<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class FlashFailedLoginToast
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only handle POST login requests from guest users
        if ($request->routeIs('login') &&
            $request->isMethod('post') &&
            auth()->guest()) {

            $response = $next($request);

            // Check for authentication errors
            if (Session::has('errors')) {
                $error = Session::get('errors')->first();

                // Different messages for different error types
                $message = str_contains(strtolower($error), 'throttle')
                    ? 'Too many attempts. Please try again later.'
                    : 'Invalid credentials. Please try again.';

                Session::flash('toast', [
                    'type' => 'error',
                    'message' => $message
                ]);
            }

            return $response;
        }

        return $next($request);
    }
}
