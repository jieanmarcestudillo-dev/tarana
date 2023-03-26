<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SingleUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);

        $userId = auth()->id();
        $sessionKey = 'single_user_' . $userId;

        if (Session::get($sessionKey) === null) {
            Session::put($sessionKey, true);
            return $next($request);
        }

        return redirect()->route('/applicantsAuthentication')->with('error', 'You are already logged in!');
    }
}
