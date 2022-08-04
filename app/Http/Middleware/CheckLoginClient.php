<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLoginClient
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
        if (Auth::check()) {
            $user = Auth::user();
            // nếu role = 0 (admin), status =  0 (actived) thì cho qua.
            if ($user->status == 0) {
                return $next($request);
            }
             else {
                Auth::logout();
                session()->flash('error', 'Tài khoản của bạn chưa được kích hoạt!');
                return redirect()->route('auth.login');
            }
        } else {
            return redirect('auth/login');
        }
    }
}
