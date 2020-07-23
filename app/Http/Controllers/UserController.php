<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getSignup()
    {
        return view('user.signup');
    }
    public function postSignup(Request $request)
    {
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
    public function getSignin()
    {
        if (!Auth::check()) {
            return view('user.signin');
        } else
            return view('homepage');
    }
    public function postSignin(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:6'
        ]);
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return view('homepage');
        }
        return redirect()->back()->withErrors(['fail' => 'Email or password is wrong!']);
    }
    public function getProfile()
    {
        return view('user.profile');
    }
    public function getIndex()
    {
    }
    public function getLogout()
    {
        Auth::logout();
        return  view('homepage');
    }
    public function postChangepw(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required|min:6',
            'newpassword' => 'required|min:6',
            'confirmnewpassword' => 'required_with:newpassword|same:newpassword|min:6'
        ]);
        $id = Auth::user()->id;
        $oldpassword = $request->input('oldpassword');
        $newpassword = $request->input('newpassword');
        $res = DB::table('users')->where('id', $id)->select('password')->first();
        if (!Hash::check($oldpassword, $res->password)) {
            echo 2;
            return redirect()->back()->withErrors(['fail' => 'oldpassword is wrong!']); //原密碼不對
        }
        $update = array(
            'password'  => bcrypt($newpassword),
        );
        $result = DB::table('users')->where('id', $id)->update($update);
        if ($result) {
            echo 1;
            return redirect()->route('user.profile')->with(['success'=> '修改密碼成功!!!']);
        } else {
            echo 3;
            exit;
            return redirect()->route('user.profile');
        }
    }
    public function getChangepw()
    {
        return view('user.changepw');
    }
    public function getresetphone()
    {
        return view('user.resetphone');
    }
    public function postresetphone(Request $request)
    {
        $this->validate($request, [
            'oldphone' => 'required|min:10',
            'newphone' => 'required|min:10',
        ]);
        $id = Auth::user()->id;
        $oldphone = $request->input('oldphone');
        $newphone = $request->input('newphone');
        $res = DB::table('users')->where('id', $id)->select('phone')->first();
        if ($res->phone != $oldphone) {
            echo 2;
            return redirect()->back()->withErrors(['fail' => 'old password is wrong!']); //原密碼不對
        }
        $update = array(
            'phone'  => $newphone,
        );
        $result = DB::table('users')->where('id', $id)->update($update);
        if ($result) {
            echo 1;
            return redirect()->route('user.profile');
        } else {
            echo 3;
            return redirect()->route('user.profile');
        }
    }
    public function getUserList()
    {
        return view('user.userlist');
    }
    public function getdelAcc($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('user.userlist');
    }
    public function getresetPassword($id)
    {
        $email = DB::table('users')->where('id', $id)->select('email')->first();
        $name=DB::table('users')->where('id', $id)->select('name')->first();
        
        return view('user.managerresetpw', [
            'id' => $id,'email'=>$email,'name'=>$name
        ]);
    }
    public function postresetPassword(Request $request,$id)
    {
        $this->validate($request, [
            'oldpassword' => 'required|min:6',
            'newpassword' => 'required|min:6',
            'confirmnewpassword' => 'required_with:newpassword|same:newpassword|min:6'
        ]);
        
        $oldpassword = $request->input('oldpassword');
        $newpassword = $request->input('newpassword');
        $res = DB::table('users')->where('id', $id)->select('password')->first();
        if (!Hash::check($oldpassword, $res->password)) {
            echo 2;
            
            return redirect()->back()->withErrors(['fail' => 'old password is wrong!']); //原密碼不對
        }
        $update = array(
            'password'  => bcrypt($newpassword),
        );
        $result = DB::table('users')->where('id', $id)->update($update);
        if ($result) {
            echo 1;
            return redirect()->route('user.userlist')->with(['success'=> '修改密碼成功!!!']);
        } else {
            echo 3;
            
            return redirect()->route('user.userlist')->with(['success'=>'修改密碼失敗!!!']);
    }
}
}
