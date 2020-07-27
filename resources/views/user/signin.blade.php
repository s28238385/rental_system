@extends('layouts.master')

@section('title')
管理者登入
@endsection

@section('content')
<div class="text-center">
    <div class="row align-items-center justify-content-center mt-5">
        <div class="col-4 mt-5">
            <h1 class="mb-3 font-weight-normal color-2F91CD">管理者登入</h1>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('user.signin') }}" method="post">
                <div class="form-group">
                    <label for="email" class="sr-only">電子信箱</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email address" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">密碼</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit"class="btn btn-outline-primary">登入</button>
                {{csrf_field()}}
            </form>  
        </div>
    </div>
</div>
@endsection