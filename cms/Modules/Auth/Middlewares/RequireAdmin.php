<?php

namespace Cms\Modules\Auth\Middlewares;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class RequireAdmin
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
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return $next($request);
        } else {
            abort(404); 
        }
    }
}
