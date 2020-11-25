<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
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
       if (auth()->check() && auth()->user()->blocked) {
            auth()->logout();
                $message = 'Your account has been blocked from accessing the site.';

            return redirect()->route('login')->withMessage($message);
        }
        return $next($request);
    }
}
