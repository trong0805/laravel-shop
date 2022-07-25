@extends('layout.master-client')
@section('title', 'Giỏ hàng')
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

<div class="px-4 px-lg-0">
  <!-- For demo purpose -->
  <div class="container text-black py-5 text-center">
    <h1 class="display-4">Shopping cart</h1>
  </div>
  <!-- End -->

  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <div class="table-responsive">
            @if (session()->has('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}
              </div>
            @endif
            <table class="table">
              <a href="{{ route('page.products') }}" class="float-right"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>Tiếp tục mua</a>
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Tên sản phẩm</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Giá</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Số lượng</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Tổng tiền</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase"></div>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($carts as $item)
                <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                      <img src="{{ asset($item->avatar) }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">{{ $item->nameProduct }}</a></h5>
                        <span class="text-muted font-weight-normal font-italic d-block">Category: 
                          @foreach($cate as $category)
                            @if($item->category_id === $category->id)
                              {{ $category->name }}
                            @endif
                          @endforeach
                        </span>
                      </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong>{{ number_format($item->price) }}<sup>đ</sup></strong></td>
                  {{-- <td class="border-0 align-middle"><strong>{{ $item->quantity }}</strong></td> --}}
                  <td class="border-0 align-middle">
                    <form action="{{ route('page.carts.update', $item->id) }}" method="post">
                      @csrf
                      <input style="width: 50px;" type="number" name="quantity" value="{{ $item->quantity }}">
                      <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                    </form>
                  </td>
                  <td class="border-0 align-middle"><strong>{{ number_format($item->price * $item->quantity) }}<sup>đ</sup></strong></td>
                  <td class="border-0 align-middle"><a href="#" class="text-dark">
                    <form action="{{ route('page.carts.delete', $item->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <a onclick="return confirm('Bạn có muốn xóa sản phẩm này trong giỏ hàng?')">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></a></button>
                      </a>
                    </form></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
      </div>

      <div class="row py-5 p-4 bg-white rounded shadow-sm">
        <div class="col-lg-6">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
          <div class="p-4">
            <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
            <div class="input-group mb-4 border rounded-pill p-2">
              <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
              <div class="input-group-append border-0">
                <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
          <div class="p-4">
            <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
            <ul class="list-unstyled mb-4">
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong>$390.00</strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>$0.00</strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                <h5 class="font-weight-bold">$400.00</h5>
              </li>
            </ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection()