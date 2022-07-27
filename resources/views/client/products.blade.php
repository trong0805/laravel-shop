@extends('layout.master-client')
@section('title', 'Sản phẩm')
@section('content')
    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>new arrivals</h4>
                        <h2>sixteen products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="products">
        <div class="container" style="max-width:100%;">
            <div class="row">
                <div class="col-md-12">
                    <div class="filters">
                        <ul>
                            <li class="active" data-filter="*">
                                <h3>Tất cả sản phẩm</h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="filters-content d-flex">
                        <div class="col-md-3 col-lg-3  p-0 text-white">
                            <div class="filters">
                                <form action="" class="form-group d-flex">
                                    <input type="text" class="form-control mr-1" name="search"
                                        placeholder="Tìm kiếm tên sản phẩm"> <button class="btn btn-primary">Tìm
                                        kiếm</button>
                                </form>
                                <h4 class="p-3 mb-2" style="background-color: #f33f3f;">Lọc theo danh mục</h4>
                                <ul>
                                    <li class="active p-1 m-0 d-block text-center" data-filter="*">Tất cả sản phẩm</li>
                                    @foreach ($cate as $data)
                                        <li class="d-block p-1 m-0 text-center " data-filter=".prd{{ $data->id }}">
                                            {{ $data->name }}</li>
                                    @endforeach

                                </ul>
                                <h4 class="p-3 my-2" style="background-color: #f33f3f;">Lọc theo kích cỡ</h4>
                                <ul>
                                    <li class="p-1 m-0 d-block text-center capitalize">Cỡ nhỏ</li>
                                    <li class="p-1 m-0 d-block text-center capitalize">Cỡ vừa</li>
                                    <li class="p-1 m-0 d-block text-center capitalize">Cỡ lớn</li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-md-9 col-lg-9">
                            <div class="row grid">
                                @foreach ($products as $item)
                                    <div class="col-lg-4 col-md-4 all prd{{ $item->category_id }}">
                                        <div class="product-item">
                                            <a href="{{ route('page.product-detail', $item->id) }}"><img
                                                    src="{{ asset($item->avatar) }}" alt=""></a>
                                            <div class="down-content">
                                                <a href="{{ route('page.product-detail', $item->id) }}" class="d-block">
                                                    <h5 class="text-capitalize nameCut">{{ $item->nameProduct }}</h5>
                                                </a>
                                                <p class="m-0">Giá : {{ number_format($item->price) }} <sup>đ</sup></p>
                                                <div class="d-flex justify-content-between">
                                                    <p class="my-0">Loại : {{ $item->name }}</p>
                                                    <p class="my-0">Kích cỡ : {{ $item->nameSize }}
                                                </div>
                                                </p>
                                                <ul class="stars">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                {{-- <span>Reviews (72)</span> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        <div>{{ $products->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
<style>
    .filters>ul li:hover {
        box-sizing: border-box;
        background-color: rgb(255, 255, 255);
        border-bottom: 0.4px solid #f33f3f;
    }
  
</style>
