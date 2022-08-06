@extends('layout.master-admin')
@section('title', 'Danh sách danh mục bài viết')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        
        <div class="alert alert-default-info">
            <h3 class="text-center">Danh sách danh mục sản phẩm</h3>
        </div>
        <a href="{{ route('admin.categoryProduct.create') }}" class="btn btn-primary mb-1 float-right">Thêm mới</a>
        <thead>
            <tr>
                <th>Mã id</th>
                <th>Tên</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoryProducts as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <a onclick="return confirm('Bạn có muốn thay đổi trạng thái danh mục {{ $item->name }}!')">
                            <form action="{{ route('admin.categoryProduct.updateStatus', $item->id) }}" method="post">
                                @csrf
                                @if ($item->statusCate === 1)
                                    <i class="fab fa-circle rounded-circle alert-danger"></i> Ẩn <button type="submit"  style="background: transparent; border: transparent"><i class="fa fa-redo"></i></button>
                                @else
                                    <i class="fab fa-circle rounded-circle alert-success"></i> Hiện thị <button type="submit" style="background: transparent; border: transparent"><i class="fa fa-redo"></i></button>
                                @endif
                            </form>
                        </a>
                    </td>
                    <td style="display: flex;">
                        <a href="{{ route('admin.categoryProduct.edit', $item->id) }}" class="btn btn-warning mx-2">Sửa</a>
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục {{ $item->name }}?')">
                            <form action="{{ route('admin.categoryProduct.delete', $item->id) }}" method="post">
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
        {{ $categoryProducts->links() }}
    </div>
@endsection
