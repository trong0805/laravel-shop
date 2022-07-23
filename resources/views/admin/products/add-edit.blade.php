@extends('layout.master-admin')
@section('title', 'Thêm sản phẩm')
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
        <div class="form-outline mb-4">
            <label class="form-label">Ảnh sản phẩm</label> <br>
            <img src="{{ isset($data) ? asset($data->avatar) : '' }}" width="300px" alt="">
            <input type="file" name="avatar" value="{{ isset($data) ? $data->avatar : old('avatar') }}"  placeholder="Chọn ảnh sản phẩm" class="form-control" />
        </div>
        <div class="form-outline mb-4">
            <label class="form-label">Mô tả sản phẩm</label>
            <input type="text" name="description" placeholder="Mô tả sản phẩm" class="form-control"
                value="{{ isset($data) ? $data->description : old('description') }}" />
                {{-- <textarea name="description"  placeholder="Mô tả sản phẩm" class="form-control"
                value="{{ isset($data) ? $data->description : old('description') }}" class="form_input"> --}}
                </textarea>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label">Danh mục sản phẩm</label>
            <select name="category_id" id="">
                <option value="">Chọn danh mục sản phẩm</option>
                @foreach ($cate as $item)
                    {{-- <option value="{{ $item->id }}" {{ isset($data) && $data->category_id ? 'selected' : '' }} >{{ isset($data) && $data->category_id ? $data->name : $item->name }}</option> --}}
                    <option value="{{ $item->id }}" {{ isset($data) && $data->category_id ? 'selected' : '' }}>
                        {{ isset($data) && $data->category_id ? $item->name : $item->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Submit button -->
        <div>
            <button type="reset" class="btn btn-danger">reset</button>
            <button type="submit" class="btn btn-primary">{{ isset($data) ? 'Sửa' : 'Thêm' }}</button>
        </div>

    </form>
    {{-- </div> --}}
@endsection