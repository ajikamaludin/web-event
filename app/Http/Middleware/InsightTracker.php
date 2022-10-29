<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InsightTracker
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
        // TODO: insert into insight for any request here
        // $request->visitor()->device();
        // https://github.com/shetabit/visitor
        return $next($request);
    }
}
