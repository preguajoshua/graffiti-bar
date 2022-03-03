<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWT
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
        if (!$request->secure() && App::environment() === 'production') {
            return redirect()->secure($request->getRequestUri());
        }
        
        JWTAuth::parseToken()->authenticate();
        return $next($request);
    }
}
