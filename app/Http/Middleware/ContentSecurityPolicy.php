<?php

namespace App\Http\Middleware;

use Closure;

class ContentSecurityPolicy
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
        $response = $next($request);

        // Set your CSP policy here
        $csp = "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' chrome-extension://e0c59d0e-afb6-4399-a1a9-c9704dbc8841;";

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
