<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if (in_array($request->user()->role, $levels)) {
            return $next($request);
        }

        abort(403);
    }
}
