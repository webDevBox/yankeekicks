<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\ApiResponse;

class ApiToken
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
        if(checkToken($request->token))
        {
            randomToken();
            return $next($request);
        }
        return response()->json(ApiResponse::authError(null,'STATUS_INVALID_TOKEN'));
    }
}
