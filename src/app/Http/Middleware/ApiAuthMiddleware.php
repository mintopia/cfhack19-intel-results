<?php

namespace App\Http\Middleware;

use App\ApiKey;
use Closure;

class ApiAuthMiddleware
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
        $bearer = $request->bearerToken();
        $key = ApiKey::where('key', $bearer)->first();
        if ($key) {
            return $next($request);
        }
        abort(401, 'Unauthorized');
    }
}
