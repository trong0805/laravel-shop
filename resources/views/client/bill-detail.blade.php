@extends('layout.master-client')
@section('title', 'Hóa đơn chi tiết')
@section('content')
    <div class="page-heading about-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>Hóa đơn chi tiết</h4>
                        <h2>Cảm ơn đã mua hàng</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('page.orders.bill') }}" class="btn btn-success ml-3">Quay lại</a>
    </div>
    <div class="col-lg-8 col-md-8 m-auto border border border-danger">
        <div class="d-flex">
            <div class="text-uppercase">
                <h2 class="font-weight-bolder">Sixteen <em style="color: #f33f3f; font-style: normal;">furniture</em></h2>
            </div>
        </div>
        <div class="w-100">
            <h3 class="text-center">Hóa đơn mua hàng</h3>
            <h6 class="text-center">{{ $tt->orderDate }}</h6>
            <div class="p-3 col-lg-10 m-auto">
                <div class="d-flex">
                    <div class="col-lg-6"><b>Tên khách hàng: </b>{{ $tt->orderName }}</div>
                    <div class="col-lg-6"><b>Số điện thoại: </b> {{ $tt->numberPhone }}</div>
                </div>
                <div class="d-flex">
                    <div class="col-lg-6"><b>Email: </b> {{ $tt->orderEmail }}</div>
                    <div class="col-lg-6"><b>Địa chỉ: </b> {{ $tt->address }}</div>
                </div>
            </div>
        </div>
        <div class="">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        {{-- <th>Ảnh</th> --}}
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $item->oddNamePrd }}</td>
                            {{-- <td><img src="{{ asset($item->avatar )}}" width="100px" alt=""></td> --}}
                            <td>{{ number_format($item->oddPricePrd) }}<sup>đ</sup></td>
                            <td>{{ $item->oddQuantityPrd }}</td>
                            <td>{{ number_format($item->oddPricePrd * $item->oddQuantityPrd) }}<sup>đ</sup></td>
                            <p hidden>{{ $total += $item->oddPricePrd * $item->oddQuantityPrd }}</p>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Tiền giao hàng:</td>
                        <td colspan="1">{{ number_format(800000) }}<sup>đ</sup></td>
                    </tr>
                    <tr>
                        <td colspan="3">Tổng tiền:</td>
                        <td colspan="1">{{ number_format($total+800000) }}<sup>đ</sup></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
