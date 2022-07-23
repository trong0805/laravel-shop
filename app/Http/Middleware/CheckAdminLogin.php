<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // nếu user đã đăng nhập
        if (Auth::check()) {
            $user = Auth::user();
            // nếu role = 0 (admin), status =  0 (actived) thì cho qua.
            if ($user->role == 0 && $user->status == 0) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('auth.login');
            }
        } else {
            return redirect('auth/login');
        }
    }
}
