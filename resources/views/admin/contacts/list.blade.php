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
                    <td>
                        @if ($item->action == 0)
                            <form action="{{ route('admin.contacts.updateAction', $item->id) }}" method="post">
                                @csrf
                                <select name="action" id="">
                                    <option value="{{ $item->action }}" {{ $item->action == 0 ? 'selected' : '' }}>Chưa phản
                                        hồi</option>
                                    <option value="{{ $item->action }}" {{ $item->action == 1 ? 'selected' : '' }}>Đã phản
                                        hồi</option>
                                </select>
                                <button type="submit">ok</button>
                            </form>
                        @else
                            <i class="fab fa-circle  rounded-circle alert-success"></i> Đã phản hồi
                        @endif
                    </td>
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
