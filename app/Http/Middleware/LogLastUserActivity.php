<?php namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LogLastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * This function update cache for last user activity on every request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
		    $expiresAt = Carbon::now()->addMinutes(2);
		    Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
		    Cache::forever('last_session_activity_time_'. Auth::user()->id, Carbon::now()->format('Y-m-d H:i:s'));
		}
        return $next($request);
    }
}
