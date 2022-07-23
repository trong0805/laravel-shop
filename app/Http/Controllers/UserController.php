<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $dataUser = User::select('id', 'name', 'avatar', 'username', 'email', 'status', 'role')
            ->paginate(5);
        // dd($user);
        // cách 1 gọi mảng
        // return view('admin.users.list', [
        //     'dataUser' => $dataUser
        // ]);
        //cách 2 sử dụng hàm compact
        return view('admin.users.list', compact('dataUser'));
    }
    public function create()
    {
        return View('admin.users.add');
    }
    public function delete($user)
    {
            $userDelete = User::find($user);
            $userDelete->delete();
            return redirect()->route('admin.users.list');
            // return redirect()->back();
    }
    public function updateStatus($user)
    {
            $updateStatus = User::find($user);
            if($updateStatus->status === 0){
                $updateStatus->status = 1;
            }else {
                $updateStatus->status = 0;
            }
            $updateStatus->save();
            session()->flash('success', 'Bạn đã cập nhật trạng thái thành công!');
            return redirect()->route('admin.users.list');
            // return redirect()->back();
    }
}
