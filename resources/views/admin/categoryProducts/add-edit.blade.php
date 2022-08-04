@extends('layout.master-admin')
@section('title', 'Thêm danh mục bài viết')
@section('content')
    <form
        action="{{ isset($category) ? route('admin.categoryProduct.update', $category->id) : route('admin.categoryProduct.store') }}"
        method="POST">
        <div class="alert alert-default-info">
            <h3 class="text-center">Thêm danh mục sản phẩm</h3>
        </div>
        @csrf
        {{ isset($category) ? method_field('PUT') : '' }}
        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="name" placeholder="Nhập tên danh mục bài viết" class="form-control"
                value="{{ isset($category) ? $category->name : old('name') }}" />
            @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        @if (!isset($category))
            <div class="form-outline mb-4">
                <label class="form-label">Trạng thái</label> <br>
                <input type="radio" name="statusCate" value="0" /> Hiển thị
                <input type="radio" name="statusCate" value="1" /> Ẩn
            </div>
            @if (session()->has('error'))
                <p class="text-danger">{{ session()->get('error') }}</p>
            @endif
        @else
            <div class="form-outline mb-4" hidden>
                <label class="form-label">Trạng thái</label> <br>
                <input type="radio" name="statusCate" value="0" {{ $category->statusCate === 0 ? 'checked' : '' }} />
                Hiển thị
                <input type="radio" name="statusCate" value="1" {{ $category->statusCate === 1 ? 'checked' : '' }} />
                Ẩn
            </div>
            @if (session()->has('error'))
                <p class="text-danger">{{ session()->get('error') }}</p>
            @endif
        @endif
        <!-- Submit button -->
        <div>
            <button type="reset" class="btn btn-danger">reset</button>
            <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Sửa' : 'Thêm' }}</button>
        </div>

    </form>
    {{-- </div> --}}
@endsection
