<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRegistrationCompletedMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Skip registration check for employees
        if (Auth::guard('employee')->check()) {
            return $next($request);
        }

        // ✅ Check only for users (web guard)
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            if (
                is_null($user->firstName) ||
                is_null($user->lastName) ||
                is_null($user->businessName)
            ) {
                return redirect()->route('register.step2.form');
            }
        }

        return $next($request);
    }
}

