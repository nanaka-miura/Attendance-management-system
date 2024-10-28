<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminStatus
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
        if ($request->is('stamp_correction_request/list')) {
        // アクセス前のパスに '/admin' が含まれているかチェック
        if (str_contains($request->headers->get('referer'), '/admin')) {
            // adminApplicationListにリダイレクト
            return redirect()->route('adminApplicationList');
        }
    }

        return $next($request);
    }
}
