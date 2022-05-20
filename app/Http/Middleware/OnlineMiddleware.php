<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Cache;
use Closure;
use Illuminate\Http\Request;

class OnlineMiddleware
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
        if (auth()->check()) {

            $users_to_offline = User::where('user_last_activity', '<', now());
            $users_to_online = User::where('user_last_activity', '>=', now());

            if (isset($users_to_offline)) {
                $users_to_offline->update(['user_is_online' => false]);
            }

            if (isset($users_to_online)) {
                $users_to_online->update(['user_is_online' => true]);
            }

            $cache_value = Cache::put('user-is-online', auth()->id(), \Carbon\Carbon::now()->addMinutes(1));
            $user = User::find(Cache::get('user-is-online'));
            $user->user_last_activity = now()->addMinutes(1);
            $user->user_is_online = true;
            $user->save();
            
        } elseif (!auth()->check() and filled(Cache::get('user-is-online'))) {
            $user = User::find(Cache::get('user-is-online'));
            if (isset($user)) {
                $user->user_is_online = false;
                $user->save();
            }
        }

        return $next($request);
    }
}
