<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminChecker
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->isSuperAdminExists()) {
            return redirect()->route('membership.form');
        }

        return $next($request);
    }

    /**
     * @return bool
     * Check of there is already a superadmin account registered
     */
    protected function isSuperAdminExists(): bool
    {
        return Role::where('name', 'superadmin')->whereHas('users')->exists();
    }
}
