@extends('layouts.master')

@section('title')
管理使用者
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="row justify-content-end m-2 fixed-bottom">
            <div class="hint alert alert-success alert-sm alert-dismissible col fade show text-center" role="alert">
                <p class="m-0 text-wrap">{{ Session::get('success') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @elseif(Session::has('fail'))
        <div class="row justify-content-end m-2 fixed-bottom">
            <div class="hint alert alert-danger alert-sm alert-dismissible col fade show text-center" role="alert">
                <span class="text-wrap">{{ Session::get('fail') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="d-flex inline-flex align-items-center mt-5 mb-3">
        <h1 class="font-weight-normal text-info">管理使用者</h1>
        <a type="button" class="btn btn-outline-success ml-auto px-3" href="{{ route('user.signup') }}">新增使用者</a>
    </div>
    <div class="d-flex justify-content-center my-2">
        {{ $users->links() }}
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>名稱</th>
                <th>身分</th>
                <th>電子信箱</th>
                <th>管理</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="<?php if($user->role === '管理員'){echo "bg-spary";}?>">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a type="button" class="btn btn-sm btn-outline-primary px-3 <?php if(Auth::user()->id === $user->id){echo 'disabled';}?>" href="{{ route('user.change.identity', ['id' => $user->id]) }}">變更身分</a>
                        <a type="button" class="btn btn-sm btn-outline-primary px-3 <?php if(Auth::user()->id === $user->id){echo 'disabled';}?>" href="{{ route('user.resetpassword', ['id' => $user->id]) }}">重設密碼</a>
                        <a type="button" id="delete-account" class="btn btn-sm btn-outline-danger px-3" onclick="return confirm('確定刪除帳號?')" href="{{ route('user.deleteacc',['id'=>$user->id]) }}">刪除帳號</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center my-2">
        {{ $users->links() }}
    </div>
@endsection