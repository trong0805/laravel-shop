@extends('layout.master-login')
@section('title', 'Đăng nhập')
{{-- @section('name', 'Login') --}}
@section('nameBanner', 'Login')
@section('content')
    <form class="login-form" action="{{ route('auth.postLogin') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1" class="text-uppercase">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" class="text-uppercase">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                <small>Remember Me</small>
            </label>
            <button type="submit" class="btn btn-login float-right">Đăng nhập</button>
        </div>
        <div class="form-group">
            <label class="form-check-label mt-4">
                <a href="{{ route('auth.register') }}">
                    <p class="initialism">Tạo tài khoản mới?</p>
                </a>
            </label>
        </div>
    </form>
@endsection
