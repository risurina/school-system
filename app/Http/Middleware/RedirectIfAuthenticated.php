<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'student':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('studentPortal.index');
                }
                break;
            case 'employee':
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;  
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;  
        }

        return $next($request);
    }
}
