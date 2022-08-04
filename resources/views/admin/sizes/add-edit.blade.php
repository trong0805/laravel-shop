@extends('layout.master-admin')
@section('title', 'Thêm kích cỡ sản phẩm')
@section('content')
    <form action="{{ isset($size) ? route('admin.sizes.update', $size->id) : route('admin.sizes.store') }}" method="POST">
        <div class="alert alert-default-info">
            <h3 class="text-center">Thêm kích cỡ sản phẩm</h3>
        </div>
        @csrf
        {{ isset($size) ? method_field('PUT') : '' }}
        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label">Tên kích cỡ</label>
            <input type="text" name="nameSize" placeholder="Nhập tên kích cỡ" class="form-control"
                value="{{ isset($size) ? $size->nameSize : old('nameSize') }}" />
            @if (session()->has('errorr'))
                <p class="text-danger">{{ session()->get('errorr') }}</p>
            @endif
        </div>
        @if (!isset($size))
            <div class="form-outline mb-4">
                <label class="form-label">Trạng thái</label> <br>
                <input type="radio" name="statusSize" value="0" /> Hiển thị
                <input type="radio" name="statusSize" value="1" /> Ẩn
            </div>
            @if (session()->has('error'))
                <p class="text-danger">{{ session()->get('error') }}</p>
            @endif
        @else
            <div class="form-outline mb-4" hidden>
                <label class="form-label">Trạng thái</label> <br>
                <input type="radio" name="statusSize" value="0" {{ $size->statusSize === 0 ? 'checked' : '' }} />
                Hiển thị
                <input type="radio" name="statusSize" value="1" {{ $size->statusSize === 1 ? 'checked' : '' }} /> Ẩn
            </div>
        @endif
        <!-- Submit button -->
        <div>
            <button type="reset" class="btn btn-danger">reset</button>
            <button type="submit" class="btn btn-primary">{{ isset($size) ? 'Sửa' : 'Thêm' }}</button>
        </div>

    </form>
    {{-- </div> --}}
@endsection
