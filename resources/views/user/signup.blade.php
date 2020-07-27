@extends('layouts.master')

@section('title')
新增使用者
@endsection

@section('content')
<div class="text-center mt-4">
    <h1 class="color-2F91CD font-weight-normal mb-3">新增使用者</h1>
    <div class="row align-items-center justify-content-center">
        <div class="col-4">
            @if(count($errors)>0)
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
    <div class="col-4">
        <form action="{{route('user.signup')}}" method="post">
            <div class="form-group">
                <label for="name">姓名<span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="email">電子郵件<span class="required">*</span></label>
                <input type="text" id="email" name="email" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
                <div class="d-flex inline-flex">
                    <label for="password">設定密碼<span class="required">*</span></label>
                    <small class="form-text text-muted ml-auto">密碼長度應大於6位</small>
                </div>
                <input type="password" id="password" name="password"class="form-control">
            </div>
            <div class="form-group">
                <label for="confirm">確認密碼<span class="required">*</span></label>
                <input type="password" id="confirm" name="confirm"class="form-control">
            </div>
            <div class="form-group">
                <label for="role">身分</label>
                <select id="role" name="role" class="ml-2">
                    <option value="user" selected>工讀生</option>
                    <option value="manager">管理員</option>
                </select>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-outline-info px-3">新增</button>
            </div>
            {{csrf_field()}}
        </form>
    </div>
</div>
@endsection