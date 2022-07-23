@extends('layout.master-client')
@section('title', 'Chi tiết sản phẩm')
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
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="col-lg-4 col-md-4">
                        <img width="100%" src="https://tse1.mm.bing.net/th?id=OIP.V9tfJt6DpW56jMG6cZj2-wHaFC&pid=Api&P=0"
                            alt="">
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="product-item">
                            <div class="down-content">
                                <h3>
                                    <h4 style="font-size: 38px;">{{ $dataProduct->nameProduct }}</h4>
                                    @foreach ($cate as $item)
                                        @if ($item->id === $dataProduct->category_id)
                                            <p>Loại sản phẩm: {{ $item->name }}</p>
                                        @endif
                                    @endforeach
                                </h3> <br>
                                <p style="font-size: 26px;"> Giá: {{ number_format($dataProduct->price) }}<sup>đ</sup></p>
                                <p> {{ $dataProduct->description }}</p>
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- bình luận --}}
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Bình luận</h2>
                        {{-- {{ Auth::user()->id }} --}}
                    </div>
                    @foreach ($comments as $item)
                        <div class="product-item px-3 py-3 my-1">
                            <div class="d-flex">
                                <div class="avatar mr-2">
                                    <img src="{{ $item->avatar }}" style="width: 60px;" class="rounded-circle"
                                        alt="">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h5>{{ $item->name }}</h5>
                                    <p class="text-black-50">{{ $item->dateComment }}</p>
                                </div>
                                <div class="content ml-5 my-auto">
                                    <p class="text-black-50 font-weight-bold">{{ $item->content }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form action="">
                        <div class="form-group d-flex">
                            <input type="text" name="content" class="form-control mr-2" placeholder="Viết bình luận">
                            <button type="submit" class="btn btn-primary">Bình luận</button>
                        </div>
                    </form>
                </div>
                {{-- //sản phẩm liên quan --}}
                <div class="col-md-12">
                    <div class="filters-content">
                        <div class="row grid">
                            <div class="col-lg-4 col-md-4 all gra">
                                <div class="product-item">
                                    <a href="#"><img width="100%"
                                            src="https://tse1.mm.bing.net/th?id=OIP.V9tfJt6DpW56jMG6cZj2-wHaFC&pid=Api&P=0"
                                            alt=""></a>
                                    <div class="down-content">
                                        <a href="#">
                                            <h4>Tittle goes here</h4>
                                        </a>
                                        <h6>$24.60</h6>
                                        <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla
                                            aspernatur.</p>
                                        <ul class="stars">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span>Reviews (48)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 all dev">
                                <div class="product-item">
                                    <a href="#"><img width="100%"
                                            src="https://tse1.mm.bing.net/th?id=OIP.V9tfJt6DpW56jMG6cZj2-wHaFC&pid=Api&P=0"
                                            alt=""></a>
                                    <div class="down-content">
                                        <a href="#">
                                            <h4>Tittle goes here</h4>
                                        </a>
                                        <h6>$18.75</h6>
                                        <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla
                                            aspernatur.</p>
                                        <ul class="stars">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span>Reviews (60)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 all des">
                                <div class="product-item">
                                    <a href="#"><img width="100%"
                                            src="https://tse1.mm.bing.net/th?id=OIP.V9tfJt6DpW56jMG6cZj2-wHaFC&pid=Api&P=0"
                                            alt=""></a>
                                    <div class="down-content">
                                        <a href="#">
                                            <h4>Tittle goes here</h4>
                                        </a>
                                        <h6>$12.50</h6>
                                        <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla
                                            aspernatur.</p>
                                        <ul class="stars">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span>Reviews (72)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
