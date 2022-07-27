<header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="{{ route('page.home') }}"><h2>Sixteen <em>furniture</em></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('page.home') }}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="{{ route('page.products') }}">Our Products</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="{{ route('page.about') }}">About Us</a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('page.contacts.contact') }}">Contact Us</a>
            </li>
            @if(Auth::user())
            <li class="nav-item">
              <a class="nav-link" href="{{ route('page.carts.list') }}">Giỏ hàng <i class="fa fa-cart-arrow-down"></i></a>
            </li>
            @endif
            <li class="nav-item">
              @if(Auth::user())
              <a class="nav-link hover">
                <img src="{{ asset(Auth::user()->avatar) }}" width="20px"> {{ Auth::user()->name }}
              </a>
              <ul class="hover-items">
                <li class="nav-item">
                  <a class="nav" href="#">Thông tin</a>
                </li> 
                <li class="nav-item">
                  <a class="nav" href="{{ route('auth.logout') }}">Đăng xuất</a>
                </li> 
              @else
                <a class="nav-link" href="{{ route('auth.login') }}">Đăng nhập</a>
              @endif
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <style>
    .hover-items {
      display: none;
      background-color: white;
      /* border: 0.5px solid grey; */
      box-shadow: 0px 1px 3px grey;
    }
    .hover-items > li {
      padding: 4px 4px;
    }
    .hover-items::before{
      content: '';
      width: 20px;
      background-color: red;
      height: 12px;
    }
    .hover-items a {
      color: black!important;
    }
    .nav-item:hover .hover-items{
      display: block;
    }
  </style>