<?php

namespace Étula\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TeacherAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param null|mixed $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->type == 'teacher') {
            return $next($request);
        } else {
            abort(403,'Unauthorized: teacher access only');
        }
    }
}