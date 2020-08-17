<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Laravel登入認證與雜湊資源
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

//資料庫model
use App\User;

class UserController extends Controller
{
    //取得註冊頁面
    public function getSignup() {
        //回傳user.signup
        return view('user.signup');
    }

    //存入註冊資料
    public function postSignup(Request $request) {
        //進行輸入驗證
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20',
            'confirm' => 'required_with:password|same:password|min:6|max:20',
            'role' => "required"
        ]);

        //建立model以輸入資料
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
        ]);
        $executed = $user->save();

        //重導回user.userlist，若未成功存入新使用者資料則傳回失敗訊息，若成功存入新使用者資料則傳回成功訊息
        if(!$executed){
            return redirect()->route('user.userlist')->with('fail', '註冊使用者失敗，請再次嘗試！');
        }
        else {
            return redirect()->route('user.userlist')->with('success', '註冊使用者成功！');
        }
    }

    //取得登入頁面
    public function getSignin() {
        //回傳user.signin
        return view('user.signin');
    }

    //登入檢查
    public function postSignin(Request $request) {
        //驗證輸入值
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:6|max:20'
        ]);

        //登入嘗試
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            //重導至首頁並顯示成功訊息
            return redirect('/')->with('success', '登入成功！');
        }

        //重導至前一頁面並顯示錯誤訊息
        return redirect()->back()->withErrors('電子信箱或密碼有誤')->withInput();
    }

    //登出
    public function getLogout() {
        //Laravel登出指令
        Auth::logout();

        //重導至首頁並顯示成功訊息
        return redirect('/')->with('success', '登出成功！');
    }

    //取得更改密碼頁面
    public function getChangepw() {
        //回傳user.changepw
        return view('user.changepw');
    }

    //更新新密碼
    public function postChangepw(Request $request) {
        //輸入驗證
        $this->validate($request, [
            'oldpassword' => 'required|min:6|max:20',
            'newpassword' => 'required|min:6|max:20',
            'confirmnewpassword' => 'required_with:newpassword|same:newpassword|min:6|max:20'
        ]);

        //透過登入中的user id取出資料
        $user = User::find( Auth::user()->id );

        //檢查舊密碼是否相符
        if ( !Hash::check($request->input('oldpassword'), $user->password) ) {
            //重導至前一頁面並附帶錯誤訊息
            return redirect()->back()->withErrors('舊密碼不相符'); //原密碼不對
        }

        //更新密碼
        $user->password = bcrypt($request->input('newpassword'));
        $executed = $user->save();

        //重導至首頁，若更新成功則附帶成功訊息，否則附帶失敗訊息
        if ($executed) {
            return redirect('/')->with('success', '修改密碼成功！');
        } else {
            return redirect('/')->with('fail', '修改密碼失敗，請再次嘗試！');
        }
    }

    //取得使用者清單
    public function getUserList() {
        //取出user table所有資料，以20筆為一頁
        $users = User::paginate(20);

        //回傳user.userlist，並附帶$users
        return view('user.userlist', ['users' => $users]);
    }

    //刪除帳號
    public function getdelAcc($id) {
        //根據傳入$id取出資料
        $user = User::find($id);
        $executed = $user->delete();

        //重導至user.userlist，若刪除成功則附帶成功訊息，否則附帶失敗訊息
        if($executed) {
            return redirect()->route('user.userlist')->with('success', '刪除使用者成功！');
        }
        else {
            return redirect()->route('user.userlist')->with('fail', '刪除使用者失敗，請再次嘗試！');
        }
    }

    //取得管理員重設使用者密碼頁面
    public function getresetPassword($id) {
        //根據傳入$id取出資料
        $user = User::find($id);

        //回傳user.managerresetpw，並附帶$user
        return view('user.managerresetpw', ['user' => $user]);
    }

    //更新重設後的密碼
    public function postresetPassword(Request $request, $id) {
        //輸入值檢查
        $this->validate($request, [
            'newpassword' => 'required|min:6|max:20',
            'confirmnewpassword' => 'required_with:newpassword|same:newpassword|min:6|max:20'
        ]);

        //根據傳入$id取出資料
        $user = User::find($id);

        //更新密碼
        $user->password = bcrypt($request->input('newpassword'));
        $executed = $user->save();

        //重導至user.userlist，若變更成功則附帶成功訊息，否則附帶失敗訊息
        if ($executed) {
            return redirect()->route('user.userlist')->with('success', '修改密碼成功！');
        } else {
            return redirect()->route('user.userlist')->with('fail', '修改密碼失敗，請再次嘗試！');
        }
    }
}
