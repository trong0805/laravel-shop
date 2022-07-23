@extends('layout.master-admin')
@section('title', 'Danh sách tài khoản')
@section('content')
    <table class="table table-bordered">
        <div class="alert alert-default-info">
            <h3 class="text-center">Danh sách phản hồi khách hàng</h3>
        </div>
        <thead>
            <tr>
                <th>Mã id</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->content }}</td>
                    <td>{{ $item->action === 0 ? 'Chưa phản hồi' : 'Đã phản hồi' }}</td>
                    <td>
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa')">
                            <form action="{{ route('admin.contacts.delete', $item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $contacts->links() }}
    </div>
@endsection
