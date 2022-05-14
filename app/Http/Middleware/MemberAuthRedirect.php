<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Libraries\MemberAuth;

class MemberAuthRedirect
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
        if (!MemberAuth::isLoggedIn()) {
            // echo view('admin.alert', [
            //     'icon_type' => 'info',
            //     'message' => '請登入會員!',
            //     'redirect' => MemberAuth::HOME
            // ]);
            
            return redirect(MemberAuth::HOME);
        }
        
        return $next($request);
    }
}
