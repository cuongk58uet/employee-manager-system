<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckFirstLoginOrResetPassword
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
        if(Auth::user()->first_login || Auth::user()->is_reset_password) {
            if (Auth::user()->is_admin) {
                return redirect('/admin/reset/password')->with('primary', 'Middle ware: Please change your password first');
            } else {
                return redirect('/user/reset')->with('primary', 'Middle ware: Please change your password first');
            }
        }
        return $next($request);
    }
}
