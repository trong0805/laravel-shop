<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Cart;
use App\Models\CategoryProduct;
use App\Models\Comment;
use App\Models\GalleryImage;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')->where('statusCate', '=', 0)
            ->select('products.*', 'category_products.name', 'sizes.nameSize')->orderBy('products.id', 'ASC')
            ->search()
            ->Paginate(6);
        // dd($products);
        return view('admin.products.list', compact('products'));
    }
    public function create()
    {
        $cate = CategoryProduct::all()->where('statusCate', '=', 0);
        $sizes = Size::all()->where('statusSize', '=', 0);

        return view('admin.products.add-edit', compact('cate', 'sizes'));
    }
    public function store(ProductRequest $request)
    {

        $statement = DB::select("SHOW TABLE STATUS LIKE 'products'");
        $nextId = $statement[0]->Auto_increment;
        // dd($nextId);
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
        $files = [];
        if ($request->hasFile('filenames')) {
            foreach ($request->file('filenames') as $file) {

                $name = $file->getClientOriginalName();
                $file->move(public_path('images/GalleryProducts'), $name);
                $files[] = $name;
                $images = new GalleryImage();
                foreach ($files as $ok) {
                    $images->image_gallery = 'images/GalleryProducts/' . $ok;
                }

                $images->product_id = $nextId;
                $images->save();
            }
        }
        $data->save();
        session()->flash('success', 'Bạn đã thêm mới thành công!');
        return redirect()->route('admin.products.list');
    }
    public function edit($product)
    {
        $cate = CategoryProduct::all();
        $sizes = Size::all();
        $data = Product::find($product);
        // dd($data);
        return view('admin.products.add-edit', compact('data', 'cate', 'sizes'));
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
        $files = [];
        if ($request->hasFile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $images = new GalleryImage();
                $name = $file->getClientOriginalName();
                $file->move(public_path('images/GalleryProducts'), $name);
                $files[] = $name;
                foreach ($files as $ok) {
                    $images->image_gallery = 'images/GalleryProducts/' . $ok;
                }
                $images->product_id = $data->id;
                $images->save();
            }
        }
        $data->save();
        session()->flash('success', 'Bạn đã sửa thành công!');
        return redirect()->route('admin.products.list');
    }
    public function delete($product)
    {
        $data = Product::find($product);

        $carts = Cart::where('productId', '=', $product)->get();
        foreach ($carts as $it) {
            $it->delete();
        }

        $orderDts = OrderDetail::where('product_id', '=', $product)->get();
        foreach ($orderDts as $it) {
            $order = OrderDetail::find($it->id);
            $order->product_id = 0;
            $order->save();
        }
        $comments = Comment::where('product_id', '=', $product)->get();
        foreach ($comments as $it) {
            // $comment = Comment::find($it->id);
            // $comment->product_id = 0;
            // $comment->save();
            $it->delete();
        }

        $data->delete();
        return redirect()->route('admin.products.list');
    }
    public function showProduct()
    {
        $cate = CategoryProduct::all();
        $sizes = Size::all();
        // $products = DB::table('products')->join('category_products', 'products.category_id', '=', 'category_products.id')
        // ->select('products.*', 'category_products.name')->Paginate(9);
        $products = Product::select('products.*', 'category_products.name', 'sizes.nameSize')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->where('statusPrd', '=', 0)->where('statusCate', '=', 0)->search()->Paginate(9);
        $galleryImages = GalleryImage::select('image_gallery')->get();

        return view('client.products', compact('products', 'cate', 'sizes'));
    }
    public function updateStatus($product)
    {
        $data = Product::find($product);
        if ($data->statusPrd == 0) {
            $data->statusPrd = 1;
        } else {
            $data->statusPrd = 0;
        }
        // $data->status = $data->status;
        $data->save();
        session()->flash('success', 'Cập nhật trạng thái thành công!');
        return redirect()->route('admin.products.list');
    }
    public function showProductDetail($product)
    {
        $galleryImages = DB::table('gallery_images')->where('gallery_images.product_id', '=', $product)->get();
        // dd($galleryImages);
        //lấy ra sản phẩm chi tiết
        $dataProduct = Product::find($product);
        //lấy ra tất cả comment của sản phẩm
        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')->where('comments.product_id', '=', $product)
            // ->join('products', 'comments.product_id', '=', 'products.id'), 'products.nameProduct'
            ->select('comments.*', 'users.name', 'users.avatar')->paginate(6);
        //lấy ra các sản phẩm cùng loại
        $productCate = DB::table('products')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')->where('statusPrd', '=', 0)->where('products.category_id', '=', $dataProduct->category_id)
            ->select('products.*', 'category_products.name', 'sizes.nameSize')->skip(0)->take(3)->get();
        // dd($productCate);
        $cate = CategoryProduct::all();
        $sizes = Size::all();
        return view('client.product-detail', compact('dataProduct', 'cate', 'sizes', 'comments', 'productCate', 'galleryImages'));
    }
    public function deleteComment($comment)
    {
        $data = Comment::find($comment);
        $data->delete();
        return redirect()->route('page.product-detail', $data->product_id);
    }

    function showIndex()
    {
        $products = Product::select('products.*', 'category_products.name', 'sizes.nameSize')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->where('statusPrd', '=', 0)->where('statusCate', '=', 0)->orderByDesc('id')->skip(0)->take(6)->get();
        // dd($products);
        return view('client.index', compact('products'));
    }

    // test welcome
    public function welcome()
    {
        $cate = CategoryProduct::all();
        $sizes = Size::all();
        // $products = DB::table('products')->join('category_products', 'products.category_id', '=', 'category_products.id')
        // ->select('products.*', 'category_products.name')->Paginate(9);
        $products = Product::select('products.*', 'category_products.name', 'sizes.nameSize')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->where('statusPrd', '=', 0)->where('statusCate', '=', 0)->search()->Paginate(9);
        $galleryImages = GalleryImage::select('image_gallery')->get();

        return view('welcome', compact('products', 'cate', 'sizes'));
    }
    public function filter($id)
    {
        $cate = CategoryProduct::all();
        $sizes = Size::all();
        $products = Product::select('products.*', 'category_products.name', 'sizes.nameSize')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->where('statusPrd', '=', 0)->where('statusCate', '=', 0)->where('category_id', '=', $id)->search()->Paginate(9);
        $galleryImages = GalleryImage::select('image_gallery')->get();

        return view('client.products', compact('products', 'cate', 'sizes'));
    }
}
