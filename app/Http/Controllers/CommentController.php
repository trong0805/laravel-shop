<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index() {
        $comments = DB::table('comments')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->join('products', 'comments.product_id', '=', 'products.id')
        ->select('comments.*', 'users.name', 'products.nameProduct')->Paginate(9);
        // \dd($comments);
        return view('admin.comments.list', compact('comments'));
    }
    public function delete($comment) {
        $data = Comment::find($comment);
        $data->delete();
        return redirect()->route('admin.comments.list');
        
    }
}
