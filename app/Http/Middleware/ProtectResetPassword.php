<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ProtectResetPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->is_reset_password || Auth::user()->first_login) {
            return $next($request);
        } else {
            return back()->with('danger', 'Permisson denied');
        }

    }
}
