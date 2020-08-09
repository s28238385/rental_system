@extends('layouts.master')

@section('title')
    重設密碼
@endsection

@section('content')
<div class="text-center mt-5 mb-3">
    <h1 class="text-info font-weight-normal">重設密碼</h1>
    <div class="row align-items-center justify-content-center">
        <div class="col-md-4">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
<div class="row align-items-center justify-content-center">
    <div class="col-md-4">
        <form action="{{ route('user.resetpassword',['id' => $user->id]) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <p>使用者名稱：{{ $user->name }}</p>
                <p>使用者信箱：{{ $user->email }}</p>
            </div>
            <div class="form-group">
                <div class="d-flex inline-flex">
                    <label for="newpassword">新密碼<span class="required">*</span></label>
                    <small class="form-text text-muted ml-auto">密碼長度應介於6~20位</small>
                </div>
                <input type="password" id="newpassword" name="newpassword" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirmpassword">確認新密碼<span class="required">*</span></label>
                <input type="password" id="confirmnewpassword" name="confirmnewpassword" class="form-control" required>
            </div>
            <div class="row align-items-center justify-content-center">
                <button type="submit"class="btn btn-outline-info px-3">確認重設</button>
            </div>
        </form>
    </div>
</div>
@endsection 