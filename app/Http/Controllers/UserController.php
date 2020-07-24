<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getSignup() {
        return view('user.signup');
    }

    public function postSignup(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm' => 'required_with:password|same:password|min:6',
            'role' => "required"
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
        ]);
        $user->save();

        return redirect()->route('user.userlist');
    }

    public function getSignin() {
        return view('user.signin');
    }

    public function postSignin(Request $request) {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect('/');
        }

        return redirect()->back()->withErrors(['fail' => 'Email or password is wrong!']);
    }

    public function getLogout() {
        Auth::logout();

        return redirect('/');
    }

    public function getChangepw() {
        return view('user.changepw');
    }

    public function postChangepw(Request $request) {
        $this->validate($request, [
            'oldpassword' => 'required|min:6',
            'newpassword' => 'required|min:6',
            'confirmnewpassword' => 'required_with:newpassword|same:newpassword|min:6'
        ]);

        $user = User::find( Auth::user()->id );
        
        if ( !Hash::check($request->input('oldpassword'), $user->password) ) {
            return redirect()->back()->withErrors(['fail' => 'Oldpassword is wrong!']); //原密碼不對
        }

        $user->password = bcrypt($request->input('newpassword'));
        $saved = $user->save();

        if ($saved) {
            return redirect('/')->with(['success'=> '修改密碼成功！']);
        } else {
            return redirect('/')->with(['fail' => '修改密碼失敗！']);
        }
    }

    public function getUserList() {
        $users = User::all();

        return view('user.userlist', ['users' => $users]);
    }

    public function getdelAcc($id) {
        $user = User::find($id);
        $stored = $user->delete();

        if($stored) {
            return redirect()->route('user.userlist')->with(['success' => '刪除該使用者成功！']);
        }
        else {
            return redirect()->route('user.userlist')->with(['fail' => '刪除該使用者失敗！']);
        }
    }

    public function getresetPassword($id) {
        $user = User::find($id);
        
        return view('user.managerresetpw', ['user' => $user]);
    }

    public function postresetPassword(Request $request, $id) {
        $this->validate($request, [
            'newpassword' => 'required|min:6',
            'confirmnewpassword' => 'required_with:newpassword|same:newpassword|min:6'
        ]);
        
        $user = User::find($id);

        $user->password = bcrypt($request->input('newpassword'));
        $stored = $user->save();
        
        if ($stored) {
            return redirect()->route('user.userlist')->with(['success'=> '修改密碼成功！']);
        } else {
            return redirect()->route('user.userlist')->with(['fail'=> '修改密碼失敗！']);
        }
    }
}
