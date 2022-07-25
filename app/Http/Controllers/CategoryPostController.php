<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryPostRequest;

class CategoryPostController extends Controller
{
    public function index()
    {
        $categoryPosts = CategoryPost::select('id', 'name', 'statusPost')->Paginate(5);
        return view('admin.categoryPosts.list', compact('categoryPosts'));
    }
    public function create()
    {
        return view('admin.categoryPosts.add-edit');
    }
    public function store(CategoryPostRequest $request)
    {
        $data = new CategoryPost();
        if ($request->statusPost == null) {
            session()->flash('error', 'Trạng thái không được để trống!');
            return redirect()->route('admin.categoryPost.create');
        }
        $data->fill($request->all());
        $data->save();
        session()->flash('success', 'Bạn đã thêm mới thành công!');
        return redirect()->route('admin.categoryPost.list');
    }
    public function edit($categoryPost)
    {
        $category = CategoryPost::find($categoryPost);
        return view('admin.categoryPosts.add-edit', compact('category'));
    }
    public function update(CategoryPostRequest $request, $categoryPost)
    {
        $data = CategoryPost::find($categoryPost);
        $data->name = $request->name;
        // $data->status = $data->status;
        $data->save();
        session()->flash('success', 'Bạn đã sửa thành công!');
        return redirect()->route('admin.categoryPost.list');
    }
    public function updateStatus($categoryPost)
    {
        $data = CategoryPost::find($categoryPost);
        if ($data->statusPost == 0) {
            $data->statusPost = 1;
        } else {
            $data->statusPost = 0;
        }
        // $data->status = $data->status;
        $data->save();
        session()->flash('success', 'Cập nhật trạng thái thành công!');
        return redirect()->route('admin.categoryPost.list');
    }
    public function delete($categoryPost)
    {
        $data = CategoryPost::find($categoryPost);
        $data->delete();
        return redirect()->route('admin.categoryPost.list');
    }
}
