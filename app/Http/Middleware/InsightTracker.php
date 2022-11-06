<?php

namespace App\Http\Middleware;

use App\Models\Insight;
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
        Insight::create([
            'device' => $request->visitor()->device(),
            'platform' => $request->visitor()->platform(),
            'browser' => $request->visitor()->browser(),
            'languages' => json_encode($request->visitor()->languages()),
            'ip' => $request->visitor()->ip(),
            'request' => json_encode($request->visitor()->ip()),
            'useragent' => json_encode($request->visitor()->useragent()),
        ]);

        return $next($request);
    }
}
