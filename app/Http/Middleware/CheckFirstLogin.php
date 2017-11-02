<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckFirstLogin
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
        if(Auth::user()->first_login) {
            return redirect('/reset/password')->with('warning', 'Please change your password first');
        }
        return $next($request);
    }
}
