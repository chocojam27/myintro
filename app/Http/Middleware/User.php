<?php

namespace App\Http\Middleware;

use Closure, Auth;

class User
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
        // Not Logged
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Not allowed
        if (Auth::user()->role) {
            return redirect('/admin');
        }
        return $next($request);
    }
}
