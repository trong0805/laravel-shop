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
                @if ($errors->any())
                {{ $errors->all()[1] }}
                @endif
        </div>
        <div class="form-outline mb-4">
            <label class="form-label">Ảnh sản phẩm</label> <br>
            <img src="{{ isset($data) ? asset($data->avatar) : '' }}" width="300px" alt="">
            <input type="file" name="avatar" value="{{ isset($data) ? $data->avatar : old('avatar') }}"
                placeholder="Chọn ảnh sản phẩm" class="form-control" />
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
            <input type="radio" name="statusPrd" value="0" {{ $data->statusPrd === 0 ? 'checked' : '' }}/> Hiển thị
            <input type="radio" name="statusPrd" value="1" {{ $data->statusPrd === 1 ? 'checked' : '' }}/> Ẩn
        </div>
        @endif
        <div class="form-outline mb-4">
            <label class="form-label">Kích cỡ</label> <br>
            <select name="size" id="">
                <option value="">Chọn kích cỡ sản phẩm</option>
                <option value="1">Cỡ nhỏ</option>
                <option value="2">Cỡ vừa</option>
                <option value="3">Cỡ lớn</option>
            </select>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label">Danh mục sản phẩm</label> <br>
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
