@extends('layout.master-client')
@section('title', 'Hóa đơn')
@section('content')
    <div class="page-heading about-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>Hóa đơn của bạn</h4>
                        {{-- <h2>Công ty của chúng tôi</h2> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <table class="table table-bordered mx-2">
        <div class="alert alert-default-info">
            <h3 class="text-center">Hóa đơn sản phẩm</h3>
        </div>
        <thead>
            <tr>
                {{-- <th>Mã id</th> --}}
                <th>Tên</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Mã giảm giá</th>
                <th>Ngày thanh toán</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item)
                <tr>
                    {{-- <td>{{ $item->id }}</td> --}}
                    <td>{{ $item->orderName }}</td>
                    <td>{{ $item->orderEmail }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->numberPhone }}</td>
                    <td>{{ $item->orderCoupon == null ? 'Null' : $item->orderCoupon }}</td>
                    <td>{{ $item->orderDate }}</td>
                    <td>{{ number_format($item->orderTotal) }}<sup>đ</sup></td>
                    <td>
                        @if ($item->orderStatus == 0)
                            <p>Đang xử lý hàng</p>
                            <a onclick="return confirm('Bạn có muốn hủy đơn này?')">
                                <form action="{{ route('page.orders.updateStatusClient', $item->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="rounded btn btn-danger" type="submit">Hủy đơn hàng <i
                                            class="fas fa-close"></i></button>
                                </form>
                            </a>
                        @elseif ($item->orderStatus == 1)
                            <p style="color: rgba(210, 88, 0, 0.767);">Đang giao hàng <i class="fas fa-running"></i></p>
                        @elseif ($item->orderStatus == 2)
                            <p style="color: rgb(0, 192, 0);">Đã giao hàng <i class="fas fa-check"></i></p>
                        @elseif ($item->orderStatus == 3)
                            <p style="color: red;">Hủy đơn <i class="fas fa-times"></i></p>
                            <a onclick="return confirm('Bạn có muốn đặt lại đơn này?')">
                                <form action="{{ route('page.orders.updateStatusClient', $item->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="rounded btn btn-success" type="submit">Đặt lại đơn hàng <i
                                            class="fas fa-check"></i></button>
                                </form>
                            </a>
                        @endif
                    </td>
                    <td><a href="{{ route('page.orders.billDetail', $item->id) }}" class="btn btn-success">Chi tiết <i
                                class="fas fa-eye"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
