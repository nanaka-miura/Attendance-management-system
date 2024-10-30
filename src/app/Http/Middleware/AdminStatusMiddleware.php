<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminStatusMiddleware
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
        if ($request->is('/stamp_correction_request/list')) {
            if (str_contains($request->headers->get('referer'), '/admin')) {
                return redirect()->route('adminApplicationList');
            } else {
                return redirect()->route('userApplicationList');
            }
        }

        return $next($request);
    }
}
