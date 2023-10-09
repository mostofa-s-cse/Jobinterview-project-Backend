<?php

namespace App\Http\Middleware;

use Auth;
use JWTAuth;
use Closure;
use function Termwind\renderUsing;

class AdminMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $jwt = JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            $jwt = false;
        }
        if (Auth::check() || $jwt) {
            $role = auth()->user()->role;
            if ($role != "Owner") {
                return response('Unauthorized.', 401);
            }
            return $next($request);
        } else {
            return response('Unauthorized.', 401);
        }
    }
}
