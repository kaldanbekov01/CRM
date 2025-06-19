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
        if (Auth::guard('employee')->check()) {
            return $next($request);
        }

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

