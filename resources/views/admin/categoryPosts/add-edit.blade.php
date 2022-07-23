@extends('layout.master-admin')
@section('title', 'Thêm danh mục bài viết')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
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
        <!-- Submit button -->
        <div>
            <button type="reset" class="btn btn-danger">reset</button>
            <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Sửa' : 'Thêm' }}</button>
        </div>

    </form>
    {{-- </div> --}}
@endsection
