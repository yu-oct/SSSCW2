<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check user is admin
        if(auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        // if not, error response
        return redirect()->route('dashboard')->with('Not be authorized', 403);
    
    }
}
