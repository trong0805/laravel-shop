<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $size = Size::select('id', 'nameSize', 'statusSize')->Paginate(6);
        return view('admin.sizes.list', compact('size'));
    }
    public function create()
    {
        return view('admin.sizes.add-edit');
    }
    public function store(Request $request)
    {
        $data = new Size();
        if ($request->nameSize == null) {
            session()->flash('errorr', 'Tên kích cỡ không được để trống!');
            return redirect()->route('admin.sizes.create');
        }
        if ($request->statusSize == null) {
            session()->flash('error', 'Trạng thái không được để trống!');
            return redirect()->route('admin.sizes.create');
        }
        $data->fill($request->all());
        $data->save();
        session()->flash('success', 'Bạn đã thêm mới thành công!');
        return redirect()->route('admin.sizes.list');
    }
    public function edit($size)
    {
        $size = Size::find($size);
        return view('admin.sizes.add-edit',compact('size'));

    }
    public function update(Request $request, $categoryProduct)
    {
        $data = Size::find($categoryProduct);
        $data->nameSize = $request->nameSize;
        $data->save();
        session()->flash('success', 'Bạn đã sửa thành công!');
        return redirect()->route('admin.sizes.list');
    }
    public function updateStatus($size)
    {
        $data = Size::find($size);
        if ($data->statusSize == 0) {
            $data->statusSize = 1;
        }else {
            $data->statusSize = 0;
        }
        // $data->status = $data->status;
        $data->save();
        session()->flash('success', 'Cập nhật trạng thái thành công!');
        return redirect()->route('admin.sizes.list');
    }
    public function delete($size)
    {
        $data = Size::find($size);
        $data->delete();
        return redirect()->route('admin.sizes.list');

    }
}
