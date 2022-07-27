<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index()
    {
        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->join('products', 'comments.product_id', '=', 'products.id')
            ->select('comments.*', 'users.name', 'products.nameProduct')->Paginate(9);
        // \dd($comments);
        return view('admin.comments.list', compact('comments'));
    }
    public function store(Request $request)
    {
        $comment = new Comment();

        $comment->user_id = Auth::user()->id;
        $comment->product_id = $request->product_id;
        if ($request->content == null) {
            session()->flash('error', 'Nội dung không được để trống!');
            return redirect()->back();
        }
        $comment->content = $request->content;
        $comment->dateComment = date("Y-m-d");
        // dd(date("Y-m-d"));
        $comment->save();
        return redirect()->back();
        // Auth::user()
    }
    public function delete($comment)
    {
        $data = Comment::find($comment);
        $data->delete();
        return redirect()->route('admin.comments.list');
    }
}
