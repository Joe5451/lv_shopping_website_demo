<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Libraries\AdminAuth;

class AdminAuthRedirect
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
        if (!AdminAuth::isLoggedIn()) {
            return redirect(AdminAuth::HOME);
        }
        
        return $next($request);
    }
}
