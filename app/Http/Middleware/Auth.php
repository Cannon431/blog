<?php

namespace App\Http\Middleware;

use Closure;
use Auth as A;

class Auth
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
        if (!A::check()) return redirect('/login');
        return $next($request);
    }
}
