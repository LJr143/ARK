<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\RoleRedirectService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    protected RoleRedirectService $roleRedirectService;

    public function __construct(RoleRedirectService $roleRedirectService)
    {
        $this->roleRedirectService = $roleRedirectService;
    }

    /**
     * Handle authenticated user and redirect based on their role.
     */
    protected function authenticated(Request $request, $user)
    {
        return $this->roleRedirectService->redirectBasedOnRole($user);
    }

    /**
     * Show the login page or redirect if the user is already authenticated.
     */
    public function login()
    {
        if (auth()->check() && !request()->is('admin/login')) {
            return $this->authenticated(request(), auth()->user());
        }
        return view('ark.member.auth.login');
    }


    /**
     * Handle login authentication and input validation
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::user());
        }

        return back()
            ->with('auth_error', 'These credentials do not match our records.')
            ->withInput($request->only('username'));
    }


    //TODO: ADMIN LOGIN

    //TODO: ADMIN AUTHENTICATION


    /**
     * Handle Google Login
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google Login Fallback and Callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                return back()
                    ->with('auth_error', 'No account registered with this email.');
            }

            // For existing users without the member role
            if (!$user->hasRole('member')) {
                $user->assignRole('member');
            }

            Auth::login($user, true);
            return $this->authenticated(request(), $user);

        } catch (\Exception $e) {
            \Log::error('Google login failed', [
                'error' => $e->getMessage(),
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('login')
                ->withErrors('Google login failed. Please try again.');
        }
    }
}
