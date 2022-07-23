<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register_store', [AuthController::class, 'register_store'])->name('register_store');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
// ============PHẦN GIAO DIỆN==================
Route::prefix('page')->name('page.')->group(function () {
    //trang chủ
    Route::get('/', function () {
        return view('client.index');
    })->name('home');

    //trang sản phẩm
    Route::get('/products', [ProductController::class, 'showProduct'])->name('products');
    Route::get('/product-detail/{product}',  [ProductController::class, 'showProductDetail'])->name('product-detail');

    //trang liên hệ
    Route::get('/about', function () {
        return view('client.about');
    })->name('about');

    //trang liên hệ
    Route::prefix('contact')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'createContact'])->name('contact');
        Route::post('/store', [ContactController::class, 'storeContact'])->name('store');
    });
    Route::get('carts', function () {
        return view('client.carts');
    })->name('carts');
});
// ============================PHẦN ADMIN=============================
Route::prefix('admin')->middleware('CheckAdminLogin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return 'dashboard';
    })->name('dashboard');

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
        Route::delete('/delete/{categoryPost}', [CategoryPostController::class, 'delete'])->name('delete');
    });

    // danh mục sản phẩm
    Route::prefix('categoryProduct')->name('categoryProduct.')->group(function () {
        Route::get('/', [CategoryProductController::class, 'index'])->name('list');
        Route::get('/create', [CategoryProductController::class, 'create'])->name('create');
        Route::post('/store', [CategoryProductController::class, 'store'])->name('store');
        Route::get('/edit/{categoryProduct}', [CategoryProductController::class, 'edit'])->name('edit');
        Route::put('/update/{categoryProduct}', [CategoryProductController::class, 'update'])->name('update');
        Route::delete('/delete/{categoryProduct}', [CategoryProductController::class, 'delete'])->name('delete');
    });

    //sản phẩm
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('list');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('delete');
    });

    //liên hệ
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('list');
        Route::delete('/delete/{contact}', [ContactController::class, 'delete'])->name('delete');
    });
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('/', [CommentController::class, 'index'])->name('list');
        Route::post('/store', [CommentController::class, 'store'])->name('store');
        Route::get('/edit/{comment}', [CommentController::class, 'edit'])->name('edit');
        Route::put('/update/{comment}', [CommentController::class, 'update'])->name('update');
        Route::delete('/delete/{comment}', [CommentController::class, 'delete'])->name('delete');
    });
});
