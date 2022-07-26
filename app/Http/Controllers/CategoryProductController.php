<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryPostRequest;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index()
    {
        $categoryProducts = CategoryProduct::select('id', 'name', 'statusCate')->Paginate(6);
        return view('admin.categoryProducts.list', compact('categoryProducts'));
    }
    public function create()
    {
        return view('admin.categoryProducts.add-edit');
    }
    public function store(CategoryPostRequest $request)
    {
        $data = new CategoryProduct();
        if ($request->statusCate == null) {
            session()->flash('error', 'Trạng thái không được để trống!');
            return redirect()->route('admin.categoryProduct.create');
        }
        $data->fill($request->all());
        $data->save();
        session()->flash('success', 'Bạn đã thêm mới thành công!');
        return redirect()->route('admin.categoryProduct.list');
    }
    public function edit($categoryProduct)
    {
        $category = CategoryProduct::find($categoryProduct);
        return view('admin.categoryProducts.add-edit',compact('category'));

    }
    public function update(CategoryPostRequest $request, $categoryProduct)
    {
        $data = CategoryProduct::find($categoryProduct);
        $data->name = $request->name;
        $data->save();
        session()->flash('success', 'Bạn đã sửa thành công!');
        return redirect()->route('admin.categoryProduct.list');
    }
    public function updateStatus($categoryProduct)
    {
        $data = CategoryProduct::find($categoryProduct);
        if ($data->statusCate == 0) {
            $data->statusCate = 1;
        }else {
            $data->statusCate = 0;
        }
        // $data->status = $data->status;
        $data->save();
        session()->flash('success', 'Cập nhật trạng thái thành công!');
        return redirect()->route('admin.categoryProduct.list');
    }
    public function delete($categoryProduct)
    {
        $data = CategoryProduct::find($categoryProduct);
        $data->delete();
        return redirect()->route('admin.categoryProduct.list');

    }
}
