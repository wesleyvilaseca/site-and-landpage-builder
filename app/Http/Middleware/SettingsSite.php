<?php

namespace App\Http\Middleware;

use App\Models\WebSite;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SettingsSite
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
        $site_id = session()->get('website_id');
        if (!$site_id) {
            Auth::logout();
            return Redirect::route('login');
        }

        $website = WebSite::where(['id' => $site_id, 'user_id' => auth()->user()->id])->first();

        if (!$website) {
            Auth::logout();
            return Redirect::route('login');
        }

        return $next($request);
    }
}
