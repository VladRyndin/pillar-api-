<?php

namespace App\Http\Middleware;

use Closure;

class PillarApiMiddleware
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
        if (empty($request->input("_token"))) {
            return response()->json(["Api token mismatch"], 401);
        }

        if (!\App\Eloquent\User::where("api_token", $request->input("_token"))->first()) {
            return response()->json(["Api token is invalid"], 401);
        }

        return $next($request);
    }
}
