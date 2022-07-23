@extends('layout.master-login')
@section('title', 'Đăng ký')
{{-- @section('name', 'Resgiter') --}}
@section('nameBanner', 'Resgiter')
@section('content')
    <form class="login-form" action="{{ route('auth.register_store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1" class="text-uppercase">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" class="text-uppercase">Mật khẩu</label>
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" class="text-uppercase">Nhập lại mật khẩu</label>
            <input type="password" name="repassword" class="form-control" placeholder="Nhập lại mật khẩu">
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                <small>Remember Me</small>
            </label>
            <button type="submit" class="btn btn-login float-right">Đăng Ký</button>
        </div>
        <div class="form-group">
            <label class="form-check-label mt-4">
                <a href="{{ route('auth.login') }}">
                    <p class="initialism">Đã có tài khoản?</p>
                </a>
            </label>
        </div>
    </form>
@endsection
