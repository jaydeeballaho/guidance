<?php

namespace App\Http\Middleware;

use Closure;

class IsCouncelor
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
        if(auth()->user()->role != 1)
            abort(401);
        else
            return $next($request);
    }
}
