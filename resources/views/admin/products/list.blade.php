@extends('layout.master-admin')
@section('title', 'Danh sách sản phẩm')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <div class="alert alert-default-info">
            <h3 class="text-center">Danh sách sản phẩm</h3>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-1 float-right">Thêm mới</a>
        <thead>
            <tr>
                <th>Mã id</th>
                <th>Tên</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Kích cỡ</th>
                <th>Mô tả</th>
                <th>Danh mục</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nameProduct }}</td>
                    <td><img src="{{ asset($item->avatar) }}" width="100px" alt=""></td>
                    <td>{{ $item->price }}</td>
                    <td>
                        @if ($item->size === 1)
                            Cỡ nhỏ
                        @elseif ($item->size === 2)
                            Cỡ vừa
                        @else
                            Cỡ lớn
                        @endif
                    </td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->name }}</td>
                    <td style="display: flex;">
                        <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-warning mx-2">Sửa</a>
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa')">
                            <form action="{{ route('admin.products.delete', $item->id) }}" method="post">
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
        {{ $products->links() }}
    </div>
@endsection
