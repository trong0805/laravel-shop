<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        if ($updateStatus->status === 0) {
            $updateStatus->status = 1;
        } else {
            $updateStatus->status = 0;
        }
        $updateStatus->save();
        session()->flash('success', 'Bạn đã cập nhật trạng thái thành công!');
        return redirect()->route('admin.users.list');
        // return redirect()->back();
    }

    public function account($user)
    {
        $dataUser = User::find(Auth::user()->id);
        // dd($dataUser);
        return view('client.account', compact('dataUser'));
    }

    public function updateAccount(UserRequest $request, $user)
    {
        // dd($request->all());
        $updateAcc = User::find($user);
        $updateAcc->name = $request->name;
        $updateAcc->username = $request->username;
        $updateAcc->email = $request->email;
        $updateAcc->name = $request->name;
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $avatarName = $request->$request->name . '_' . $avatarName;
            $updateAcc->avatar = $avatar->storeAs('images/users', $avatarName);
        }
        $updateAcc->save();
        session()->flash('success', 'Bạn đã cập nhật thông tin thành công!');
        return redirect()->route('page.accounts.account', $updateAcc->id);
    }
    public function updatePass(Request $request, $user)
    {
        $updatePass = User::find($user);
        // Hash::check($pw, $hashed);
        if (Hash::check($request->pass_old, $updatePass->password)) {
            if ($request->password == $request->repass) {
                $updatePass->password = Hash::make($request->password);
                $updatePass->save();
                session()->flash('success', 'Đổi mật khẩu thành công!');
                return redirect()->route('page.accounts.account', $updatePass->id);
            }
            // session()->flash('error', 'Mật khẩu mới không khớp nhau!');
            return redirect()->route('page.accounts.account', $updatePass->id);
            // return 'sai pass mới0';
        }
        // session()->flash('error', 'Mật khẩu cũ không chính xác!');
        return redirect()->route('page.accounts.account', $updatePass->id);
        // return 'sai pass cũ';
    }
}
