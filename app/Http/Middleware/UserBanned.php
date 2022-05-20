<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class UserBanned
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->user_activated == '1' && Auth::user()->user_banned == '0') {
            return $next($request);
        } else {
            Auth::logout();
            return redirect('/login');
        }
    }
}
