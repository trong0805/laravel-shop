<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index($order) {
        $orders = OrderDetail::select('order_details.*', 'products.nameProduct', 'products.avatar')
        ->join('products', 'order_details.product_id', '=', 'products.id')
        // ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->where('order_id' , '=', $order)->paginate(5);
        // $orders = OrderDetail::all();
        // \dd($orders);
        $total = 0;
        $tt = Order::find($order);
        return view('admin.orders.detail', compact('orders','total', 'tt'));
    }
    public function billDetail($order) {
        $orders = OrderDetail::select('order_details.*', 'products.nameProduct', 'products.avatar')
        ->join('products', 'order_details.product_id', '=', 'products.id')
        // ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->where('order_id' , '=', $order)->paginate(5);
        // $orders = OrderDetail::all();
        // \dd($orders);
        $total = 0;
        $tt = Order::find($order);
        return view('client.bill-detail', compact('orders','total', 'tt'));
    }
}
