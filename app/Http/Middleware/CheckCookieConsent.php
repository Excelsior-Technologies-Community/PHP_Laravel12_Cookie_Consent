<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Whitecube\LaravelCookieConsent\CookiesManager;

class CheckCookieConsent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if cookie consent has been given
        if (!$request->cookie('cookie_consent')) {
            // Redirect to cookie consent page or show banner
            return redirect()->route('cookie.consent');
        }

        return $next($request);
    }
}