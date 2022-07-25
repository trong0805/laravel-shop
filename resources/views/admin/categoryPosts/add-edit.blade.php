@extends('layout.master-admin')
@section('title', 'Thêm danh mục bài viết')
@section('content')
    @if ($errors->any() || session()->has('error'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session()->get('error') }}</li>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form
        action="{{ isset($category) ? route('admin.categoryPost.update', $category->id) : route('admin.categoryPost.store') }}"
        method="POST">

        <div class="alert alert-default-info">
            <h3 class="text-center">Thêm danh mục bài viết</h3>
        </div>
        @csrf
        {{ isset($category) ? method_field('PUT') : '' }}
        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="name" placeholder="Nhập tên danh mục bài viết" class="form-control"
                value="{{ isset($category) ? $category->name : old('name') }}" />
        </div>
        @if (!isset($category))
        <div class="form-outline mb-4">
            <label class="form-label">Trạng thái</label> <br>
            <input type="radio" name="statusPost" value="0" /> Hiển thị
            <input type="radio" name="statusPost" value="1" /> Ẩn
        </div>
        @else
        <div class="form-outline mb-4" hidden>
            <label class="form-label">Trạng thái</label> <br>
            <input type="radio" name="statusPost" value="0" {{ $category->statusPost === 0 ? 'checked' : '' }}/> Hiển thị
            <input type="radio" name="statusPost" value="1" {{ $category->statusPost === 1 ? 'checked' : '' }}/> Ẩn
        </div>
        @endif
        <!-- Submit button -->
        <div>
            <button type="reset" class="btn btn-danger">reset</button>
            <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Sửa' : 'Thêm' }}</button>
        </div>

    </form>
    {{-- </div> --}}
@endsection
