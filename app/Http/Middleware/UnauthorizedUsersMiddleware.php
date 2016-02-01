<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UnauthorizedUsersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->guest()) {
          if ($request->ajax() || $request->wantsJson()) {
              return redirect()->guest('login');
          } else {
              return response('Unauthorized.', 401);
          }
        }

        return $next($request);
    }
}
