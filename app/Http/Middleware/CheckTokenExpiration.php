<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Events\TokenExpired;
class CheckTokenExpiration
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
        $token = JWTAuth::getToken();

        if ($token && JWTAuth::check()) {
            $payload = JWTAuth::getPayload($token)->toArray();

            // Check if the token has expired
            if ($payload['exp'] < time()) {
                // Dispatch the TokenExpired event
                event(new TokenExpired(auth()->id(), $request->input('device_id')));
            }
        }

        return $next($request);
    }
}
