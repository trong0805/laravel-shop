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
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="filters">
            <ul>
                <li class="active" data-filter="*">All Products</li>
                {{-- <li data-filter=".des">Featured</li>
                <li data-filter=".dev">Flash Deals</li> --}}
                @foreach($cate as $data)
                  <li data-filter=".prd{{ $data->id }}">{{ $data->name }}</li>
                @endforeach

            </ul>
          </div>
        </div>
        <div class="col-md-12">
          <div class="filters-content">
              <div class="row grid">
                  @foreach($products as $item)
                  <div class="col-lg-4 col-md-4 all prd{{ $item->category_id }}">
                    <div class="product-item">
                      <a href="{{ route('page.product-detail', $item->id) }}"><img src="{{ asset('assets/images/product_06.jpg') }}" alt=""></a>
                      <div class="down-content">
                        <a href="{{ route('page.product-detail', $item->id) }}" class="d-block"><h5 class="text-capitalize">{{ $item->nameProduct }}</h5></a>
                        <p class="m-0">Giá: {{ number_format($item->price) }} <sup>đ</sup></p>
                        <p>Loại sản phẩm : {{ $item->name }}</p>
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
        <div class="col-md-12">
          <div class="d-flex justify-content-center">
            <div>{{ $products->links() }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection()