@extends('layout.master-admin')
@section('title', 'Danh sách bình luận')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <div class="alert alert-default-info">
            <h3 class="text-center">Danh sách bình luận</h3>
        </div>
        <thead>
            <tr>
                <th>Mã id</th>
                <th>Người bình luận</th>
                <th>Sản phẩm bình luận</th>
                <th>Nội dung</th>
                <th>Ngày bình luận</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->nameProduct }}</td>
                    <td>{{ $item->content }}</td>
                    <td>{{ $item->dateComment }}</td>
                    <td style="display: flex;">
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa')">
                            <form action="{{ route('admin.comments.delete', $item->id) }}" method="post">
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
        {{ $comments->links() }}
    </div>
@endsection
