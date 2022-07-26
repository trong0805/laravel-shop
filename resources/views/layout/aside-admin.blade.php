<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img style="object-fit: cover;
                width:40px;
                height:40px;"
                    src="{{ asset(Auth::user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- thống kê --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thống kê</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- người dùng v --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Người dùng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách người dùng</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- bài viết --}}
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-pen-square"></i>
                        <p>
                            Bài viết
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách bài viết</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm bài viết</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- danh mục bài viết v --}}
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-pen"></i>
                        <p>
                            Danh mục bài viết
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.categoryPost.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.categoryPost.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- danh sach size v --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-pen"></i>
                        <p>
                            Kích cỡ sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.sizes.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách kích cỡ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.sizes.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm kích cỡ</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- sản phẩm v --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.products.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- danh mục sản phẩm v --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Danh mục Sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.categoryProduct.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.categoryProduct.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- hóa đơn --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Hóa đơn
                            {{-- <span class="thongbao"> --}}
                            <?php
                            $data = DB::table('orders')
                                ->where('orders.orderstatus', '=', 0)
                                ->get();
                            // dd(count($carts));
                            // echo count($data);
                            if (count($data) == 0) {
                            } else {
                                echo ' <span class="thongbao">' . count($data) . '</span>';
                            }
                            ?>
                            {{-- </span> --}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách hóa đơn</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>
                            Phản hồi
                            <?php
                            $data = DB::table('contacts')
                                ->where('contacts.action', '=', 0)
                                ->get();
                            if (count($data) == 0) {
                            } else {
                                echo ' <span class="thongbao">' . count($data) . '</span>';
                            }
                            ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.contacts.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách phản hồi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- bình luận --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-reply-all"></i>
                        <p>
                            Bình luận sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.comments.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách bình luận</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- đăng xuất --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-door-closed"></i>
                        <p>
                            Đăng xuất
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('auth.logout') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đăng xuất</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<style>
    span.thongbao {
        background-color: white;
        color: red;
        display: inline-block;
        width: 24px;
        font-weight: 800;
        text-align: center;
        border-radius: 50%;
    }
</style>
