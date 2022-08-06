@extends('layout.master-client')
@section('title', 'Trang chủ')
@section('content')
    <div class="banner header-text">
        <div class="owl-banner owl-carousel">
            <div class="banner-item-01">
                <div class="text-content">
                    <h4>Best Offer</h4>
                    <h2>New Arrivals On Sale</h2>
                </div>
            </div>
            <div class="banner-item-02">
                <div class="text-content">
                    <h4>Flash Deals</h4>
                    <h2>Get your best products</h2>
                </div>
            </div>
            <div class="banner-item-03">
                <div class="text-content">
                    <h4>Last Minute</h4>
                    <h2>Grab last minute deals</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Sản phẩm mới nhất</h2>
                        <a href="{{ route('page.products') }}">Xem tất cả sản phẩm <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                @foreach ($products as $item)
                    <div class="col-lg-4 col-md-4 all prd{{ $item->category_id }} size{{ $item->size_id }}">
                        <div class="product-item">
                            <a href="{{ route('page.product-detail', $item->id) }}"><img src="{{ asset($item->avatar) }}"
                                    alt="">
                            </a>
                            <div class="hoverImg">
                                <div class="ok"></div>
                            </div>
                            <div class="down-content">
                                <a href="{{ route('page.product-detail', $item->id) }}" class="d-block hoverne">
                                    <h5 class="text-capitalize nameCut">{{ $item->nameProduct }}</h5>
                                </a>
                                <p class="text-capitalize nameContent my-1">{{ $item->description }}</p>
                                <p class="m-0">Giá : {{ number_format($item->price) }} <sup>đ</sup></p>
                                <div class="d-flex justify-content-between">
                                    <p class="my-0">Loại : {{ $item->name }}</p>
                                    <p class="my-0">Kích cỡ : {{ $item->nameSize }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="best-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Sixteen Furniture</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="left-content">
                        <h4>Tìm kiếm tất cả các mặt hàng sản phẩm bạn cần?</h4>
                        <p><a rel="nofollow" href="https://templatemo.com/tm-546-sixteen-clothing" target="_parent">This
                                template</a> is free to use for your business websites. However, you have no permission to
                            redistribute the downloadable ZIP file on any template collection website. <a rel="nofollow"
                                href="https://templatemo.com/contact">Contact us</a> for more info.</p>
                        <ul class="featured-list">
                            <li><a href="#">Chuyên bán các sản phẩm nội thất</a></li>
                            <li><a href="#">Có tất cả mẫu mã, kích cỡ</a></li>
                            <li><a href="#">Sản phẩm đa dạng phong phú</a></li>
                            <li><a href="#">Chất lượng sản phẩm cao</a></li>
                            <li><a href="#">Nhân viên, quản lí nhiệt tình, hòa đ</a></li>
                        </ul>
                        <a href="{{ route('page.contacts.contact') }}" class="filled-button">Chi tiết liên hệ</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-image">
                        <img src="assets/images/feature-image.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <div class="row">
                            <div class="col-md-8">
                                <h4><em>Sixteen</em> Furniture</h4>
                                <p>Uy tín chất lượng làm nên thương hiệu</p>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('page.products') }}" class="filled-button">Xem sản phẩm ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
