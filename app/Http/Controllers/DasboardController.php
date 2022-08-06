<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DasboardController extends Controller
{
    public function index()
    {
        $range = \Carbon\Carbon::now()->subDays(30);

        $stats = DB::table('orders')
          ->where('orderDate', '>=', $range)
          ->groupBy('date')
          ->orderBy('date', 'ASC')
          ->get([
            DB::raw('Date(orderDate) as date'),
            DB::raw('COUNT(*) as value')
          ]);

          $alo = DB::table('products')
          ->join('category_products', 'products.category_id', '=', 'category_products.id')
        //   ->where('orderDate', '>=', $range)
        //   ->groupBy('date')
        //   ->orderBy('date', 'ASC')
          ->get([
            // DB::raw('Date(orderDate) as date'),
            DB::raw('COUNT(category_id) as value')
          ]);

        //   dd($alo);
        $cates = CategoryProduct::all();
        $data = DB::table('products');
        return view('admin.dashboard', compact('cates', 'stats'));
    }
    // function orderByYear() mình sẽ lấy tổng các order trong vòng 5 năm tính từ năm hiện tại và fill vào **bar chart**


}
