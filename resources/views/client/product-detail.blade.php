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
                            <li class="active" style="font-size: 32px;" data-filter="*">Chi tiết sản phẩm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="col-lg-7 col-md-7">
                        <img width="100%" id="imgClick" class="border" src="{{ asset($dataProduct->avatar) }}" alt="">
                        <div class="row-grid d-flex">
                            <div class="col-lg-3">
                                <img width="100%" class="border" src="{{ asset($dataProduct->avatar) }}" onclick=" changeImage('{{asset($dataProduct->avatar)}}');" alt="">
                            </div>
                            @foreach ($galleryImages as $img)
                                <div class="col-lg-3">
                                    <img width="100%" class="border" src="{{ asset($img->image_gallery) }}" onclick=" changeImage('{{asset($img->image_gallery)}}');" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="product-item">
                            <div class="down-content">
                                {{-- <h3> --}}
                                <h4 style="font-size: 38px;">{{ $dataProduct->nameProduct }}</h4>
                                @foreach ($cate as $item)
                                    @if ($item->id === $dataProduct->category_id)
                                        <p class="mb-1">Loại sản phẩm: {{ $item->name }}</p>
                                    @endif
                                @endforeach
                                {{-- </h3> --}}
                                @foreach ($sizes as $item)
                                    @if ($item->id === $dataProduct->size_id)
                                        <p class="mb-3">Kích cỡ: {{ $item->nameSize }}</p>
                                    @endif
                                @endforeach
                                <p style="font-size: 26px; color: rgb(255, 85, 85);"> Giá:
                                    {{ number_format($dataProduct->price) }}<sup>đ</sup></p>
                                <p> {{ $dataProduct->description }}</p>
                                {{-- thêm vào giỏ --}}
                                <form action="{{ route('page.carts.storeCart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="productId" value="{{ $dataProduct->id }}">
                                    <input type="hidden" name="userId" value="{{ Auth::user() ? Auth::user()->id : '' }}">
                                    <input type="hidden" name="price" value="{{ $dataProduct->price }}">
                                    <input name="quantity" class="input-qty" max="10" min="1" type="number"
                                        value="1">
                                    <button type="submit" class="btn btn-danger">Thêm vào giỏ hàng</button>
                                </form>
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>   
                            </div>
                             <div class="col-md-12">
                                    <div class="left-content">
                                        <ul class="social-icons">
                                            <li><a href="#" style="padding: 16px;"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#" style="padding: 16px;"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#" style="padding: 16px;"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#" style="padding: 16px;"><i class="fa fa-behance"></i></a></li>
                                        </ul>
                                    </div>
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
                        <div class="product-item px-3 py-3 my-1 d-flex justify-content-between">
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
                            @if (Auth::user() && $item->user_id === Auth::user()->id)
                                <form action="{{ route('page.deleteComment', $item->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class="float-right align-content-center">
                                        <button type="submit" class="btn btn-danger">Xóa comment</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    @endforeach
                    <div class="my-2">{{ $comments->links() }}</div>
                    @if (Auth::user())
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <form action="{{ route('page.store') }}" method="POST">
                            @csrf
                            <div class="form-group d-flex">
                                <input type="hidden" value="{{ $dataProduct->id }}" name="product_id"
                                    class="form-control mr-2" placeholder="id sản phẩm">
                                <input type="text" name="content" class="form-control mr-2" placeholder="Viết bình luận">
                                <button type="submit" class="btn btn-primary">Bình luận</button>
                            </div>
                        </form>
                    @else
                        <p class="my-2 text-center">Vui lòng đăng nhập để sử dụng tính năng!</p>
                    @endif
                </div>
                {{-- //sản phẩm liên quan --}}
                <div class="col-md-12">
                    <div class="filters-content">
                        <div class="row grid">
                            @foreach ($productCate as $item)
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
        </div>
    </div>
@endsection()
<script type="text/javascript">
    function changeImage(a) {
        console.log(document.getElementById("imgClick").src="a");
        document.getElementById("imgClick").src=a;
    }
</script>