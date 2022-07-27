<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
// use Auth
class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function login()
    {
        session(['link' => url()->previous()]);
        return view('login.login');
    }
    public function postLogin(AuthRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // dd($data);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            //lấy thông yin user
            $auth = Auth::user();
            // dd($user);
            if ($auth->role === 0) {
                return redirect()->route('admin.users.list');
            } elseif ($auth->role === 1 && $auth->status === 0) {
                // return redirect()->route('auth.home');
                return redirect(session('link'));
            } else {
                session()->flash('error', 'Tài khoản của bạn chưa được kích hoạt!');
                return redirect()->route('auth.login');
            }
        } else {
            session()->flash('error', 'Tài khoản hoặc mật khẩu không chính xác!');
            return redirect()->route('auth.login');
        }
    }
    public function register()
    {
        return view('login.register');
    }
    public function register_store(AuthRequest $request)
    {
        $user = new User();
        $random = Str::random(40);
        // \dd($random);
        $user->name = 'Người dùng';
        $user->username = 'Người dùng';
        $user->email = $request->email;
        $user->avatar = 'https://png.pngtree.com/png-vector/20191027/ourlarge/pngtree-avatar-vector-icon-white-background-png-image_1884971.jpg';
        $user->remember_token = $random;
        $user->email_verified_at = null;
        $user->code = Str::random(10);
        $user->role = 1;
        $user->status = 0;
        $password = Hash::make($request->password);
        if ($request->password === $request->repassword) {
            $user->password = $password;
        }
        // dd($user);
        $user->save();
        session()->flash('success', 'Tạo mới tài khoản thành công!');
        return redirect()->route('auth.register');
    }
}
