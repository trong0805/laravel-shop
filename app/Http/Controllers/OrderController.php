<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function storeOrder(OrderRequest $request)
    {
        $statement = DB::select("SHOW TABLE STATUS LIKE 'orders'");
        $nextId = $statement[0]->Auto_increment;
        // \dd($nextId);
        $order = new Order();
        $order->orderDate = date('Y-m-d');
        $order->orderStatus = 0;
        $order->orderCoupon     = null;
        $order->orderTotal = $request->orderTotal;
        $order->orderUserId = Auth::user()->id;
        $order->orderName = $request->orderName;
        $order->orderEmail = $request->orderEmail;
        $order->numberPhone = $request->numberPhone;
        $order->address = $request->address;
        $order->save();
        $carts = Cart::all()->where('userId', '=', Auth::user()->id);
        foreach ($carts as $it) {
            $prd = Product::find($it->productId);
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $nextId;
            $orderDetail->product_id = $it->productId;
            $orderDetail->oddNamePrd = $prd->nameProduct;
            $orderDetail->oddPricePrd = $it->price;
            $orderDetail->oddQuantityPrd = $it->quantity;
            $orderDetail->save();
            $it->delete();
        }
        session()->flash('success', 'Thanh toán hóa đơn thành công!');
        return redirect()->route('page.carts.list');
        // dd($carts);
    }

    public function index()
    {
        $orders = Order::select('orders.*', 'users.name')->join('users', 'orders.orderUserId', '=', 'users.id')->Paginate(7);
        // \dd($orders);
        return view('admin.orders.list', compact('orders'));
    }

    public function showBill()
    {
        $orders = Order::all()->where('orderUserId', '=', Auth::user()->id);
        return view('client.bill-order', compact('orders'));
    }
    public function updateStatus(Request $request, $order)
    {
        // dd($request->all());
        $data = Order::find($order);
        $data->orderStatus = $request->orderStatus;
        $data->save();
        return redirect()->route('admin.orders.list');
    }
    public function updateStatusClient(Request $request, $order)
    {
        // dd($request->all());
        $data = Order::find($order);
        if ($data->orderStatus === 0) {
            $data->orderStatus = 3;
            $data->save();
            session()->flash('success', 'Bạn đã hủy đơn hàng thành công!');
            return redirect()->route('page.orders.bill');
        }
        if ($data->orderStatus === 3) {
            $data->orderStatus = 0;
            $data->save();
            session()->flash('success', 'Bạn đã đặt lại đơn hàng thành công!');
            return redirect()->route('page.orders.bill');
        }
    }
}
