<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RemoveSiteFromSession
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
        if (session()->get('website_id')) session()->forget('website_id');
        if (session()->get('sitename')) session()->forget('sitename');

        return $next($request);
    }
}
