<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('page.home') }}">
                <h2>Sixteen <em>furniture</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse m-auto" id="navbarResponsive">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('page.home') }}">Trang chủ
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('page.products') }}">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('page.contacts.contact') }}">Liên hệ</a>
                    </li>

                </ul>
            </div>
            <div class="">
                <a class="navbar-brand float-right" onclick="show()" id="menuClicks">
                    <h2 class="position-relative"><i class="fas fa-list-ul"></i>
                        @if (Auth::user())
                            <p class="position-absolute text-center font-weight-bold"
                                style=" background: white; border: 1px solid grey; color: red; top: -8px; right: -12px; width: 24px; height: 24px; border-radius: 50%;">
                                <?php
                                $carts = DB::table('carts')
                                    ->where('carts.userId', '=', Auth::user()->id)
                                    ->get();
                                // dd(count($carts));
                                echo count($carts);
                                ?>
                            </p>
                        @else
                            
                        @endif

                    </h2>
                </a>

            </div>
        </div>
        {{-- </div> --}}
        </div>
    </nav>
</header>
<div class="menuClick">
    <div class="logoName">
        <h2>Sixteen <em>furniture</em></h2>
    </div>
    <ul class="navbar-nav m-auto">
        @if (Auth::user())
            <li class="nav-item text-center">
                <a class="nav-link">
                    <img src="{{ asset(Auth::user()->avatar) }}"
                        style="border-radius:50%; object-fit: cover; width:80px; height:80px;">
                </a>
                <h4>{{ Auth::user()->name }}</h4>
            </li>
            <li class="nav-item text-center hoverNav">
                <a class="nav-link" href="{{ route('page.carts.list') }}">Giỏ hàng <i class="fa fa-cart-arrow-down"></i>
                    <span class="showCart"><?php echo count($carts); ?></span></a>
            </li>
            <li class="nav-item text-center hoverNav">
                <a class="nav-link" href="{{ route('page.orders.bill') }}">Hóa đơn <i
                        class="fas fa-money-bill-alt"></i></a>
            </li>
            <li class="nav-item text-center hoverNav">
                <a class="nav-link" href="{{ route('page.accounts.account', Auth::user()->id) }}">Thông tin</a>
            </li>
            <li class="nav-item text-center hoverNav">
                <a class="nav-link" href="{{ route('auth.logout') }}">Đăng xuất</a>
            </li>
        @else
            <li class="nav-item text-center hoverNav">
                <a class="nav-link" href="{{ route('auth.login') }}">Đăng nhập</a>
            </li>
            <li class="nav-item text-center hoverNav">
                <a class="nav-link" href="{{ route('auth.register') }}">Đăng ký</a>
            </li>
        @endif
    </ul>
</div>
<div class="overlay" onclick="hide()"></div>
<style>
    .hoverNav>.nav-link {
        color: #fff;
    }

    .hoverNav:hover a {
        background-color: white;
        color: #000;
    }

    .menuClick {
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        width: 300px;
        z-index: 100001;
        background-color: white;
        display: none;
        background: linear-gradient(135deg, rgb(249, 162, 162), rgb(167, 167, 255));
    }

    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        z-index: 100000;
        background-color: rgba(0, 0, 0, 0.25);
        display: none;
    }

    .logoName {
        padding: 12px 0px;
        text-align: center;
    }

    .logoName>h2 {
        color: #000;
        text-transform: uppercase;
        font-size: 32px;
        font-weight: 700;
    }

    .logoName>h2>em {
        font-style: normal;
        color: #f33f3f;
    }

    #menuClicks {
        cursor: pointer;
    }

    .overlay {
        cursor: pointer;
    }

    .showCart {
        display: inline-block;
        background: red;
        border-radius: 50%;
        width: 24px
    }
</style>
<script>
    function show() {
        // var cl = document.getElementsById('menuClicks');
        document.querySelector('.menuClick').style.display = 'block';
        document.querySelector('.overlay').style.display = 'block';
    }

    function hide() {
        // var cl = document.getElementsById('menuClicks');
        document.querySelector('.menuClick').style.display = 'none';
        document.querySelector('.overlay').style.display = 'none';
    }
</script>
<?php
// function carts() {
//     $numberCarts = DB::table('carts')>where('carts.userId', '=', Auth::user()->id)->get();
//     // dd($carts);
//     return count($numberCarts);
// }
?>
