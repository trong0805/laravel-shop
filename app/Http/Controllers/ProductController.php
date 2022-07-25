<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\CategoryProduct;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->join('category_products', 'products.category_id', '=', 'category_products.id')
        ->select('products.*', 'category_products.name')->Paginate(6);
        return view('admin.products.list', compact('products'));
    }
    public function create()
    {
        $cate = CategoryProduct::all();

        return view('admin.products.add-edit', compact('cate'));
    }
    public function store(ProductRequest $request)
    {
        $data = new Product();
        $data->fill($request->all());
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $avatarName = $request->price . '_' . $avatarName;
            $data->avatar = $avatar->storeAs('images/products', $avatarName);
        } else {
            $data->avatar = '';
            session()->flash('error', 'Vui lòng thêm ảnh');
            return redirect()->back();
        }
        $data->save();
        session()->flash('success', 'Bạn đã thêm mới thành công!');
        return redirect()->route('admin.products.list');
    }
    public function edit($product)
    {
        $cate = CategoryProduct::all();
        $data = Product::find($product);
        // dd($data);
        return view('admin.products.add-edit', compact('data', 'cate'));
    }
    public function update(ProductRequest $request, $product)
    {
        $data = Product::find($product);
        $data->fill($request->all());
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $avatarName = $request->price . '_' . $avatarName;
            $data->avatar = $avatar->storeAs('images/products', $avatarName);
        } else {
            $data->avatar = $data->avatar;
        }
        $data->save();
        session()->flash('success', 'Bạn đã sửa thành công!');
        return redirect()->route('admin.products.list');
    }
    public function delete($product)
    {
        $data = Product::find($product);
        $data->delete();
        return redirect()->route('admin.products.list');
    }
    public function showProduct() {
        $cate = CategoryProduct::all();
        // $products = DB::table('products')->join('category_products', 'products.category_id', '=', 'category_products.id')
        // ->select('products.*', 'category_products.name')->Paginate(9);
        $products = Product::select('products')->join('category_products', 'products.category_id', '=', 'category_products.id')->select('products.*','category_products.*')->search()->Paginate(5);

        // \dd($products);
        return view('client.products', compact('products', 'cate'));
    }
    public function showProductDetail($product) {
        //lấy ra sản phẩm chi tiết
        $dataProduct = Product::find($product);
        //lấy ra tất cả comment của sản phẩm
        $comments = DB::table('comments')
        ->join('users', 'comments.user_id', '=', 'users.id')->where('comments.product_id', '=', $product)
        // ->join('products', 'comments.product_id', '=', 'products.id'), 'products.nameProduct'
        ->select('comments.*', 'users.name','users.avatar')->paginate(6);
        //lấy ra các sản phẩm cùng loại
        $productCate = DB::table('products')
        ->join('category_products', 'products.category_id', '=', 'category_products.id')->where('products.category_id', '=', $dataProduct->category_id)
        ->select('products.*', 'category_products.name')->get();
        // dd($productCate);
        $cate = CategoryProduct::all();
        return view('client.product-detail', compact('dataProduct', 'cate', 'comments', 'productCate'));
    }
    public function deleteComment($comment) {
        $data = Comment::find($comment);
        $data->delete();
        return redirect()->route('page.product-detail', $comment->product_id);
    }
}
