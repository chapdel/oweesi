<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class AuthApi
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = User::whereUid($request->headers->get('X-API-Key'))->first();

        if (!$user) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
