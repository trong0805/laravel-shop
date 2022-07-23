@extends('layout.master-admin')
@section('title', 'Danh sách tài khoản')
@section('content')
    <table class="table table-bordered">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <thead>
            <tr>
                <th>Mã id</th>
                <th>Tên</th>
                <th>Ảnh</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Trạng thái</th>
                <th>Quyền</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataUser as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td><img src="{{ $item->avatar }}" width="60px" alt=""></td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <a onclick="return confirm('Bạn có muốn thay đổi trạng thái!')">
                            <form action="{{ route('admin.users.updateStatus', $item->id) }}" method="post">
                                @csrf
                                
                                @if ($item->status === 1)
                                    <i class="fab fa-circle alert-danger"></i> Không kích hoạt <button type="submit"  style="background: transparent; border: transparent"><i class="fa fa-redo"></i></button>
                                @else
                                    <i class="fab fa-circle alert-success"></i> Kích hoạt <button type="submit" style="background: transparent; border: transparent"><i class="fa fa-redo"></i></button>
                                @endif
                            </form>
                        </a>

                    </td>
                    <td>{{ $item->role === 1 ? 'Khách hàng' : 'Admin' }}</td>
                    <td>
                        @if ($item->role === 0)
                        @else
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa')">
                                <form action="{{ route('admin.users.delete', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </a>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $dataUser->links() }}
    </div>
@endsection
