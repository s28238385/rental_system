@extends('layouts.master')
@section('content')

   <div class="text-center ">
    <h1 style="font-family:Microsoft JhengHei ;color:#2F91CD;">使用者註冊</h1>
    <div class="row  align-items-center justify-content-center">
    <div class="col-md-5 ">
        
        @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
        </div>
        @endif
    </div>
</div>
    </div>
        <div class="row  align-items-center justify-content-center">
            <div class="col-md-4">
            <form action="{{route('user.signup')}}"method="post">
                <div class="form-group">
                    <label for="name">姓名</label>
                    <input type="text" id="name" name="name"class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">電子郵件</label>
                    <input type="text" id="email" name="email"class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">設定密碼</label>
                    <input type="password" id="password" name="password"class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirm">確認密碼</label>
                    <input type="password" id="confirm" name="confirm"class="form-control">
                </div>
                <div class="form-group">
                    <label for="role">身分</label>
                    <select name="role" id="role">
                        <option value="user" selected>工讀生</option>
                        <option value="manager">管理員</option>
                    </select>
                </div>
        </div>
    </div>
        <div class="row  align-items-center justify-content-center">
            <button type="submit"class="btn btn-outline-info">註冊</button>
        </div>
            {{csrf_field()}}
        </form>
    


@endsection