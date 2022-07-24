<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cate = CategoryProduct::all();
        $carts = DB::table('carts')->join('products', 'carts.productId', '=', 'products.id')->where('carts.userId', '=', Auth::user()->id)
            ->select('carts.*', 'products.nameProduct', 'products.avatar', 'products.category_id')->get();
        // dd($carts);
        return view('client.carts', compact('carts', 'cate'));
    }
    public function storeCart(Request $request)
    {
        // dd($request->all());
        $cart = new Cart();
        $cart->userId = $request->userId;
        $cart->productId = $request->productId;
        $cart->price = $request->price;
        $cart->quantity = $request->quantity;
        $cartAllId = DB::table('carts')->where('carts.userId', '=', Auth::user()->id)->get();
        foreach ($cartAllId as $data) {
            if ($data->productId == $request->productId) {
                $cartId = DB::table('carts')->where('carts.userId', '=', Auth::user()->id)->where('carts.productId', '=', $request->productId)->get();
                $number = $data->quantity + $request->quantity;
                // \dd($number);
                $id = $cartId->pluck('id'); // Lấy ra mảng id
                Cart::whereIn('id', $id)->update(['quantity' => $number]); // update các post có id trong mảng
                session()->flash('success', 'Thêm vào giỏ hàng thành công!');
                return redirect()->route('page.carts.list');
            }
        }
        // dd($cartId);
        $cart->save();
        session()->flash('success', 'Thêm vào giỏ hàng thành công!');
        return redirect()->route('page.carts.list');
    }
    public function update(Request $request,$cart)
    {
        $cart = Cart::find($cart);
        $cart->quantity = $request->quantity;
        $cart->save();
        // \dd($cart);
        session()->flash('success', 'Cập nhật giỏ hàng thành công!');
        return redirect()->route('page.carts.list');
    }
    public function delete($cart)
    {
        $cart = Cart::find($cart);
        $cart->delete();
        return redirect()->route('page.carts.list');
    }
}
