@extends('layout.master-admin')
@section('title', 'Thêm sản phẩm')
@section('content')
    @if ($errors->any() || session()->has('error'))
        <div class="alert alert-danger">
            <ul>
                {{-- {{ dd($errors->all()); }} --}}

                <li>{{ session()->get('error') }}</li>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ isset($data) ? route('admin.products.update', $data->id) : route('admin.products.store') }}"
        method="POST" enctype="multipart/form-data">
        <div class="alert alert-default-info">
            <h3 class="text-center">Thêm sản phẩm</h3>
        </div>
        @csrf
        {{ isset($data) ? method_field('PUT') : '' }}
        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="nameProduct" placeholder="Tên sản phẩm" class="form-control"
                value="{{ isset($data) ? $data->nameProduct : old('nameProduct') }}" />
        </div>
        <div class="form-outline mb-4">
            <label class="form-label">Giá sản phẩm</label>
            <input type="text" name="price" placeholder="Giá sản phẩm" class="form-control"
                value="{{ isset($data) ? $data->price : old('price') }}" />
        </div>
        <div class="form-outline mb-4 d-flex">
            <div class="col-md-6">
                <label class="form-label">Ảnh sản phẩm</label> <br>
                <input type="file" name="avatar" class="form-control"
                    value="{{ isset($data) ? $data->avatar : old('avatar') }}" placeholder="Chọn ảnh sản phẩm" />
                <img src="{{ isset($data) ? asset($data->avatar) : '' }}" width="300px" alt="">
            </div>
            <div class="col-md-6">
                <label class="form-label">Thư viện ảnh</label> <br>
                <input type="file" name="filenames[]" multiple class="form-control"
                    placeholder="Chọn ảnh sản phẩm" />
            </div>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label">Mô tả sản phẩm</label>
            <input type="text" name="description" placeholder="Mô tả sản phẩm" class="form-control"
                value="{{ isset($data) ? $data->description : old('description') }}" />
            {{-- <textarea name="description"  placeholder="Mô tả sản phẩm" class="form-control"
                value="{{ isset($data) ? $data->description : old('description') }}" class="form_input"> --}}
            {{-- </textarea> --}}
        </div>
        @if (!isset($data))
            <div class="form-outline mb-4">
                <label class="form-label">Trạng thái</label> <br>
                <input type="radio" name="statusPrd" value="0" /> Hiển thị
                <input type="radio" name="statusPrd" value="1" /> Ẩn
            </div>
        @else
            <div class="form-outline mb-4" hidden>
                <label class="form-label">Trạng thái</label> <br>
                <input type="radio" name="statusPrd" value="0" {{ $data->statusPrd === 0 ? 'checked' : '' }} /> Hiển
                thị
                <input type="radio" name="statusPrd" value="1" {{ $data->statusPrd === 1 ? 'checked' : '' }} /> Ẩn
            </div>
        @endif
        <div class="form-outline mb-4 d-flex">
            <div class="col-md-6">
                <label class="form-label">Kích cỡ</label> <br>
                <select class="w-100 p-2" name="size_id" id="">
                    <option value="">Chọn kích cỡ sản phẩm</option>
                    @foreach ($sizes as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($data) && $data->size_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nameSize }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Danh mục sản phẩm</label> <br>
                <select class="w-100 p-2" name="category_id" id="">
                    <option value="">Chọn danh mục sản phẩm</option>
                    @foreach ($cate as $item)
                        {{-- <option value="{{ $item->id }}" {{ isset($data) && $data->category_id ? 'selected' : '' }} >{{ isset($data) && $data->category_id ? $data->name : $item->name }}</option> --}}
                        <option value="{{ $item->id }}"
                            {{ isset($data) && $data->category_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- Submit button -->
        <div>
            <button type="reset" class="btn btn-danger">reset</button>
            <button type="submit" class="btn btn-primary">{{ isset($data) ? 'Sửa' : 'Thêm' }}</button>
        </div>

    </form>
    {{-- </div> --}}
@endsection
