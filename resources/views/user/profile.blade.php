@extends('layouts.master')
@section('content')
<div class="row ">
    <h1 style="font-family:Microsoft JhengHei ;color:#2F91CD;">管理者資料</h1> 
</div>    
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="row">
    <?php
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Facades\Auth;
        $id=Auth::user()->id;
        $user=DB::table('users')->where('id',$id)->first();
       ?> <div class="col-md-4 col-md-offset-4"> <?php
        echo "管理者姓名: ".$user->name."<br>";
        echo "身分: ".$user->role."<br>"; 
        echo "email: ".$user->email."<br>";  
    ?>
</div>
</div>

<div class="row">
<div class="col-md- col-md-offset-4">
        <form method="get" action="{{route('user.changepw')}}">
            <button type="submit" class="btn btn-primary">修改密碼</button>
            
            {{csrf_field()}}
           
        </form> 
        </div>
            <div class="col-md-4 col-md-offset-4">
            <form method="get" action="{{route('user.logout')}}">
            <button type="submit" class="btn btn-secondary">登出</button>

            {{csrf_field()}}
        </form> 
        </div>
</div>

@endsection