<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Libraries\MemberAuth;
use App\Models\Cart;

class GetCartAmount
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
        $amount = 0;

        if (MemberAuth::isLoggedIn()) {
            $memberId = Crypt::decryptString(session('memberId'));
            $amount = Cart::where('member_id', $memberId)->count();
        }

        $request->attributes->add(['cart_amount' => $amount]);
        return $next($request);
    }
}
