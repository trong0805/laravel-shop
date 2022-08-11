@extends('layout.master-admin')
@section('title', 'Hóa đơn sản phẩm')
@section('content')
    <table class="table table-bordered">
        <div class="alert alert-default-info">
            <h3 class="text-center">Hóa đơn sản phẩm</h3>
        </div>
        <thead>
            <tr>
                <th>Tài khoản đặt</th>
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
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->orderName }}</td>
                    <td>{{ $item->orderEmail }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->numberPhone }}</td>
                    <td>{{ $item->orderCoupon == null ? 'Null' : $item->orderCoupon }}</td>
                    <td>{{ $item->orderDate }}</td>
                    <td>{{ number_format($item->orderTotal) }}<sup>đ</sup></td>
                    <td style="width: 200px;">
                        @if ($item->orderStatus == 0 || $item->orderStatus == 1)
                            <form action="{{ route('admin.orders.updateStatus', $item->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <select name="orderStatus" id="">
                                    <option value="0" {{ $item->orderStatus === 0 ? 'selected' : '' }}>Đang xử lý hàng
                                    </option>
                                    <option value="1" {{ $item->orderStatus === 1 ? 'selected' : '' }}>Đang giao hàng
                                    </option>
                                    <option value="2" {{ $item->orderStatus === 2 ? 'selected' : '' }}>Đã giao hàng
                                    </option>
                                    <option value="3" {{ $item->orderStatus === 3 ? 'selected' : '' }}>Hủy đơn hàng
                                    </option>
                                </select>
                                <button class="rounded-circle btn-success" type="submit"><i class="fas fa-check"></i></button>
                            </form>
                        @elseif ($item->orderStatus == 2)
                            <p style="color: rgb(0, 192, 0);">Đã giao hàng <i class="fas fa-check"></i></p>
                        @elseif ($item->orderStatus == 3)
                            <p style="color: red;">Hủy đơn <i class="fas fa-times"></i></p>
                        @endif

                    </td>
                    <td style="width: 105px;"><a href="{{ route('admin.orders.detail', $item->id) }}" class="btn btn-success">Xem <i
                                class="fas fa-eye"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $orders->links() }}
    </div>
@endsection
