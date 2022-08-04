@extends('layout.master-client')
@section('title', 'Giỏ hàng')
@section('content')
    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>new arrivals</h4>
                        <h2>sixteen products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 px-lg-0">
        <!-- For demo purpose -->
        <div class="container text-black py-5 text-center">
            <h1 class="display-4">Thông tin tài khoản</h1>
        </div>
        <!-- End -->
        @if (session()->has('success'))
            <div class="alert alert-success text-center">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="col-lg-8 m-auto">
            <ul class="accordion">
                <li>
                    <a class="text-center d-block">Thông tin tài khoản</a>
                    <div class="content">
                        <div class="d-flex">
                            <div class="col-lg-5">
                                <img src="{{ asset($dataUser->avatar) }}" width="300px" alt="">
                            </div>
                            <div class="col-lg-7 m-auto">
                                <div class="col-sm-9 my-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Tên</div>
                                        </div>
                                        <input type="text" disabled class="form-control"
                                            id="inlineFormInputGroupUsername" value="{{ $dataUser->name }}">
                                    </div>
                                </div>
                                <div class="col-sm-9 my-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Username</div>
                                        </div>
                                        <input type="text" disabled class="form-control"
                                            id="inlineFormInputGroupUsername" value="{{ $dataUser->username }}">
                                    </div>
                                </div>
                                <div class="col-sm-9 my-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Email</div>
                                        </div>
                                        <input type="text" disabled class="form-control"
                                            id="inlineFormInputGroupUsername" value="{{ $dataUser->email }}">
                                    </div>
                                </div>
                                <div class="col-sm-9 my-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Vai trò</div>
                                        </div>
                                        <input type="text" disabled class="form-control"
                                            id="inlineFormInputGroupUsername"
                                            value="{{ $dataUser->role === 0 ? 'Admin' : 'Khách hàng' }}">
                                    </div>
                                </div>
                                <div class="col-sm-9 my-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Trạng thái</div>
                                        </div>
                                        <div class="input-group-text">
                                            <p style="width: 16px; height: 16px;"
                                                class="btn-success rounded-circle d-inline-block"></p>
                                        </div>
                                        <input type="text" disabled class="form-control"
                                            id="inlineFormInputGroupUsername"
                                            value="{{ $dataUser->status === 0 ? 'Kích hoạt' : 'Ẩn' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="text-center d-block">Cập nhật thông tin</a>
                    <div class="content">
                        <div class="content">
                            {{-- @if ($errors->any()) --}}
                            <form class="d-flex" action="{{ route('page.accounts.updateAccount', $dataUser->id) }}"
                                method="POST">
                                @csrf
                                <div class="col-lg-5">
                                    <img src="{{ asset($dataUser->avatar) }}" width="300px" alt="">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Ảnh</label>
                                        <input type="file" class="form-control" name="avatar" id="exampleInputPassword1"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-lg-7 m-auto">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="email" value="{{ $dataUser->email }}">
                                        @if ($errors->has('email'))
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tên</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputPassword1"
                                            placeholder="Tên" value="{{ $dataUser->name }}">
                                        @if ($errors->has('name'))
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Họ và tên</label>
                                        <input type="text" name="username" class="form-control"
                                            id="exampleInputPassword1" placeholder="Họ và tên"
                                            value="{{ $dataUser->username }}">
                                        @if ($errors->has('username'))
                                            <p class="text-danger">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            {{-- @endif --}}
                </li>
                <li>
                    <a class="text-center d-block">Cập nhật mật khẩu</a>
                    <div class="content">
                        {{-- @if ($errors->any()) --}}
                        <form action="{{ route('page.accounts.updatePass', $dataUser->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu cũ</label>
                                <input type="password" name="pass_old" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mật khẩu cũ">
                                @if (session()->has('error'))
                                    <p class="text-danger">{{ $errors->get('error') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu mới</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mật khẩu mới">
                                @if (session()->has('error'))
                                    <p class="text-danger">{{ $errors->get('errorr') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhập lại mật khẩu mới</label>
                                <input type="password" name="repass" class="form-control" id="exampleInputPassword1"
                                    placeholder="Nhập lại mật khẩu mới">
                                @if (session()->has('error'))
                                    <p class="text-danger">{{ $errors->get('errorr') }}</p>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        {{-- @endif --}}
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection()
