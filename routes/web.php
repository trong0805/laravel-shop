<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// test
Route::get('/', [ProductController::class, 'welcome'])->name('welcome');
Route::get('/filter/{id}', [ProductController::class, 'filter'])->name('filter');


Route::middleware('guest')->prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register_store', [AuthController::class, 'register_store'])->name('register_store');
});
Route::middleware('auth')->get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
// ============PHẦN GIAO DIỆN==================
Route::prefix('page')->name('page.')->group(function () {
    //trang chủ
    Route::get('/', [ProductController::class, 'showIndex'])->name('home');

    //trang sản phẩm
    Route::get('/products', [ProductController::class, 'showProduct'])->name('products');
    Route::get('/product-detail/{product}',  [ProductController::class, 'showProductDetail'])->name('product-detail');

    Route::post('/store', [CommentController::class, 'store'])->middleware('CheckAdminClient')->name('store');
    // Route::get('/edit/{comment}', [CommentController::class, 'edit'])->name('edit');
    // Route::put('/update/{comment}', [CommentController::class, 'update'])->name('update');
    Route::delete('/deleteComment/{comment}', [ProductController::class, 'deleteComment'])->middleware('CheckAdminClient')->name('deleteComment');
    //trang liên hệ
    Route::get('/about', function () {
        return view('client.about');
    })->name('about');

    //trang liên hệ
    Route::prefix('contact')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'createContact'])->name('contact');
        Route::post('/store', [ContactController::class, 'storeContact'])->name('store');
    });

    Route::prefix('carts')->middleware('CheckAdminClient')->name('carts.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('list');
        Route::post('/storeCart', [CartController::class, 'storeCart'])->name('storeCart');
        Route::post('/update/{cart}', [CartController::class, 'update'])->name('update');
        Route::delete('/delete/{cart}', [CartController::class, 'delete'])->name('delete');
    });
    Route::prefix('orders')->middleware('CheckAdminClient')->name('orders.')->group(function () {
        Route::post('/storeOrder', [OrderController::class, 'storeOrder'])->name('order');
        Route::get('/showBill', [OrderController::class, 'showBill'])->name('bill');
        Route::get('/bill-detail/{order}', [OrderDetailController::class, 'billDetail'])->name('billDetail');
        Route::put('/update/{order}', [OrderController::class, 'updateStatusClient'])->name('updateStatusClient');
    });
    Route::prefix('account')->name('accounts.')->group(function () {
        Route::get('/{user}', [UserController::class, 'account'])->name('account');
        Route::post('updateAccount/{user}', [UserController::class, 'updateAccount'])->name('updateAccount');
        Route::post('updatePass/{user}', [UserController::class, 'updatePass'])->name('updatePass');
    });
});
// ============================PHẦN ADMIN=============================
Route::prefix('admin')->middleware('CheckAdminLogin')->name('admin.')->group(function () {
    //thống kê 
    Route::get('/', [DasboardController::class, 'index'])->name('dashboard');
    //tài khoản
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('list');
        Route::get('/add', [UserController::class, 'create'])->name('create');
        Route::post('/updateStatus/{user}', [UserController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('delete');
    });

    // danh mục bài viết
    Route::prefix('categoryPost')->name('categoryPost.')->group(function () {
        Route::get('/', [CategoryPostController::class, 'index'])->name('list');
        Route::get('/create', [CategoryPostController::class, 'create'])->name('create');
        Route::post('/store', [CategoryPostController::class, 'store'])->name('store');
        Route::get('/edit/{categoryPost}', [CategoryPostController::class, 'edit'])->name('edit');
        Route::put('/update/{categoryPost}', [CategoryPostController::class, 'update'])->name('update');
        Route::post('/updateStatus/{categoryPost}', [CategoryPostController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/delete/{categoryPost}', [CategoryPostController::class, 'delete'])->name('delete');
    });

    // danh mục sản phẩm
    Route::prefix('categoryProduct')->name('categoryProduct.')->group(function () {
        Route::get('/', [CategoryProductController::class, 'index'])->name('list');
        Route::get('/create', [CategoryProductController::class, 'create'])->name('create');
        Route::post('/store', [CategoryProductController::class, 'store'])->name('store');
        Route::get('/edit/{categoryProduct}', [CategoryProductController::class, 'edit'])->name('edit');
        Route::put('/update/{categoryProduct}', [CategoryProductController::class, 'update'])->name('update');
        Route::post('/updateStatus/{categoryProduct}', [CategoryProductController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/delete/{categoryProduct}', [CategoryProductController::class, 'delete'])->name('delete');
    });

    //size sanr phaam
    Route::prefix('size')->name('sizes.')->group(function () {
        Route::get('/', [SizeController::class, 'index'])->name('list');
        Route::get('/create', [SizeController::class, 'create'])->name('create');
        Route::post('/store', [SizeController::class, 'store'])->name('store');
        Route::get('/edit/{size}', [SizeController::class, 'edit'])->name('edit');
        Route::put('/update/{size}', [SizeController::class, 'update'])->name('update');
        Route::post('/updateStatus/{size}', [SizeController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/delete/{size}', [SizeController::class, 'delete'])->name('delete');
    });

    //sản phẩm
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('list');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::post('/updateStatus/{product}', [ProductController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('delete');
    });

    //liên hệ
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('list');
        Route::delete('/delete/{contact}', [ContactController::class, 'delete'])->name('delete');
        Route::post('/updateAction/{contact}', [ContactController::class, 'updateAction'])->name('updateAction');
    });
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('/', [CommentController::class, 'index'])->name('list');
        Route::delete('/delete/{comment}', [CommentController::class, 'delete'])->name('delete');
    });
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('list');
        Route::get('/detail/{order}', [OrderDetailController::class, 'index'])->name('detail');
        Route::put('/update/{order}', [OrderController::class, 'updateStatus'])->name('updateStatus');
    });
});
