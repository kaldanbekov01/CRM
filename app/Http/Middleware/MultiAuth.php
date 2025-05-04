<?php

// app/Http/Middleware/MultiAuth.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MultiAuth
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('web')->check() || Auth::guard('employee')->check()) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
